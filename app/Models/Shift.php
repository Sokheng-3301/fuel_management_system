<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';

    protected $fillable = [
        'shift_name',
        'employee_id',
        'start_time',
        'end_time',
        'created_by',
        'updated_by',
        'delete_status',
        'delete_by',
        'deleted_at',
    ];
}
