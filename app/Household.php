<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App;

class Household extends Model
{

    /**
     * @var string
     */
    protected $table = 'household';

    /**
     * @var array
     */
    protected $fillable = [
        'coordinatesX',
        'coordinatesY',
        'imagePathMain',
        'imagePathThumbnail',
    ];

    /**
     * Get the Sessions for the Household
     */
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function toFormattedArray()
    {
        return [
            'id' => $this->id,
            'long' => $this->coordinatesX,
            'lat' => $this->coordinatesY,
            'image_path' => $this->imagePathMain,
            'thumbnail_path' => $this->imagePathThumbnail,
            'rating' => true,
        ];
    }

}