<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrSettings;

class PagesController extends Controller
{
    

 	public function dashboard()
    {
        return view('back.pages.dashboard');
    }

 	public function settings()
    {


    	$datas = TrSettings::orderBy('id')->get();
        return view('back.pages.settings',compact('datas'));
    }


 	public function help()
    {
        return view('back.pages.help');
    }

    public function settingsUpdate(Request $request)
    {
        
        $inputs  = $request->except('_token');
        $fieldc = $inputs['field'];
 

        $data = array();
        $data1 = [];

        $field = array();
        $value = array();
        $description = array();
        $id = array();

        $id1 = array();

        foreach( $fieldc as $key => $n ) {
            $data[] = array("field"=>$inputs['field'][$key] ,"value"=>$inputs['value'][$key],"description"=>$inputs['description'][$key]);           

            // $data1[] = ["field"=>$inputs['field'][$key] ,"value"=>$inputs['field'][$key],"description"=>$inputs['field'][$key]];

            // $id[] = array_merge(array("id"=>$inputs['id'][$key]));
            // $id1[] = $inputs['id'][$key];

            // $field[] = array_merge(array("field"=>$inputs['field'][$key]));
            // $value[] = array_merge(array("value"=>$inputs['value'][$key]));
            // $description[] = array_merge(array("description"=>$inputs['description'][$key]));

        }   


        // $finalId = json_encode($id1);
        // $finalData = json_encode($data1);

        TrSettings::truncate();
        TrSettings::insert($data);
        // TrSettings::whereIn('id', $id1)->update($finalData);



        return back()->with('success',' Record was successfully saved.');


    }




}
