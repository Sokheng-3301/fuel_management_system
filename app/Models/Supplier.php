<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = [
        'fullname_kh',
        'fullname_en',
        'email',
        'phone',
        'address',
        'created_by',
        'delete_status',
        'deleted_by',
        'deleted_date',
    ];
    protected $casts = [
        'delete_status' => 'integer',
        'deleted_date' => 'datetime',
    ];

    public function fuels()
    {
        return $this->hasMany(Fuel::class, 'supplier_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
