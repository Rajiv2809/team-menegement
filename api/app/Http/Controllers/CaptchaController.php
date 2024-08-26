<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function generateCaptcha()
    {
        
        function generateRandomString($length = 6)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $captchaString = generateRandomString();

        session(['captcha_code' => $captchaString]);

        $image = imagecreate(120, 40);

        $bg = imagecolorallocate($image, 255, 255, 255);
        $textcolor = imagecolorallocate($image, 0, 0, 255);

        imagestring($image, 5, 10, 10, $captchaString, $textcolor);

        ob_start();
        imagepng($image);
        $image_data = ob_get_contents();
        ob_end_clean();

        imagedestroy($image);

        return response($image_data)->header('Content-Type', 'image/png');
    }
}
