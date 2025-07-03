<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'fullname_kh',
        'fullname_en',
        'phone',
        'email',
        'address',
        'note',
        'customer_code',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_date',
        'deleted_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function deletedByUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
