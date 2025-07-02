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


    
}
