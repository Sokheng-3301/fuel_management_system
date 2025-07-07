<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PumpManagement extends Model
{
    use HasFactory;
    protected $table = 'pump_managements';

    protected $fillable = [
        'pump_code',
        'fuel_type_id',
        'created_by',
        'updated_by',
        'delete_status',
        'delete_by',
        'deleted_at',
        'status',
    ];


    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
