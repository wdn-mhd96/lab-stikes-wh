<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventoryMovement extends Model
{
    protected $table ="inventory_movements";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        "inventory_id",
        "user_id",
        "quantity",
        "quantity_before",
        "quantity_after",
        "movement_type",
        "comment",
    ];

    public function inventory() {
        return $this->belongsTo(Inventory::class, "inventory_id", "id");
    }

    public function user() {
        return $this->belongsTo(user::class, "user_id", "id");
    }
}
