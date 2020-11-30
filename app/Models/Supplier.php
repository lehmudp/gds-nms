<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_name',
        'level',
        'contact_name',
        'contact_title',
        'contact_phone_number',
        'contact_email',
        'group_key',
        'group_value',
        'note',
    ];
}
