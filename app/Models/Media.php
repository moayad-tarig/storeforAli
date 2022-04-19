<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable =[
        'file_name',
        'file_type',
        'file_size',
        'file_status',
        'file_sort',
        'mediable_id',
        'mediable_type',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
