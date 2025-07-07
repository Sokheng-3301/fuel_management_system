<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftSelect extends Model
{
    use HasFactory;
    protected $table = 'shift_selects';
    protected $fillable = [
        'shift_kh',
        'shift_en',
        'delete_status',
        'created_by',
        'updated_by',
        'delete_by',
        'deleted_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
