<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FooterLinkCategory;

class FooterLink extends Model
{
    use HasFactory;

    protected $table = 'footer_links';
    protected $guarded = [];

    /**
     * Get the user that owns the FooterLink
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(FooterLinkCategory::class, 'footlnk_catId', 'id');
    }
}
