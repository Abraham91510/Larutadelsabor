<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generate()
{
    $codigo = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);

    session(['captcha_code' => $codigo]);

    session()->forget('captcha_code');
    session()->put('captcha_code', strtoupper($codigo));

    $ancho = 160;
    $alto = 45;

    $imagen = imagecreate($ancho, $alto);

    $fondo = imagecolorallocate($imagen, 33, 37, 41);
    $texto = imagecolorallocate($imagen, 255, 255, 255);

    for ($i = 0; $i < 80; $i++) {
        imagesetpixel($imagen, rand(0, $ancho), rand(0, $alto), $texto);
    }

    imagestring($imagen, 5, 40, 15, $codigo, $texto);

    return response()->stream(function () use ($imagen) {
        imagepng($imagen);
        imagedestroy($imagen);
    }, 200, [
        'Content-Type' => 'image/png'
    ]);
}
}