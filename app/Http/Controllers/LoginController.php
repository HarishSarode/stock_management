<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\LoginController as ApiLoginController;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request) {
        try {
            $loginApi = 'http://127.0.0.1:8000/api/login';
            // $httpClient = new Client;
            // $httpClient->request('POST', $loginApi, $request->all());
            // $httpClient = Http::post($loginApi, $request->all());
            // dd($request->all());

            $login = ApiLoginController::login($request);
            $data = $login->getOriginalContent();
            if (isset($data['error'])) {
                return back()->with('error', $data['message']);
            }
            // dd(Auth::user());
            Session::put('token', $data['token']);
            return redirect('stocks/list');
        } catch (\Exception $e) {
            dD($e);
            Log::error('Login API error : ' . $e->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function logout() {
        try {
            $loginApi = 'http://127.0.0.1:8000/api/logout';
            $userId = Auth::user()->id;
            $request = new Request();
            $request->merge(['id' => $userId]);
            $login = ApiLoginController::logout($request);
            $data = $login->getOriginalContent();
            if (isset($data['error'])) {
                return back()->with('error', $data['message']);
            }
            Auth::logout();
            return redirect('');
        } catch (\Exception $e) {
            Log::error('Login API error : ' . $e->getMessage());
            return back()->with('error', 'Something went wrong!');
        }
    }
}
