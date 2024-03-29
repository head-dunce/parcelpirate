<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusName extends Model
{
    use HasFactory;

    //public function packages()
    //{
    //    return $this->hasMany(Package::class, 'status_id');
    //}

    public function packages()
    {
        return $this->hasMany(Package::class, 'status_id')->orderBy('created_at', 'desc');
    }


    // The table name is explicitly defined
    protected $table = 'status_names';

    // Define which model attributes can be mass-assigned
    protected $fillable = [
        'package_status_name', 
        'sort_order', 
        'print_export',
    ];


}
