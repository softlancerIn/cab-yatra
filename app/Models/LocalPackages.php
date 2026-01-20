<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalPackages extends Model
{
    use HasFactory;

    protected $table = 'local_packages';
    protected $guarded = [];

    public function timeData()
    {
        return $this->hasOne(TimeSchadule::class, 'id', 'time');
    }
}
