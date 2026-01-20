<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchEnquiry extends Model
{
    use HasFactory;

    protected $table = 'search_enquiry';
    protected $guarded = [];
}
