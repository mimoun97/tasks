<?php
/**
 * Created by PhpStorm.
 * User: mimoun
 * Date: 22/11/18
 * Time: 20:15
 */

namespace App;


use Carbon\Carbon;

trait FormattedDates
{
    public function getCreatedAtFormattedAttribute()
    {
        //carbon
        return optional($this->created_at)->format('h:s:sA d-m-Y');

    }

    public function getCreatedAtHumanAttribute()
    {
        Carbon::setLocale(config('app.locale'));
        return optional($this->created_at)->diffForHumans(Carbon::now());
    }

    public function getCreatedAtTimestampAttribute()
    {
        return optional($this->created_at)->timestamp;
    }

    public function getUpdatedAtFormattedAttribute()
    {
        return optional($this->updated_at)->format('h:s:sA d-m-Y');
    }

    public function getUpdatedAtHumanAttribute()
    {
        Carbon::setLocale(config('app.locale'));
        return optional($this->updated_at)->diffForHumans(Carbon::now());
    }
}
