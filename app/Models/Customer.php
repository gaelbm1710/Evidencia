<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'customer_number',
        'fiscal_data',
        'delivery_address',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
