<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{


        protected $fillable = [
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'message',
        ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getGenderTextAttribute()
    {
        $map = [1 => '男性', 2 => '女性', 3 => 'その他'];

        // もし数字ならマップで変換、文字列ならそのまま返す
        if (is_numeric($this->gender)) {
            return $map[$this->gender] ?? '未分類';
        }

        return $this->gender ?: '未分類';
    }



}
