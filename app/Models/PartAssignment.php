<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartAssignment extends Model
{
    public function parts()
    {
        return $this->belongsTo('App\Models\Part','part_id');
    }

}
