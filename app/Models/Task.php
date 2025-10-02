<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'is_completed', 'board_id']; // board_id ajouté au cas où (nullable)
    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
