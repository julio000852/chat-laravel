<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'contant'
    ];

    protected $appends = [
        'data_message'
    ];

    public function getDataMessageAttribute()
    {
        return Carbon::parse($this->created_at)->format('m/d/Y H:m:s');
    }
}
