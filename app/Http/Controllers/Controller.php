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
}
