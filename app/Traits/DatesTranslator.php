<?php
namespace App\Traits;

use Jenssegers\Date\Date;

trait DatesTranslator
{
    public function getCreatedAtaAttribute($created_at)
    {
        return new Date($created_at);
    }
}