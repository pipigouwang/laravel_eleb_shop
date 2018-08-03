<?php

namespace App\Http\Controllers;

use App\Models\Menucategory;
use App\Models\Menuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenusesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }
    public function index(Request $request)
    {
        //echo'1';
        $shop_id=auth()->user()->shop_id;
        $menucategories=Menucategory::where('shop_id',auth()->user()->shop_id)->get();
        //$menuses= Menuses::paginate(6);


        $where=[];//设置搜索条件
        if($request->category_id){
            $where[]=['category_id',$request->category_id];
            //dd($where);
        }
        if($request->max_price){
            $where[]=['goods_price','<=',$request->max_price];
        }
        if($request->min_price){
            $where[]=['goods_price','>=',$request->min_price];
        }
        if($request->min_price&&$request->max_price){//两个同时满足时
            $where[]=['goods_price','>=',$request->min_price];
            $where[]=['goods_price','<=',$request->max_price];
        }
        $menuses=Menuses::where($where)->paginate(10);//加搜索条件
        return  view('menuses/index',compact('menuses','menucategories'));
    }
    //菜品详情
    public function show(Menuses $menus)
    {
        $categories = Menucategory::where('shop_id',auth()->user()->shop_id)->get();
        return view('menuses.show',compact('menus','categories'));
    }
    //菜品添加
    public function create()
    {
        $categories = Menucategory::where('shop_id',auth()->user()->shop_id)->get();
        return view('Menuses/create',compact('categories'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'goods_name'=>'required|max:15',
            'goods_img'=>'required',
            'category_id'=>'required',
            'goods_price'=>'required',
        ],[
            'goods_name.required'=>'菜名不能为空!',
            'goods_name.max'=>'菜名不能超过十个字!',
            'category_id.required'=>'分类名不能为空!',
            'goods_img.required'=>'图片不能为空!',
            'goods_price.required'=>'价格不能为空!',
        ]);
       // $goods_img = $request->file('goods_img')->store('public/goods_img');
       // $goods_img = Storage::url($goods_img);
      // $storage = Storage::disk('oss');
      // $fileName = $storage->putFile('goods_img',$request->goods_img);
        Menuses::create([
            'goods_name'=>$request->goods_name,
//            'goods_img'=>$storage->url($fileName),
             'goods_img'=>$request->goods_img,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips??'暂无',
            'rating'=>0,
            'shop_id'=>auth()->user()->shop_id,
            'month_sales'=>0,
            'rating_count'=>0,
            'satisfy_count'=>$request->satisfy_count,
            'satisfy_rate'=>0,
        ]);
        return redirect()->route('menuses.index')->with('success','添加成功!');
    }
    //修改菜品
    public function edit(Menuses $menus)
    {

        $categories = MenuCategory::where('shop_id',auth()->user()->shop_id)->get();
        return view('menuses.edit',compact('menus','categories'));
    }

    public function update(Menuses $menus,Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required|max:15',
            'category_id'=>'required',
            'goods_price'=>'required',
        ],[
            'goods_name.required'=>'菜名不能为空!',
            'goods_name.max'=>'菜名不能超过十个字!',
            'category_id.required'=>'分类名不能为空!',
            'goods_price.required'=>'价格不能为空!',
        ]);
//        $data = [
//            'goods_name'=>$request->goods_name,
//            'category_id'=>$request->category_id,
//            'goods_price'=>$request->goods_price,
//            'description'=>$request->description,
//            'tips'=>$request->tips,
//            'good_img'=>$request->goods_img
//        ];
        //dd($data);
//        $img = $request->file('goods_img');
//        if ($img){
//            $img = Storage::url($img->store('public/goods_img'));
//            $data['goods_img'] = $img;
//        }
        $menus->update([
                'goods_name'=>$request->goods_name,
                'category_id'=>$request->category_id,
                'goods_price'=>$request->goods_price,
                'description'=>$request->description,
                'tips'=>$request->tips,
                'goods_img'=>$request->goods_img
        ]);
        return redirect()->route('menuses.index')->with('success','修改成功!');
    }
    //删除菜品
    public function destroy(Menuses $menus)
    {
        $menus->delete();
        return redirect()->route('menuses.index')->with('success','删除成功!');
    }

}
