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

    public static function saveImage($base64) {
        $base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));

        $public_path = rtrim(app()->basePath('public/'), '/');
        $time = time();
        $pub_url_path = '/img/households/';
        $file_path = $public_path . $pub_url_path;
        $image_name = "{$time}.png";
        $thumb_name = "{$time}_thumb.png";

        file_put_contents($file_path . $image_name, $base64);
        file_put_contents($file_path . $thumb_name, $base64);

        return [
            'image' => $pub_url_path . $image_name,
            'thumb' => $pub_url_path . $thumb_name,
        ];
    }

}