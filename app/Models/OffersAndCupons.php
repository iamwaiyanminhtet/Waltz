<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffersAndCupons extends Model
{
    use HasFactory;
    protected $fillable = ['label_name','description','image','coupon_code'];
}
