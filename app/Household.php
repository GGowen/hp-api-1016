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
}