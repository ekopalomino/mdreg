<?php

namespace Erp\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $fillable = [
        'type',
        'reference_id',
        'inventory_id',
        'product_id',
        'warehouse_id',
        'incoming',
        'outgoing',
        'remaining',
        'notes',
    ];
    
}
