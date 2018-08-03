<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivitiesController extends Controller
{
    //登录权限
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    //显示
    public function index(Request $request)
    {
        //echo'1';
       // dd(time());
        $time =time();
       //$start_time=strtotime($request->start_time);
       //$end_time=strtotime($request->end_time);
//  if(empty($status)){
//      $activities= Activities::paginate(6);
//
//  } elseif($status==1){
      //$act1= Activities::where('end_time','<',$time)->paginate(6);//已过期
        $act2= Activities::where('end_time','>',$time)->where('start_time','<',$time)->paginate(6);
        $acti3= Activities::where('start_time','>',$time)->paginate(6);//未开始
//  } elseif($status==2){
//      $activities= Activities::where('end_time','>',$time)->where('start_time','<',$time)->paginate(6);//进行中
//  }elseif($status==3){
      $activities= Activities::where('start_time','>',$time)->where('end_time','>',$time)->paginate(6);//未开始
//  }
    return  view('activities/index',compact('activities'));
    }

    public function show(Activities $activity ,Request $request)
    {

        return  view('activities/show',compact('activity'));
    }


}
