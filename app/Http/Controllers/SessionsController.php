<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionsController extends Controller
{
    //

    public function login()
    {
//        if(Auth::check()){
//            //用户已登录
//            return redirect()->route('users.index');
//        }
      //  echo'1';
        return view('sessions/index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','注销成功');
    }
    public function store(Request $request)
    {
        $status=Users::all()->where('name',$request->name)->first()->status;
        if($status==0){
            return redirect()->route('login')->with('success','商户账号审核未通过');
        }
       // dd($request->rememberMe);
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空'
        ]);
        if (Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,
        ],$request->remember_token))
        {
            return redirect()->route('users.index')->with('success','登陆成功');
        }else{
            return back()->with('danger','用户名或者密码错误');
        }
    }

}
