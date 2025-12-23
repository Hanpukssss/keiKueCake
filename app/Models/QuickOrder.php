<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QuickOrder extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'phone',
        'product',
        'qty',
        'date_required',
        'notes',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (QuickOrder $order): void {
            if (empty($order->uuid)) {
                $order->uuid = (string) Str::uuid();
            }
        });
    }
}
