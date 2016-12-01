<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefItem as Cls;

use App\Models\RefCategories;
use App\Models\RefUnits;

use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreItem as ValidateRequest;


class RefItemController extends Controller
{

    public $form,$route;
    public $rList,$rCreate;

    public $category,$unit,$item;


    public function __construct(){
        $this->form = "Item";     //plural
        $this->route = "item";
        $this->rList = "back.ref_item.list";
        $this->rCreate = "back.ref_item.create";

        $this->category = RefCategories::pluck('name', 'id');   
        $this->unit = RefUnits::pluck('name', 'id');
        

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

        $category = $this->category;
        $unit = $this->unit;

        return view($this->rCreate,compact('form','route','category','unit'));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

        $category = $this->category;
        $unit = $this->unit;

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

                return '<div class="text-center">
                            <div class="btn-group">

                                <a href="'. route( $this->route . '.edit',$data->id) .'" type="btn" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Record"><i class="fa fa-pencil-square"></i></a>

                                <button id="btndelete" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .' data-docid='.$data->id.'><i class="fa fa-trash-o"></i></button> 
                            </div>
                        </div>
                        ';
            })

        ->editColumn('code', ' 
                         {{ $code }}
                        ')

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



    public function apiItem()
    {


        // return Cls::all(['id', 'code']);


        // $data = Cls::pluck('code', 'id');
        // return $data;

        $data = Cls::all(['id', 'code', 'name']);
        foreach ($data as $key => $value) {
            $list[$key]['id'] = $value->id;
            $list[$key]['text'] = $value->code; 
        }
        return json_encode($list); 
    }


    public function apiItemId($id)
    {

        $data = Cls::whereId($id)->get();

        return json_encode($data); 
    }




}
