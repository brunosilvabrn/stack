<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected  $primaryKey = 'slug';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'description',
        'code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
