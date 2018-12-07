<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = Client::find(1);
    }

    public function login(Request $request)
    {

        $validator=\Validator::make($request->all(),[
    		'username' => 'required|email',
    		'password' => 'required|min:6',

        ]);

        if($validator->fails())
        {
         
          //return response()->json(['errors'=>$validator->errors()->all()]);
          // return response()->json( $datos='nO ' );
          return response()->json( $errors=$validator->errors()->all(), 401);
        }
        else
        {
            $user=DB::table('users as u')->where('u.email',request('username'))
            ->first();
            if (Hash::check(request('password'), $user->password)) {
                DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();

                $validar_token = DB::table('oauth_access_tokens')->where('user_id', $user->id)->first();
                $params = [
                    'grant_type' => 'password',
                    'client_id' => $this->client->id,
                    'client_secret' => $this->client->secret,
                    'username' => request('username'),
                    'password' => request('password'),
                    'scope' => '*'
                ];

                $request->request->add($params);
                $proxy = Request::create('oauth/token', 'POST');

                return Route::dispatch($proxy);
            }else{
                $validar_token = DB::table('oauth_access_tokens')->where('user_id', $user->id)->first();
                $params = [
                    'grant_type' => 'password',
                    'client_id' => $this->client->id,
                    'client_secret' => $this->client->secret,
                    'username' => request('username'),
                    'password' => request('password'),
                    'scope' => '*'
                ];

                $request->request->add($params);
                $proxy = Request::create('oauth/token', 'POST');

                return Route::dispatch($proxy);
            }
            
            

            
            //return response()->json( $datos=['datos'] );

    
        }
       

    }

    public function refresh(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required'
        ]);
        
        $params = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => request('username'),
            'password' => request('password')
        ];

        $request->request->add($params);

         $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
    }


    public function logout(Request $request)
    {
      $accessToken = Auth::user()->token();

      DB::table('oauth_access_tokens')->where('user_id', Auth::id())->delete();
      return response()->json(['message' => 'La sesion a sido cerrada con exito'], 200);



    }
}
