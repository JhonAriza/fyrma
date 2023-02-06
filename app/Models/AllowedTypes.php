<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedTypes extends Model
{
    use HasFactory;

    public static function MyAllowedTypes($id) {
        return AllowedTypes::where([["id", $id]])->get();
    }
    public static function MyAllowedTypesByAccept($accept) {
        return AllowedTypes::where('accept', 'LIKE', '%'.$accept.'%')->get();
    }
}
