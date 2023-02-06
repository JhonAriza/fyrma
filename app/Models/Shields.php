<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shields extends Model
{
    use HasFactory;

    public static function name($id) {
        return Shields::find($id)->select('name')->first()->name;
    }

}
