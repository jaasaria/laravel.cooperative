<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefRole as Cls;

use App\Models\RefPermission;
use App\Models\RefRolePermission;

use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCategory as ValidateRequest;
use DB;


class RefRoleController extends Controller
{

    public $form,$route;
    public $rList,$rCreate;

    public $permission;


    public function __construct(){
        $this->form = "Role and Permission";     //plural
        $this->route = "role";
        $this->rList = "back.ref_role.list";
        $this->rCreate = "back.ref_role.create";
        $this->rPermission = "back.ref_role.permission";

        $this->permission = RefPermission::all();

        // dd($this->permission);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form = $this->form;
        $route = $this->route;
        return view($this->rList,compact('form','route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form;
        $route = $this->route;

        return view($this->rCreate,compact('form','route'));
    }


    public function createPermission($roleId)
    {
        $form = $this->form;
        $route = $this->route;
        $permission = $this->permission;

        $rolePermission = RefRolePermission::where('role_id',$roleId)->get(['value']);        
        return view($this->rPermission,compact('form','route','permission','roleId','rolePermission'));
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateRequest $request)
    {

        Cls::create($request->all());
        return redirect($this->route)->with('success',' Record was successfully saved.');
    }


    public function storePermission(Request $request)
    {

        $rolesId = $request->get('rolesId');
        $roles = $request->get('roles');


        //easy process (not recommended)
        $rolePermission = RefRolePermission::where('role_id',$rolesId)->count();
        if ($rolePermission > 0){
            RefRolePermission::where('role_id',$rolesId)->delete();
        }



        $dataSet = [];
        foreach($roles as $name=>$value){
             $dataSet[] = [
                'role_id'  => $rolesId,
                'permission_id' => $value,
                'value' => $name,
            ];
        }

        DB::table('tbl_role_permission')->insert($dataSet);

        return redirect('role')->with('success',' Record was successfully saved.');
        // return redirect($this->route)->with('success',' Record was successfully saved.');
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = $this->form;
        $route = $this->route;


        $data = Cls::findorfail($id);
        return view($this->rCreate,compact('data','form','route','category','unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateRequest $request, $id)
    {

        $active =  ($request->active) ? true : false;
        $request->merge(array('active' =>  $active ));

        Cls::find($id)->update( $request->all());
        return redirect($this->route)->with('success',' Record was successfully updated.');

    }
     public function updatePermission(ValidateRequest $request, $id)
    {

        $active =  ($request->active) ? true : false;
        $request->merge(array('active' =>  $active ));

        Cls::find($id)->update( $request->all());
        return redirect($this->route)->with('success',' Record was successfully updated.');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete(Request $request)
    {

        $id  = $request->get('id');
        $data = Cls::find($id);
        $data->delete();

    }


    public function data(){

        $data = Cls::all();

        return Datatables::of($data)

            ->addColumn('action', function ($data) {


                if($data->id == 1){
                    $d = 'disabled';
                }

                 return '<div class="text-center">
                            <div class="btn-group">

                                <a href="'. route( $this->route . '.createPermission',$data->id) .'" type="btn" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Permission"
                               
                                ><i class="fa fa-shield"></i></a>

                                <a href="'. route( $this->route . '.edit',$data->id) .'" type="btn" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Record"><i class="fa fa-pencil-square"></i></a>

                                <button id="btndelete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .' data-docid='.$data->id.'><i class="fa fa-trash-o"></i></button> 

                            </div>
                            </div>
                        ';

            })

    
        ->editColumn('name', ' 
                         {{ $name }}
                        ')

        ->editColumn('description', ' 
                          <div class="td-description"> {!! str_limit($description) !!} </div>
                        ')

        ->editColumn('created_at',function ($data){
                        return  '<div class="text-center">' . $data->created_at->diffForHumans() . '</div>';
                        })

        ->setRowId('id')
            ->setRowClass(function ($data) {
                 return 'odd';
            })
            ->setRowData([                  //same with = data-id={{ $Notes->id }} note: not sure but i think
                'id' => 'test',
            ])
            ->setRowAttr([
                'color' => 'red',
            ])
            ->make(true);
    }







}
