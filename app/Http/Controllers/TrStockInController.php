<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrStockIn as Cls;
use App\Models\TrStockInItem as ClsDetails;
use App\Models\RefSupplier;
use App\Models\RefItem;

use Yajra\Datatables\Datatables;
use Validator;

use Carbon\Carbon;

class TrStockInController extends Controller
{

    public $form,$route;
    public $rList,$rCreate;

    public function __construct(){
        $this->form = "Stock In";      //plural
        $this->route = "stockIn";
        $this->rList = "back.tr_stockIn.list";
        $this->rCreate = "back.tr_stockIn.create";
        $this->items = RefItem::all(['name','code', 'id']);
        $this->supplier = RefSupplier::pluck('name', 'id');
        // $this->supplier = RefSupplier::all(['id','name']);

    }


    public function index()
    {
        $form = $this->form;
        $route = $this->route;
        return view($this->rList,compact('form','route'));
    }

    public function create()
    {

        // dd(  $this->supplier->toJson());


        $form = $this->form;
        $route = $this->route;
        $supplier  = $this->supplier;
        $items  =  $this->items;
        $trCode =  $this->getNextOrderNumber();

        return view($this->rCreate,compact('form','route','supplier','items','trCode'));
    }

    public function store(Request $request)    // StorePurchase
    {

        try {

            // dd($request->crudstat);
            
            if ($request->crudstat == 'edit')
            {
                $trans_id = $request->id;
                $code_rule = 'required|alpha_dash|min:3|unique:tr_stock_in,trcode,' . $request->id;
            }
            else
            {
                $code_rule = 'required|alpha_dash|unique:tr_stock_in,trcode|min:3';
            }

             $this->validate($request, [
            'trcode'=>$code_rule,
            'supplier_id'=>'required|exists:tbl_supplier,id', 
            'description'=>'max:255', 
            'dateTrans'=>'required|date_format:m/d/Y', 
            'trtotal'=>'required|min:1|numeric', 
            'rows.*.item_id' => 'required|max:255',
            'rows.*.cost' => 'required|numeric|min:1',
            'rows.*.qty' => 'required|integer|min:1'
            ]);


            $rows = collect($request->rows)->transform(function($row) {
                $row['subtotal'] = $row['qty'] * $row['cost'];
                return new ClsDetails($row);
            });
            if($rows->isEmpty()) {
                return response()->json([
                    'products_empty' => ['One or more Items is required.']
                ], 422);
            }


            $data = $request->except('rows','crudstat','id','created_at','updated_at','active');
            $data['dateTrans'] =date_format(date_create($data['dateTrans']),"Y-m-d");


            if ($request->crudstat == 'edit')
            {
                Cls::where('id',$trans_id)->update($data);
                $header =  Cls::findorfail($trans_id);

                ClsDetails::where('stockin_id',$trans_id)->delete();
            }
            else{
                $header = Cls::create($data);

            }

            $header->rows()->saveMany($rows);

            return response()
                ->json([
                    'created' => true
            ],200);

            
        } catch (Exception $e) {
        }
       
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $form = $this->form;
        $route = $this->route;
        $data = Cls::with('rows')->findorfail($id);
        $supplier  = $this->supplier;
        $items  =  $this->items;
        
        $data = array_add($data, 'crudstat', true);

        return view($this->rCreate,compact('data','form','route','supplier','items'));
    }

    public function delete(Request $request)
    {
        $id  = $request->get('id');
        $data = Cls::find($id);
        $data->delete();
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


    public function getNextOrderNumber()
    {
    
        $Prefix  = 'StockIn-';

        $lastOrder = Cls::orderBy('created_at', 'desc')->first();

        if ( ! $lastOrder ){
            $numberOnly = '0';
        }
        else {
            $strDb = $lastOrder->trcode;
            $numberOnly = preg_replace('/\D/', '', $strDb);
        }  
        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.
     
        return  $Prefix . sprintf('%06d', intval($numberOnly) + 1);
    }


}
