<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'comment_content',
        'comment_date',
        'reviewer_name',
        'reviewer_name_email',
        'is_hidden',
        'user_id',
        'post_id'
    ];

    protected $casts = [
        'comment_date' => 'datetime',
        'is_hidden' => 'boolean'
    ];

    public $timestamps = false;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
