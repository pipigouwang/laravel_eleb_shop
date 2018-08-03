<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Ordersgoods;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    //
    public function index()
    {
        $orders = Orders::paginate(5);
        return view('orders/index', compact('orders'));
    }

    public function show(Orders $order, Request $request)
    {
        // dd($order->tel);
        $order_id = $order->id;
        $ordergoods = Ordersgoods::where('order_id', $order_id)->get();
        return view('orders/show', compact('order', 'ordergoods'));
    }

    //取消订单
    public function cleanOrder(Orders $order)
    {
        $order->update(['status' => -1]);
        session()->flash('success', '取消订单成功');
    return redirect()->route('orders.index');
    }
    //发货
    public function sendOrder(Orders $order)
    {
        $order->update(['status' => 3]);
        session()->flash('success', '订单发货成功');
        return redirect()->route('orders.index');
    }

    public function CountOrder(Request $request)
    {
        //订单数量
        $user = Users::where('id',auth()->user()->id)->first();
        $orders = Orders::where('shop_id',$user->shop_id)->get();
        $day_count = 0;
        $month_count = 0;
        $total_count = 0;
        $month = 0;
        $day = 0;
        foreach ($orders as $order){
            $total_count ++;//累加得到总数
            if (substr($order->created_at,0,7) == substr(date('Y-m',time()),0,7)){
                $month_count ++;
                if (substr($order->created_at,0,10) == substr(date('Y-m-d',time()),0,10)){
                    $day_count ++;
                }
            }
            //按指定月份查询
            if (substr($order->created_at,0,7) == substr($request->month,0,7)){
                $month ++;
            }
            //按指定日期查询
            if (substr($order->created_at,0,10) == substr($request->day,0,10)){
                $day ++;
            }
        }
        $month_date = $request->month;
        $day_date = $request->day;
        return view('Orders/CountOrder',compact('day_count','month_count','total_count','month','day','month_date','day_date'));
    }

}