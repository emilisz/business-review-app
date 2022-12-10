<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'comment', 'business_id', 'user_id'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function createNew(Business $business, $data)
//    {
//        return self::create([
//            ...$data,
//            ...['business_id' =>  $business->id, 'user_id' => auth()->id()]
//            ]);
//    }

}
