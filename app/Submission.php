<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App;

class Submission extends Model
{

    /**
     * @var string
     */
    protected $table = 'submission';

    /**
     * The tags that belong to the image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', null, 'image_slug', 'tag_slug')->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function getNameAttribute()
    {
        $locale = App::getLocale();
        $attribute = "name_{$locale}";

        return $this->$attribute;
    }

    /**
     * @return mixed
     */
    public function getAltAttribute()
    {
        $locale = App::getLocale();
        $attribute = "alt_{$locale}";

        return $this->$attribute;
    }

}