<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\MailUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', exec(['getMailsAPI']));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getUsers(Request $request)
    {
        $limitPag   = $request['limitPag'];
        $busq       = $request['busq'];
        $users = User::all();
        
        if ($busq != '') {
            $users = User::where('name','like',"%$busq%")
                ->orWhere('cedula','like',"%$busq%")
                ->orWhere('email','like',"%$busq%")
                ->orWhere('phone','like',"%$busq%")
            ->get();
        }
        
        return response()->json(['users' => $users]);
    }

    public function saveChanges(Request $request)
    {
        $data = $request->all();
        $item = User::where('email', $data['email'])->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'fecha_nac' => $data['fecha_nac'],
        ]);
        $users = User::all();


        return response()->json(['users' => $users]);

    }

    public function delItem(Request $request)
    {
        $data = $request->all();
        $item = User::where('id', $data['id'])->delete();

        return response()->json(['status' => 'ok']);
    }

    public function sendMail(Request $request)
    {
        //$data = $request->all();
            $mail = MailUser::create([
                'asunto' => $request['asunto'],
                'destino' => $request['destino'],
                'mensaje' => $request['mensaje'],
                'status' => 'Pendiente',
                'user_id' => Auth::id()
            ]);
        return response()->json(['status' => 'ok']);
    }

    public function getMails(Request $request)
    {
        $limitPag   = $request['limitPag'];
        $busq       = $request['busq'];
        $mails = MailUser::all();
        
        if ($busq != '') {
            $mails = MailUser::where('asunto','like',"%$busq%")->get();
        }
        
        return response()->json(['mails' => $mails],200);
    }

    public function getMailsAPI(Request $request)
    {
        $limitPag   = $request['limitPag'];
        $busq       = $request['busq'];
        $mails = MailUser::all();
        
        if ($busq != '') {
            $mails = MailUser::where('asunto','like',"%$busq%")->get();
        }
        
        return response()->json(['status' => 'ok', 'mails' => $mails],200);
    }


    
}
