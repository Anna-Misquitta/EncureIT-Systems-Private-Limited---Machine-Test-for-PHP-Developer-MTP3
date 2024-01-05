<?php

namespace App\Http\Controllers;

use App\Models\UserMaster;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.form');
    }

    public function saveData(Request $request)
    {
        $startTime = microtime(true);

        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $execution_time = microtime(true) - $startTime;
        // Save data to the database
        UserMaster::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'execution_time' => $execution_time,
        ]);

        // Get IP Address
        $ip_address = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        if ($request->header('x-forwarded-for')) {
            $ip_address = $request->header('x-forwarded-for');
        }
        // Get City & State from IP Address
        $city_state_data = self::getCityState($ip_address);

        $return_array = [
            'execution_time' => $execution_time,
            'ip_address' => $ip_address,
            'city' => $city_state_data->city ?? 'No data Available',
            'state' => $city_state_data->region ?? 'No data Available',
        ];

        // Store IP address and geolocation data in a cookie which expires in one hour
        setcookie('ip_address', $return_array['ip_address'], time() + 3600); 
        setcookie('city', $return_array['city'], time() + 3600);
        setcookie('state', $return_array['state'], time() + 3600);
        
        return redirect()->route('form')->with('success', $return_array);
    }

    function getCityState($ip)
    {
        $token = '70645a89aba33c';
        $apiUrl = "https://ipinfo.io/{$ip}?token={$token}";
        $geoData = json_decode(file_get_contents($apiUrl));
        return $geoData;
    }
}
