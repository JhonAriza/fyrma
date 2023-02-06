<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachmentdocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'attachmentdocument_document',
    ];

    public static function AttachmentsGroup($id) {
        return Attachmentdocuments::where('contract_id', $id)->groupBy('attachmentdocument_name')->select('attachmentdocument_name','allowed_types_id','comment')->get()->toArray();
    }

    public static function AttachmentsContract($id) {
        return Attachmentdocuments::where('contract_id', $id)->get();
    }

    public static function MyAttachments($id, $participant) {
        return Attachmentdocuments::where([["contract_id", $id],['participant', $participant]])->get();
    }

    public function FileExtension() {
        return $this->hasOne('App\Models\AllowedTypes', 'id', 'allowed_types_id');
    }
}
