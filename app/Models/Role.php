<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const USER = 1;
    const ADMIN = 2;
    const MARKETING = 3;
    const NETWORKING = 4;

    protected $fillable = [
        'title',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
