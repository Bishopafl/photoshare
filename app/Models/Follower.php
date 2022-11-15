<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * All followers belong to a user
     * 
     * @param int $following_id
     * @param int $id
     * 
     * @return $following_id
     */
    public function userfollow() {
        return $this->belongsTo(User::class, 'following_id', 'id');
    }
}
