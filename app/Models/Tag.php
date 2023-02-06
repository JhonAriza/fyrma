<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;


    public function contracts() {
        return $this->hasMany('App\Models\contract', 'document_id', 'contract_id');
    }
    
}
