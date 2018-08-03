<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menuses extends Model
{
    //
    protected $fillable = [
        'goods_name',
        'rating',
        'shop_id',
        'category_id',
        'goods_price',
        'description',
        'month_sales',
        'rating_count',
        'tips',
        'satisfy_count',
        'satisfy_rate',
        'goods_img',
    ];

    //建立与分类的关系
    public function menucategory()
    {
        return $this->belongsTo(Menucategory::class,'category_id','id');
    }
 //建立与店铺的关系
    public function shop_category()
    {
        return $this->belongsTo(Shopscategory::class,'shop_id','id');
    }


}
