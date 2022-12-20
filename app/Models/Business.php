<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    use HasFactory;

    protected $table = 'businesses';
    protected $fillable = ['title', 'description', 'user_id', 'image_url', 'phone', 'address', 'employees'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class)->orderByDesc('created_at');
    }


    public function scopeSelectVisibleData($q, $businessId)
    {
        if (auth()->check() && (auth()->user()->isPremium() || auth()->user()->isOwner($businessId))) {
            return $q->addSelect('phone', 'address', 'employees');
        }
        return $q;
    }


}
