<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'contactNo',
        'address'
    ];

    public function applications(){
        return $this->hasMany(Application::class, 'customer_id');
    }
}
