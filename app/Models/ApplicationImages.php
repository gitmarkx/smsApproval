<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'imgSrc'
    ];

    public function applications(){
        return $this->hasMany(Application::class, 'app_id');
    }
}
