<?php

namespace App\Http\Controllers\Api;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerDriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:drivers,email',
            'phone_number' => 'required|string|max:20|unique:drivers,phone_number',
            'city' => 'required|string|max:30',
            'license_number' =>'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
            'car_type' => 'nullable|string|max:255',
            'car_color' => 'nullable|string|max:255',
            'car_number' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:0|max:5',
            'license_verification' => 'nullable|string',
            'driver_photo' => 'nullable|string',
            'car_photo' => 'nullable|string',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $driver = new Driver([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'license_number' => $request->license_number,
            'car_type' => $request->car_type,
            'car_color' => $request->car_color,
            'car_number' => $request->car_number,
            'rating' => 0,
            // 'license_verification' => $this->saveBase64Image($request->license_verification, 'license_verification'),
            // 'driver_photo' => $this->saveBase64Image($request->driver_photo, 'driver_photo'),
            // 'car_photo' => $this->saveBase64Image($request->car_photo, 'car_photo'), 
            'license_verification' => $request->license_verification,
            'driver_photo' =>  $request->driver_photo,
            'car_photo'=> $request->car_photo
        ]);
        $driver->save();
        return response()->json([
            'data'=>$driver,
            'statusCode' => 200
        ]);
    }
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:drivers,email',
            'phone_number' => 'nullable|string|max:20|unique:drivers,phone_number',
            'password' => 'required|string|min:6'
        ]);   
        if($validator->fails()) {
            return response()->json($validator->errors(),422);
        } 
        $user = new User([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);
        $user->save();    
        return response()->json([
            'data'=>$user,
            'statusCode' => 200
        ]);
    }
    public function loginUser(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'method' => 'required|string|max:255',
            'password' => 'required|string'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors());
        }
        // Get credentials based on the login method
        if ($request->method == 'email') {
            $credentials = $request->only('email', 'password');
        } else {
            $credentials = $request->only('phone_number', 'password');
        }

        if(!Auth::guard('web')->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 404);
        }
        if ($request->method == 'email') {
            $driver = User::where('email', $request->email)->firstOrFail();
        } else {
            $driver = User::where('phone_number', $request->phone_number)->firstOrFail();
        }
        
        $token = $driver->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message'=>'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'statusCode' => 200
        ]);
    }
    public function loginDriver(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'method' => 'required|string|max:255',
            'password' => 'required|string'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors());
        }
        // Get credentials based on the login method
        if ($request->method == 'email') {
            $credentials = $request->only('email', 'password');
        } else {
            $credentials = $request->only('phone_number', 'password');
        }
        

        // return response()->json($credentials,200);

        if(!Auth::guard('driver-web')->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 404);
        }
        if ($request->method == 'email') {
            $driver = Driver::where('email', $request->email)->firstOrFail();
        } else {
            $driver = Driver::where('phone_number', $request->phone_number)->firstOrFail();
        }
        
        $token = $driver->createToken('auth_token')->plainTextToken;
        // return response()->json(['message' => "Use exist"],200);
        return response()->json([
            'message'=>'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'statusCode' => 200
        ]);
    }
    public function logoutDriver()
    {

    }
    private function saveBase64Image($base64Image, $folder)
    {
        $image = str_replace('data:image/png;base64,', '', $base64Image);
        $image = str_replace('data:image/jpg;base64,', '', $base64Image);
        $image = str_replace('data:image/jpeg;base64,', '', $base64Image);
        $image = str_replace(' ', '+', $image);
        $imageName = time() . '_' . uniqid() . '.png';
        Storage::disk('public')->put('assets/img/' . $folder . '/' . $imageName, base64_decode($image));
        return 'assets/img/' . $folder . '/' . $imageName;
    }
    //
}
