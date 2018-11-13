<?php

namespace App\Http\Controllers\Api\Auth\Supervisores;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginSupervisoresController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = Client::find(1);
    }

    public function login(Request $request)
    {
      /*  $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);*/
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
        //return response()->json( $datos=['datos'] );

        }

       

    }

    public function logout(Request $request)
    {
      $accessToken = Auth::user()->token();

      DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked' => true]);

      $accessToken->revoke();

      return response()->json([], 204);


    }
}
