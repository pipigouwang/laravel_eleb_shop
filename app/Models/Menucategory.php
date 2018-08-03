<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menucategory extends Model
{

    protected $fillable=['name','type_accumulation','shop_id','description','is_selected'];

    //建立与商家的关系
    public function shopss()
    {
        return $this->belongsTo(Shops::class,'shop_id','id');
    }

    public function shopss_name()
    {
        return $this->shopss?$this->shopss->name:'无分类';
    }
}
