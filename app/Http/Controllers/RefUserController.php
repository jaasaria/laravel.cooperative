<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Cls;

use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreUser as ValidateRequest;
use App\Http\Requests\StoreUserPassword as ValidateRequestPass;
use Validator;

//use this for the picture and intervention
use Image;
use File;


class RefUserController extends Controller
{

    public $form,$route;
    public $rList,$rCreate,$rEdit;
    public $category,$unit,$item;


    public function __construct(){
        $this->form = "Users";     //plural
        $this->route = "user";
        $this->rList = "back.ref_user.list";
        $this->rCreate = "back.ref_user.create";
        $this->rEdit = "back.ref_user.edit";
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
        $category = $this->category;
        $unit = $this->unit;
        return view($this->rCreate,compact('form','route','category','unit'));
    }

    public function store(ValidateRequest $request)
    {
        $data =  $request->all();


        $data['password'] =  bcrypt($data['password']);
        $data['designation'] =  ucwords($data['designation']);
        Cls::create($data);
        return redirect($this->route)->with('success',' Record was successfully saved.');
    }


    public function show($id)
    {
    }

   
    public function edit($id)
    {
        $form = $this->form;
        $route = $this->route;

        $data = Cls::findorfail($id);
        return view($this->rEdit,compact('data','form','route'));
    }

    public function editProfile($id)
    {
        $form = $this->form;
        $route = $this->route;
        $data = Cls::findorfail($id);
        $profile = true;
        return view($this->rEdit,compact('data','form','route','profile'));
    }

    public function update(ValidateRequest $request, $id)
    {

        $active =  ($request->active) ? true : false;
        $profile =  $request->profile;


        $request->merge(array('active' =>  $active ));

        $input = $request->except(['password']);
        $input['designation'] =  ucwords($input['designation']);

        Cls::find($id)->update( $input);

        if($profile){
            return back()->with('success',' Record was successfully updated.');    
        }else{
            return redirect($this->route)->with('success',' Record was successfully updated.');    
        }
        

        

    }

    public function updatePassword(ValidateRequestPass $request, $id)
    {

        $profile =  $request->profile;
        $data = $request->only(['password', 'password_confirmation']);
        $data['password'] =  bcrypt($data['password']);

        Cls::find($id)->update( $data);
        
        if($profile){
            return back()->with('success',' Password was successfully updated.');  
        }else{
            return redirect($this->route)->with('success',' Password was successfully updated.');
        }

    }


    public function avatar(Request $request, $id){

        $file = array('avatar' => $request->avatar);
        $rules = array('avatar'=>'mimes:jpeg,jpg,png|max:3000|required',); 

        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->with('error', "Upload file is not valid, please check the file size.");
        }

        if ($request->file('avatar')->isValid()) {

            $user = Cls::findorfail($id);

            $avatar = $request->file('avatar');
            $filename = $id . '-' .  time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('upload/avatars/' . $filename);

            //deleting image if not default
            if ($user->avatar !== 'default.png') {
                $tempfile = 'upload/avatars/' . $user->avatar;
                if (File::exists($tempfile)) {
                    unlink($tempfile);
                }
            }

            Image::make($avatar)->resize(160,160)->save($path);           
            $user->avatar  =  $filename;
            $user->save();

            // dbfunction::insertlogs(Auth::user()->id,'Update Profile Picture');

            // return redirect($this->route)->with('success',' Profile avatar was successfully updated.');
            return redirect()->back()->with('success',' Profile avatar was successfully updated.');
        }
        else{
            return Redirect::back()
                ->with('error', "Upload File is not valid");
        }

    }


    public function deleteAvatar(Request $request,$id){

        // dd($request);

        $user  =  Cls::findorfail($id);        

        if ($user->avatar != 'default.png'){
            $tempfile = 'upload/avatars/' . $user->avatar;
            if (File::exists($tempfile)) {
                unlink($tempfile);
            }
            $user->avatar = 'default.png';
            $user->save();
        }

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




        ->editColumn('avatar',function ($data){
                        return '<img class="img-avatar" src="upload/avatars/'.  $data->avatar . '">';
                        })        

        ->editColumn('code',function ($data){
                        return   $data->fullname;
                        })

        ->editColumn('name', ' 
                         {{ $address }}
                        ')

        ->editColumn('description', ' 
                          <div class="td-description"> {!! str_limit($notes) !!} </div>
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
