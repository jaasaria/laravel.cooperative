<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrPurchases as Cls;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCategory;


class TrPurchasesController extends Controller
{

    public $form,$route;
    public $rList,$rCreate;

    public function __construct(){
        $this->form = "Purchases";      //plural
        $this->route = "purchase";
        $this->rList = "back.tr_purchase.list";
        $this->rCreate = "back.tr_purchase.create";

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {

        $data = new Cls();
        $data->name =  ucfirst($request->name);
        $data->description = ucfirst($request->description);
        $data->save();
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

        $data = Cls::findorfail($id);
        return view($this->rCreate,compact('data','form','route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, $id)
    {

        $data = Cls::findorfail($id);
        $data->name =  ucfirst($request->name);
        $data->description = ucfirst($request->description);
        $data->save();

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
                         {{ $code }}
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
