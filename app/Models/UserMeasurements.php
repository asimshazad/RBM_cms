<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeasurements extends Model
{
     protected $table = 'user_measurements';

     protected $fillable = ['cat_id', 'customer_id','description'];
}
