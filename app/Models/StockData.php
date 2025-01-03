<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['item_code', 'item_name', 'quantity', 'location', 'store_id', 'in_stock_date'];
    protected $appends = ['store_name'];

    public function store() {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function getStoreNameAttribute() {
        return $this->store->store_name ?? '';
    }
}
