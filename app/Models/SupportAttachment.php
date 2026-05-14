<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_message_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function message()
    {
        return $this->belongsTo(SupportMessage::class, 'support_message_id');
    }
}
