<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Carbon\Carbon;

class TrMessagesController extends Controller
{

    public $form,$route;
    public $rList,$rCreate;

    public function __construct(){
        $this->form = "Messages";      //plural
        $this->route = "messages";
        $this->rList = "back.tr_messages.list";
        $this->rCreate = "back.tr_messages.create";

        $this->users = User::all(['name', 'id','avatar']);

    }

    public function index()
    {
        $form = $this->form;
        $route = $this->route;
        $user = $this->users;

        return view($this->rList,compact('form','route','user'));
    }




 
    public function data(){

        $data = Cls::with('tbl_supplier')->orderBy('id', 'desc')->get();

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
                         {{ $trcode }}
                        ')


        ->editColumn('name',function ($data){
                        return   $data->tbl_supplier->name;
                        })

        ->editColumn('description', ' 
                          <div class="td-description"> {!! str_limit($description) !!} </div>
                        ')


        ->editColumn('active', function ($data) {
                return $data->active == 0 ? 
                '<div class="text-center"><span class="label label-warning text-center"><i class="fa fa-check-circle-o"></i> Pending</span></div>' 
                : 
                '<div class="text-center"><span class="label label-success"> <i class="fa fa-check-circle-o"></i> Posted </span></div>';
            })



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
