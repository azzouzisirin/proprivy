<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'is_authorized', 'authorized_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
