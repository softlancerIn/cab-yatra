<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterLinkCategory extends Model
{
    use HasFactory;

    protected $table = 'footer_link_category';
    protected $guarded = [];

    /**
     * Get all of the footerLik for the FooterLinkCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function footerLnk()
    {
        return $this->hasMany(FooterLink::class, 'footlnk_catId', 'id');
    }
}
