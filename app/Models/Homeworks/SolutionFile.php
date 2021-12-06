<?php

namespace App\Models\Homeworks;

use App\Models\FileStorage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionFile extends Model
{
    use HasFactory;

    protected $table = 'solution_files';

    protected $fillable = [
        'solution_id',
        'file_id',
    ];

    public function solution()
    {
        return $this->hasOne(Solution::class, 'id', 'solution_id');
    }

    public function file()
    {
        return $this->hasOne(FileStorage::class, 'id', 'file_id');
    }
}
