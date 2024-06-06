<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class)->limit(5);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
