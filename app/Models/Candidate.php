<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    public function cvs()
    {
        return $this->hasMany(CV::class)->limit(2);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
