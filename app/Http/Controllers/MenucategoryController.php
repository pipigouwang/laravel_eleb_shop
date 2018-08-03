<?php

namespace App\Http\Controllers;

use App\Models\Menucategory;
use App\Models\Menuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MenucategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index']
        ]);
    }

    public function index()
    {
       // echo'1';
        $menucategories=Menucategory::paginate(5);
        return view('menucategory/index', compact('menucategories'));
    }

    public function create()
    {
        return view ('menucategory/create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            //'name'=> 'required||unique:users',
            'name'=>'required',
            'description'=>'required'
        ],[
            'name.required'=>"分类名称不能为空",
            //'name.unique'=>"分类名称已存在",
            'description.required'=>"描述不能为空"
        ]);
        $shop_id=Auth::user()->shop_id;
        $type_accumulation =uniqid();
        $count =Menucategory::all()->count();
       // dd($request->name);die;
        if ($count<1){
         Menucategory::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'shop_id'=>$shop_id,
                'is_selected'=>1,
                'type_accumulation'=>$type_accumulation
            ]);
        }else{
            Menucategory::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'shop_id'=>$shop_id,
                'is_selected'=>0,
                'type_accumulation'=>$type_accumulation
            ]);
        }
        session()->flash('success', '添加菜单分类成功');
        return redirect()->route('menucategory.index');
    }

    public function edit(Menucategory $menucategory)
    {
        return view('menucategory/edit',compact('menucategory'));
    }

    public function update(Request $request,Menucategory $menucategory)
    {
        $this->validate($request, [
//            'name'=>[
//                'required',
//                Rule::unique('menu_categories')->ignore($menucategory->id, 'id'),
//            ],
//            'description'=>'required'
//        ],[
//            'name.required'=>"分类名称不能为空",
//            'name.unique'=>"分类名称已存在",
//            'description.required'=>"描述不能为空"
            //'name'=> 'required||unique:users',
            'name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => "分类名称不能为空",
            //'name.unique'=>"分类名称已存在",
            'description.required' => "描述不能为空"
        ]);
        $is_selected = $request->is_selected;
        if ($is_selected != 1) {
            $is_selected = 0;
        }
        $menucategory->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_selected' => $is_selected
        ]);
        $count = Menucategory::where('is_selected', 1)->count();
        if ($count < 1) {
            $menucategory->update([
                'is_selected' => 1
            ]);
            session()->flash('danger', '当前有且一个分类,如果想设置为默认分类,请设置其他为默认分类');
            return back();
        }
        if($count>1){//表单上只有一个状态
                DB::table('menucategories')->update([
                    'is_selected' => 0
                ]);
            DB::table('menucategories')->where('id',$menucategory->id)->update([
                        'is_selected' => 1
                    ]);
        }
       return  redirect()->route('menucategory.index');
    }

    public function destroy(Menucategory $menucategory)
    {
        $count =Menuses::all()->where('category_id',$menucategory->id)->count();
        if ($count>0){
            session()->flash('success', '该分类中有菜品不能删除');
            return back();
        }else{
            $menucategory->delete();
            session()->flash('success', '删除分类成功');
            return redirect()->route('menucategories.index');
        }
    }
}
