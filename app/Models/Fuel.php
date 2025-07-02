<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $table = 'fuels';

    protected $fillable = [
        'fuel_type_id',
        'supplier_id',
        'fuel_specification',
        'qty',
        'unit_price',
        'total_price',
        'fuel_code',
        'note',
        'created_by',
        'updated_date',
        'updated_by',
        'delete_status',
        'deleted_by',
        'deleted_date',
    ];

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
