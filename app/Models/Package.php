<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function statuses()
    {
        return $this->belongsToMany(StatusName::class, 'package_status', 'package_id', 'status_id')
                    ->withTimestamps('timestamp');
    }
}


