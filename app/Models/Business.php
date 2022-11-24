<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = ['title','description', 'user_id', 'image_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function createNew($data)
    {
       return auth()->user()->businesses()->create($data);
//        dd($data);
    }
}
