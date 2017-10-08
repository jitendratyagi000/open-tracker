<?php

namespace App\Http\Controllers;

use App\Token;
use App\TokenAnalytics;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
    	return Token::with('analytics')->get();
    }

    /**
     * @return array
     */
    public function create()
    {
    	Token::create(['token' => sha1(uniqid(env('SALT'), true))]);

    	return ['ok'];
    }

    /**
     * @param Request $request
     * @param $token
     */
    public function storeAnalytics(Request $request, $token)
    {
    	if ($tokenObj = Token::where('token', $token)->first()) {
    		$anylytics = new TokenAnalytics([
    			'ip_address' => $request->ip(),
    			'user_data' => $request->header('User-Agent'),
    		]);

			$anylytics->token()->associate($tokenObj);
			$anylytics->save();

			$tokenObj->setOpenCount($tokenObj->getOpenCount());
			$tokenObj->setOpenUniqueCount($tokenObj->getUniqueOpenCount());
			$tokenObj->save();
    	}
    }

    /**
     * @param $token
     * @return mixed
     */
    public function tokenAnalytics($token)
    {
    	return Token::where('token', $token)->with('analytics')->get();
    }
}
