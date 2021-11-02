<?php

namespace App\Http\Controllers\Website\Payment\Telebirr;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\BookLanguage;
use phpseclib\Crypt\RSA as Crypt_RSA;

class TelebirrPaymentController extends Controller
{
    public function index()
    {
        $publickey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqGCaAwecE5QzyxP5QqioPimJVbyGVT213/OSti9w73l1S1VtB9GxZfDKNvmR4jq85v97utBVhhzdpY2H2KHAA/BXcJQqiSYJZhGK9jJpvr2ePJ4W//zCN5ZUPx0W90GYYdhUP2cub8sutR5k1owGGeiR5I1JaiZC2tA/fOyxMk+BavYcRDsiZHQD6Bki+kMMk0LCA1vLCPDQbwmkNVlQk5+y11YHN3NsN+lTBdTiTgOJU+NhIncvCiWI8A7FYOSvpO+llYo6oM5uoCSDT+Tc1SbCwGv0IH5XMvhqzIhfRl9+wXrXBc0h24N6ROJbi6kU86DJBH3rsaJ0cKyrJEsPbwIDAQAB";
        $appkey = "539521ca32a149d1af1bc3ce346026b5";
        $appid = "0e294831ec314689b88a5449312189b4";
        $appkey = "539521ca32a149d1af1bc3ce346026b5";
        $shortcode = "12";
        $baseUrl = "http://196.188.120.3:11443/ammapi/payment/service-openup";


        $rsa = new Crypt_RSA();
        $rsa->loadKey($publickey);
        $rsa->setEncryptionMode(2);
        $data = 'Your String';
        $output = $rsa->encrypt($data);
        dd(base64_encode($output));
    }

    public function test(){
        $publickey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqGCaAwecE5QzyxP5QqioPimJVbyGVT213/OSti9w73l1S1VtB9GxZfDKNvmR4jq85v97utBVhhzdpY2H2KHAA/BXcJQqiSYJZhGK9jJpvr2ePJ4W//zCN5ZUPx0W90GYYdhUP2cub8sutR5k1owGGeiR5I1JaiZC2tA/fOyxMk+BavYcRDsiZHQD6Bki+kMMk0LCA1vLCPDQbwmkNVlQk5+y11YHN3NsN+lTBdTiTgOJU+NhIncvCiWI8A7FYOSvpO+llYo6oM5uoCSDT+Tc1SbCwGv0IH5XMvhqzIhfRl9+wXrXBc0h24N6ROJbi6kU86DJBH3rsaJ0cKyrJEsPbwIDAQAB";

        // $rsa = new Crypt_RSA();
        // $rsa->loadKey($publickey);
        // $rsa->setEncryptionMode(2);
        // $data = 'Your String';
        // $output = $rsa->encrypt($data);
        // dd(base64_encode($output));

        // $result = base64_encode($output);

        //decrypt

        // $ciphertext = base64_decode(str_replace(' ', '+', $result));

        $rsa = new Crypt_RSA();
        $rsa->loadKey($publickey); // private key
        // $plaintext = $rsa->decrypt($ciphertext);
        // $result =  '<pre>' . $plaintext . '</pre>';


        $publickey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqGCaAwecE5QzyxP5QqioPimJVbyGVT213/OSti9w73l1S1VtB9GxZfDKNvmR4jq85v97utBVhhzdpY2H2KHAA/BXcJQqiSYJZhGK9jJpvr2ePJ4W//zCN5ZUPx0W90GYYdhUP2cub8sutR5k1owGGeiR5I1JaiZC2tA/fOyxMk+BavYcRDsiZHQD6Bki+kMMk0LCA1vLCPDQbwmkNVlQk5+y11YHN3NsN+lTBdTiTgOJU+NhIncvCiWI8A7FYOSvpO+llYo6oM5uoCSDT+Tc1SbCwGv0IH5XMvhqzIhfRl9+wXrXBc0h24N6ROJbi6kU86DJBH3rsaJ0cKyrJEsPbwIDAQAB";
        $appkey = "539521ca32a149d1af1bc3ce346026b5";
        $appid = "0e294831ec314689b88a5449312189b4";
        $appkey = "539521ca32a149d1af1bc3ce346026b5";
        $shortcode = "12";
        $baseUrl = "http://196.188.120.3:11443/ammapi/payment/service-openup";

        //Add Content-Type: application/json;charset=utf-8 on the request header
        $contentType = "application/json;charset=utf-8";



        //GENERATE USSD PARAMETER
        $ussdJson = '{'.
            'appId:"0e294831ec314689b88a5449312189b4",'.
            'appKey:"539521ca32a149d1af1bc3ce346026b5",'.
            'nonce:"'.time().'",'.
            'notifyUrl:"https://gizetest.mezagebtnet.com/telebirr/ipn",'.
            'outTradeNo:"'.time().'",'.
            'returnUrl:"https://gizetest.mezagebtnet.com/telebirr/return",'.
            'shortCode:"12",'.
            'subject:"test item",'.
            'timeoutExpress:"30",'.
            'timestamp:"'.time().'",'.
            'totalAmount:0.05,'.
            'receiveName:"Mezagebt"'.
        '}';

        //Perform RSA2048 encryption on ussdJson
        $rsa = new Crypt_RSA();
        $rsa->loadKey($publickey);
        $rsa->setEncryptionMode(2);
        $data = $ussdJson;
        $output = $rsa->encrypt($data);
        $ussd_parameter  = base64_encode($output);




        //GENERATE SIGN PARAMETER
        $stringA = 'appId=0e294831ec314689b88a5449312189b4,'.
            '&appKey=539521ca32a149d1af1bc3ce346026b5,'.
            '&nonce='.time().','.
            '&notifyUrl=https://gizetest.mezagebtnet.com/telebirr/ipn,'.
            '&outTradeNo='.time().','.
            '&receiveName=Mezagebt'.
            '&returnUrl=https://gizetest.mezagebtnet.com/telebirr/return,'.
            '&shortCode=12,'.
            '&subject=test item,'.
            '&timeoutExpress=30,'.
            '&timestamp='.time().','.
            '&totalAmount=0.05,';

        //Perform SHA-256 on stringA to obtain the signature value “sign”.
        $sign_parameter = hash('sha256', $stringA);



        //Initiate WebPay
        $url = $baseUrl . '/toTradeWebPay';

        // $response = Http::accept('application/json')->post($url);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json;charset=utf-8',
        ])->post($url, [
            'appId' => $appid,
            'sign' => $sign_parameter,
            'ussd' => $ussd_parameter
        ]);

        dd($response);



        return view('website.payment.telebirr.index', compact('result'));
    }


    public function IPN(){
        //Update IPN table
        $book_language = new BookLanguage();
        $book_language->language_name = "IPN Name";
        $book_language->language_native_name = "etst";
        $book_language->language_code = "IPN";

        $book_language->save();

        return true; //'Success!';
    }

    public function return(){
        return view('website.payment.telebirr.return');
    }
}
