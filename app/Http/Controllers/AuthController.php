<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client as OClient;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        // Check if a user with the specified email exists
        $user = User::where('email',request('email'))->first();
        if (!$user) {
            return response()->json([
                'error' => 'Wrong email or password',
            ], 422);
        }

        // belongs to this user
        if (!Hash::check(request('password'), $user->password)) {
            return response()->json([
                'error' => 'Wrong email or password',
            ], 422);
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $userRole = $user->role()->first();
            
            if ($userRole) {
                $this->scope = $userRole->role;
            }

            $oClient = OClient::where('password_client', true)->first();
            return $this->getTokenAndRefreshToken($oClient, request('email'), request('password'), $this->scope);
        }else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $password           = $request->password;
        $input              = $request->all();
        $input['password']  = bcrypt($input['password']);
        $user               = User::create($input);
        $oClient            = OClient::where('password_client', true)->first();

        return $this->getTokenAndRefreshToken($oClient, $user->email, $password, 'user');
    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password, $scope){
        $oClient = OClient::where('password_client', true)->first();
        $http = new Client;
        $url = env('APP_URL').'/oauth/token';

        $response = $http->request('POST', $url, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => $scope,
            ],
        ]);

        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, $this->successStatus);
    }

    public function details(){
        $user = Auth::user()->with('role')->first();
        return response()->json($user, $this->successStatus);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function unauthorized(){
        return response()->json('unaithorized', 401);
    }

    public function refreshToken(Request $request){
        $refresh_token = $request->header('Refreshtoken');
        $oClient = OClient::where('password_client', true)->first();
        $http = new Client;
        $url = env('APP_URL').'/oauth/token';

        try {
            $response = $http->request('POST', $url, [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refresh_token,
                    'client_id' => $oClient->id,
                    'client_secret' => $oClient->secret,
                    'scope' => '',
                ],
            ]);
                
            return json_decode((string) $response->getBody(), true);
        } catch (Exception $e) {
            return response()->json('unauthorized', 401);
        }
    }
}
