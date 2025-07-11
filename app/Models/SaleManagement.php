<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleManagement extends Model
{
    use HasFactory;
    protected $table = 'sale_managements';
    protected $fillable = [
        'sale_code',
        'customer_id',
        'fuel_type_id',
        'vichle_number',
        'quantity',
        'unit_price',
        'total_price',
        'sale_date',
        'note',
        'updated_by',
        'delete_status',
        'delete_by',
        'status',
        'payment_method',
        'employee_id',
        'discount',
        'tax',
        'deleted_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
