<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = "items";
    protected $primaryKey = "id";

    protected $fillable = ['item_name', 'unit'];

    public function stocks()
    {
        return $this->hasMany('App\Models\Stock');
    }

    public function issuings()
    {
        return $this->hasMany('App\Models\Issuing');
    }

    public function getTotalQuantity()
    {
        $stocks =  $this->stocks()->where('item_id', $this->id)->sum('quantity');
        $issuings = $this->issuings()->where('item_id', $this->id)->sum('quantity');
        return $stocks - $issuings;
    }

    public function presentItemQuantityWithBadge()
    {
        $quantity =  $this->getTotalQuantity();
        switch (true) {
            case $quantity <= 10:
                return "<span class='badge badge-pill badge-warning'>" . $quantity . "</span>";
                break;
            case $quantity > 10 && $quantity < 50:
                return "<span class='badge badge-pill badge-primary'>" . $quantity . "</span>";
                break;
            case $quantity >= 50:
                return "<span class='badge badge-pill badge-success'>" . $quantity . "</span>";
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($item) {
            $item->stocks()->delete();
            $item->issuings()->delete();
        });
    }
}
