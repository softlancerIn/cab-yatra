<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetainOffTransaction extends Model
{
    use HasFactory;

    protected $table = 'retain_offTransations';
    protected $guarded = [];
}
