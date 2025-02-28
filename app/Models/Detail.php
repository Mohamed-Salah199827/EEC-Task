<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'key',
        'value',
        'type',
        'icon',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
