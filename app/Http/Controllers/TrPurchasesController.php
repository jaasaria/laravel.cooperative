<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrPurchases as Cls;
use App\Models\TrPurchasesItem;
use App\Models\RefSupplier;
use App\Models\RefItem;

use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCategory;

use App\Http\Requests\StorePurchase as ValidateRequest;
use Validator;

use Carbon\Carbon;

class TrPurchasesController extends Controller
{

    public $form,$route;
    public $rList,$rCreate;

    public function __construct(){
        $this->form = "Purchases";      //plural
        $this->route = "purchase";
        $this->rList = "back.tr_purchase.list";
        $this->rCreate = "back.tr_purchase.create";
        $this->items = RefItem::all(['name','code', 'id']);
        $this->supplier = RefSupplier::pluck('name', 'id');

    }

    public function messages()
    {
        return [
            'trcode.required' => 'tr code is required custom ',
        ];
    }

    public function index()
    {
        $form = $this->form;
        $route = $this->route;
        return view($this->rList,compact('form','route'));
    }

    public function create()
    {

        
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

             $this->validate($request, [
            'trcode'=>'required|alpha_dash|unique:tr_purchases|min:3',
            'supplier_id'=>'required|exists:tbl_supplier,id', 
            'description'=>'max:255', 
            'datePurchase'=>'required|date_format:m/d/Y', 
            'dateDelivery'=>'required|date_format:m/d/Y', 
            'trtotal'=>'required|min:1|numeric', 
            'rows.*.item_id' => 'required|max:255',
            'rows.*.cost' => 'required|numeric|min:1',
            'rows.*.qty' => 'required|integer|min:1'
            ]);




            $rows = collect($request->rows)->transform(function($row) {
                $row['subtotal'] = $row['qty'] * $row['cost'];
                return new TrPurchasesItem($row);
            });
            if($rows->isEmpty()) {
                return response()->json([
                    'products_empty' => ['One or more Items is required.']
                ], 422);
            }

            $data = $request->except('rows');
            $data['datePurchase'] =date_format(date_create($data['datePurchase']),"Y-m-d");
            $data['dateDelivery'] =date_format(date_create($data['dateDelivery']),"Y-m-d");

            
            $header = Cls::create($data);
            $header->details()->saveMany($rows);

            return response()
                ->json([
                    'created' => true
            ]);

            
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
        $data = Cls::findorfail($id);
        $supplier  = $this->supplier;
        $items  =  $this->items;

        // $data->dateDelivery = $data->dateDelivery->format('m-d-Y');

        return view($this->rCreate,compact('data','form','route','supplier','items'));
    }

    public function update(ValidateRequest $request, $id)
    {
        $data = Cls::findorfail($id);
        $data->name =  ucfirst($request->name);
        $data->description = ucfirst($request->description);
        $data->save();
        return redirect($this->route)->with('success',' Record was successfully updated.');
    }

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

        // $d = Cls::all();
        // $data = $d->load('tbl_supplier');
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

        // ->editColumn('name', ' 
        //                  {{ $supplier_id }}
        //                 ')

        ->editColumn('name',function ($data){
                        return   $data->tbl_supplier->name;
                        })

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


    public function getNextOrderNumber()
    {
    
        $Prefix  = 'PUR-';

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
