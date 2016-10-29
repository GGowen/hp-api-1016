<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App;
use App\Submission;

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
    public function submissions()
    {
        return $this->hasMany('App\submission');
    }

    public function getRating(){

        $submissionTrue = $this->submissions()->where('rating', 1)->get();
        $submissionFalse = $this->submissions()->where('rating', 0)->get();

        if($submissionTrue >= $submissionFalse){
            $rating = True;
            return $rating;
        }else{
            $rating = False;
            return $rating;
        }
    }

    public function toFormattedArray()
    {
        return [
            'id' => $this->id,
            'long' => $this->coordinatesX,
            'lat' => $this->coordinatesY,
            'image_path' => $this->imagePathMain,
            'thumbnail_path' => $this->imagePathThumbnail,
            'rating' => $this->getRating(),
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