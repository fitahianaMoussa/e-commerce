<?php

namespace App\Models;

use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    protected $fillable = ['total_price','status','session_id','user_address_id','created_by','updated_by'];
    use HasFactory;

    function order_items()
    {
        return $this->hasMany(OrderItems::class); 
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
