<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title','description'];
    protected $appends = ['created_at_friendly'];

    public function questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function submissions(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function getCreatedAtFriendlyAttribute(): ?string
    {
        return $this->attributes['created_at'] ? Carbon::parse($this->attributes['created_at'])->format('jS F Y, g:ia') : null;
    }
}
