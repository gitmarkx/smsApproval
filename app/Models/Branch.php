<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // Manually declare table whene the migration file table name is not plural
    protected $table = 'branch';

    protected $fillable = [
        'key',
        'description'
    ];

    public function applications(){
        return $this->hasMany(Application::class, 'branch_id');
    }

    public function users(){
        return $this->hasMany(User::class, 'users_id');
    }
}
