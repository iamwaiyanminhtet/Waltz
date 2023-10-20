<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','category_id','sub_category_id','price','description', 'image','availability','view_count','featured','year','sorting_word'];
}
