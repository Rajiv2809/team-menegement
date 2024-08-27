<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class CaptchaController extends Controller
{
    public function captcha()
    {

        function generateRandomString($length = 6)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }


        $captchaString = generateRandomString();
        $captchaToken = Str::uuid();


        Cache::put($captchaToken->toString(), $captchaString, 300);

        return response()->json([
            'token' => $captchaToken
        ]);
    }

    public function captchaImage($token)
    {

        $captchaCode = Cache::get($token);

        if (!$captchaCode) {
            return response()->json([
                'message' => 'Invalid or expired CAPTCHA token'
            ], 404);
        }

        $image = imagecreate(120, 40);
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 255);

        imagestring($image, 5, 10, 10, $captchaCode, $textColor);


        ob_start();
        imagepng($image);
        $imageData = ob_get_contents();
        ob_end_clean();


        imagedestroy($image);

        return response($imageData)->header('Content-Type', 'image/png');
    }
    public function captchaVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $captchaCode = Cache::get($request->token);
        // dd($captchaCode);
        if (!$captchaCode) {
            return response()->json([
                'message' => 'Invalid or expired CAPTCHA token'
            ], 404);
        }

        if ($captchaCode === $request->input('code')) {

            Cache::forget($request->token);

            return response()->json([
                'message' => 'CAPTCHA verified successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'CAPTCHA verification failed'
            ], 422);
        }
    }
}
