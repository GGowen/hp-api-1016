<?php

namespace App\Http\Controllers;

use App\Household;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

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
        $household = new Household([
            'coordinatesX' => $lat,
            'coordinatesY' => $long,
            'imagePathMain' => false,
            'imagePathThumbnail' => false,
        ]);
        $household->save();

        return response()->json($household->toFormattedArray());
    }

    /**
     * @param $x
     * @param $y
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHouseholds($x, $y)
    {
        $scaleLength = 7;

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
