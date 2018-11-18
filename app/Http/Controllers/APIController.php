<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function index(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://app.alegra.com/api/v1/invoices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        
        curl_setopt($ch, CURLOPT_USERPWD, "oscarclarke9900@gmail.com" . ":" . "c281d34ba649cc19e499");
        
        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;      
    }
    public function store(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://app.alegra.com/api/v1/invoices/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"date\": \"".$request->fecha."\", \"dueDate\": \"".$request->fecha."\", \"client\":  1, \"items\" : [ { \"id\": 1, \"price\" : 30, \"quantity\" : ".$request->tiempo." }]}");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "oscarclarke9900@gmail.com" . ":" . "c281d34ba649cc19e499");
        
        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        return $result;              
    }
}
