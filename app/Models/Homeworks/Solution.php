<?php

namespace App\Models\Homeworks;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $table = 'solutions';

    protected $fillable = [
        'description',
        'homework_id',
        'owner_id',
    ];

    public function homework()
    {
        return $this->hasOne(Homework::class, 'id', 'homework_id');
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }
}
