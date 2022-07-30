<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];
    protected $table = 'order_items';

    public function painting_tool()
    {
        return $this->belongsTo(PaintingTool::class, 'painting_tool_id');
    }
}
