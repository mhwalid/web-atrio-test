<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'company_name', 'position', 'start_date', 'end_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}