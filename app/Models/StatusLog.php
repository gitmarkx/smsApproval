<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'status',
        'user_id',
    ];

    public function applications(){
        return $this->hasMany(Application::class, 'app_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
