<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rider;

class RiderController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function register(Request $request)
    {
        $rider = new Rider;
        $rider->name = $request->name;
        $rider->email = $request->email;
        $rider->password = bcrypt($request->password);
        $rider->phone_number = $request->phone_number;
        $rider->save();
        
        $response = [
            'statusCode' => true,
            'message' => "success",
        ];

        return response()->json($response, 200);
    }
}
