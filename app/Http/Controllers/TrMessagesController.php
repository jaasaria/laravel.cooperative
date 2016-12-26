<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrMessages as Cls;
use App\Http\Requests\StoreMessages as ValidateRequest;

use App\User;
use Auth;

use Event;
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

        $this->users = User::all(['name', 'id','avatar','designation','last_login','chat_status']);

    }

    public function index()
    {
        $form = $this->form;
        $route = $this->route;
        $user = $this->users;
        $messages =  Cls::orderby('id','asc')->get();
        return view($this->rList,compact('form','route','user','messages'));
    }

    public function store(Request $request)
    {

        $request->request->add(['sender_id' => Auth::user()->id]);
        $messageId = Cls::create($request->all());

        $data = Cls::where('id',$messageId->id)->
                     with('userSender','userReceiver')->first();

        broadcast(new \App\Events\ChatMessageReceived($data))->toOthers();
        // event(new \App\Events\ChatMessageReceived($data));

        return $data;

    }

    public function updateStatus(Request $request)
    {
        $data =  User::findorfail(Auth::user()->id);
        $data->chat_status  = $request->stat;
        $data->save();
        return response('done',200);
        // return back()->with('success',' User status was successfully saved.');
    }
    public function userStat()
    {
        $data =  User::findorfail(Auth::user()->id);
        return response()
            ->json([
                'status' => $data->chat_status
        ],200);
    }
    public function userList()
    {
        $LogUser = Auth::user()->id;
        $data =  User::where('id','<>',$LogUser)->get();
        return $data;
    }

    public function dataMessage(Request $request){

        $selectedid = $request->selectedUserId;
        $authId = Auth::user()->id;

        $data = Cls::whereIn('sender_id',array($authId,$selectedid))->
                    whereIn('receiver_id',array($authId,$selectedid))->
                    with('userSender','userReceiver')->
                    orderBy('id', 'asc')->
                    get();                  

                    // ->latest()->take(5)->get()->sortBy('created_at')

        return $data;
    }

    public function dataReceivedMessage(Request $request){

        $selectedMessageId = $request->selectedMessageId;
        $data = Cls::where('id',$selectedMessageId)->
                     with('userSender','userReceiver')->first();

        return $data;
    }


}
