<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrPurchases as Cls;
use App\Models\RefSupplier;
use App\Models\RefItem;

use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCategory;

use App\Http\Requests\StorePurchase as ValidateRequest;


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

        // dd(RefItem::all(['name','code', 'id']));
        $form = $this->form;
        $route = $this->route;
        $supplier  = RefSupplier::pluck('name', 'id');   
        $items  =  $this->items;
        return view($this->rCreate,compact('form','route','supplier','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // StorePurchase
    {


    

 // dd($request->all());

 

 $this->validate($request, [
            // 'invoice_no' => 'required|alpha_dash|unique:invoices',
            // 'client' => 'required|max:255',
            // 'client_address' => 'required|max:255',
            // 'invoice_date' => 'required|date_format:Y-m-d',
            // 'due_date' => 'required|date_format:Y-m-d',
            // 'title' => 'required|max:255',
            // 'discount' => 'required|numeric|min:0',


            // 'rows.*.itemid' => 'required|max:255',
            // 'rows.*.qty' => 'required|integer|min:1'
            // 'rows.*.cost' => 'required|numeric|min:1',
            

            'trcode'=>'required|alpha_dash|unique:tr_purchases|min:3',
            'supplier_id'=>'required|exists:tbl_supplier,id', 

            'description'=>'max:255', 
            'datePurchase'=>'required|date_format:m/d/Y', 
            'dateDelivery'=>'required|date_format:m/d/Y', 
            'trtotal'=>'required|min:1|numeric', 
        ]);


        $products = collect($request->rows)->transform(function($row) {
            $product['subtotal'] = $product['qty'] * $product['cost'];
            // return new InvoiceProduct($product);
        });

        if($products->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Product is required.']
            ], 422);
        }






 // dd($request->all());





// foreach($request->itemcode as $key=>$v){
// }
// dd($request->itemcode);


        // if($request->itemcode->isEmpty()) {
        //     return response()
        //     ->json([
        //         'products_empty' => ['One or more Product is required.']
        //     ], 422);
        // }




        // $products = collect($request->products)->transform(function($product) {
        //     $product['total'] = $product['qty'] * $product['price'];
        //     return new InvoiceProduct($product);
        // });

        // if($products->isEmpty()) {
        //     return response()
        //     ->json([
        //         'products_empty' => ['One or more Product is required.']
        //     ], 422);
        // }





        // $data = new Cls();
        // $data->code =  ucfirst($request->code);
        // $data->description = ucfirst($request->description);
        // $data->save();
        // return redirect($this->route)->with('success',' Record was successfully saved.');

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
    public function update(ValidateRequest $request, $id)
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
