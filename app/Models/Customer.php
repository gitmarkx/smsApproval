<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'contactNo',
        'address'
    ];

    public function toSearchableArray()
    {
        return [
            'id'    => $this->id,
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname
        ];
    }

    public function applications(){
        return $this->hasMany(Application::class, 'customer_id');
    }
}
