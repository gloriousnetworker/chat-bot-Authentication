<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // The fields that can be mass assigned
    protected $fillable = ['user_id', 'content'];

    // Define the relationship to the User model
    public function user() {
        return $this->belongsTo(User::class);  // A message belongs to a user
    }
}
