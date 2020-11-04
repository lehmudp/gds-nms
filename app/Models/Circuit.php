<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    use HasFactory;
    protected $fillable = [
        'ntt_cid',
        'name',
        'customer_id',
        'tt2_id',
        'province',
        'site_description',
        'address',
        'al_type',
        'cable_type',
        'customer_contact',
        'recipient_to',
        'recipient_cc',
        'recipient_bcc',
        'po_number',
        'po_description',
        'config',
        'note',
        'update_note'
    ];
}
