<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['content'];
    protected $casts = [
        'content' => 'array',
    ];
    protected $appends = ['created_at_friendly'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getCreatedAtFriendlyAttribute(): ?string
    {
        return $this->attributes['created_at'] ? Carbon::parse($this->attributes['created_at'])->format('jS F Y, g:ia') : null;
    }
}
