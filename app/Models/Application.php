<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Application extends Model
{
    // use Searchable;
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'branch_id',
        'verify_id',
        'salesAccount',
        'transactionType',
        'dealerSalesAccount',
        'desiredUnit',
        'bip',
        'status',
        'bracket',
        'notes',
        'recommendation',
        'releasedUnit'
    ];

    // public function toSearchableArray()
    // {
    //     return [
    //         ''
    //     ];
    // }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function applicationImages(){
        return $this->hasMany(ApplicationImages::class, 'app_id');
    }
}
