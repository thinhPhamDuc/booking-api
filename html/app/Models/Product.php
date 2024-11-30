<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($diagnos) {
            $maxOrderNum = Product::where('user_id', $diagnos->user_id)
                ->where('loan_id', $diagnos->loan_id)
                ->max('order_num');

            $diagnos->order_num = $maxOrderNum !== null ? $maxOrderNum + 1 : 0;
        });
    }
}
