<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;
    
    public function document() {
        return $this->hasOne('App\Models\Documents', 'id', 'document_id');
    }
    
    public function trackings() {
        return $this->hasMany('App\Models\Trackings', 'contract_id', 'id');
    }
    
    public function sender() {
        return $this->hasOne('App\Models\User', 'id', 'owner')->select('email','name');
    }
}
