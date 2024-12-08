<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'birth_date'];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
