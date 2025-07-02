<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    use HasFactory;
    protected $table = 'fuel_types';

    protected $fillable = [
       'fuel_type_kh',
       'fuel_type_en',
       'today_price',
       'created_by',
       'updated_date',
       'updated_by',
       'delete_status',
       'deleted_by',
       'deleted_date',
       'visibility',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }



}
