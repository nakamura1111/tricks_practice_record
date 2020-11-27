<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // use HasFactory;

    // テーブル・カラム設定
    protected $guarded = ['id'];                // AUTO_INCREMENTがついているからデータ保存の際に必要ない
    protected $table = 'category';              // テーブル名の設定
    public static $rules = [
        'name' => 'string|max:50'
    ];

    // // アソシエーション
    // public function prac_contents()
    // {
    //     return $this->hasMany('App\Models\PracContent');
    // }
}
