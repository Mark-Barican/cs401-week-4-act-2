<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    protected $fillable = [
        'file_name',
        'file_type',
        'file_size',
        'url',
        'upload_date',
        'description',
        'post_id'
    ];

    protected $casts = [
        'upload_date' => 'datetime',
        'file_size' => 'integer'
    ];

    public $timestamps = false;
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
