<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Household;

class Controller extends BaseController
{

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

        $household = Household::where('coordinatesX','LIKE', '%'.$xCharacter.'%')
            ->where('coordinatesY','LIKE', '%'.$yCharacter.'%')
            ->get();

        if($household){
            return $household->toJson();
        }

        $error = 'No Household Found';

        return $error;
    }
}
