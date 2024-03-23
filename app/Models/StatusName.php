<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusName extends Model
{
    use HasFactory;

    // The table name is explicitly defined because Laravel would pluralize StatusName to status_names by default
    protected $table = 'status_names';

    // Relationship to Package through package_status pivot table
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_status', 'status_id', 'package_id');
    }
}
