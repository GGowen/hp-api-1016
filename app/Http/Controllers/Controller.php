<?php

namespace App\Http\Controllers;

use App\Household;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Submission;

class Controller extends BaseController
{

    /**
     * Creates a household and returns the household in JSON.
     * 
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createHousehold(Request $request)
    {
        $lat = $request->input('lat');
        $long = $request->input('long');
        $base64Image = $request->input('image');
        $imagePaths = Household::saveImage($base64Image);
        $household = new Household([
            'coordinatesX' => $lat,
            'coordinatesY' => $long,
            'imagePathMain' => $imagePaths['image'],
            'imagePathThumbnail' => $imagePaths['thumb'],
        ]);
        $household->save();

        return response()->json($household->toFormattedArray());
    }

    public function createSubmission(Request $request){

        $houseId = $request->input('household_id');
        $rating = $request->input('Rating');

        $submission = new Submission();


    }






    public function getHouseholds($x, $y,$type)
    {
        if($type == 'L') {
            $scaleLength = 7;
        }elseif($type == 'S'){
            $scaleLength = 9;
        }

        if(!strpos($x,'-')){
            $xCharacter = str_replace('-','',$x);
            $xCharacter = substr($xCharacter,0,$scaleLength);
        }else{
            $xCharacter = substr($x,0,$scaleLength);
        }
        if(!strpos($y,'-')){
            $yCharacter = str_replace('-','',$y);
            $yCharacter = substr($yCharacter,0,$scaleLength);
        }else{
            $yCharacter = substr($y,0,$scaleLength);
        }

        $households = Household::where('coordinatesX','LIKE', '%'.$xCharacter.'%')
            ->where('coordinatesY','LIKE', '%'.$yCharacter.'%')
            ->get();

        $finalHouseholds = [];
        foreach($households as $household) {
            /**
             * @param Household $household
             */
            $finalHouseholds[] = $household->toFormattedArray();
        }

        return response()->json($finalHouseholds);
    }
}
