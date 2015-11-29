<?php

class captcha{

    public function createCaptcha(){
        $captcha = '';
        $symbol = '0';
        $width = 420;
        $height = 70;
        $font = 'fonts/bellb.ttf';
        $fontsize = 20;

        $captchaLength = rand(1,1);
        $im = imagecreatetruecolor($width, $height);
        $bg = imagecolorallocatealpha($im, 0, 0, 0, 127);
        imagefill($im, 0, 0, $bg);

        for ($i = 0; $i < $captchaLength; $i++){
            $captcha .= $symbol[ rand(0, strlen($symbol)-1) ];
            $x = ($width - 20) / $captchaLength * $i + 10;
            $x = rand($x, $x+4);
            $y = $height - ( ($height - $fontsize) / 2 );
            $curcolor = imagecolorallocate( $im, rand(0, 100), rand(0, 100), rand(0, 100) );
            $angle = rand(-25, 25);
            imagettftext($im, $fontsize, $angle, $x, $y, $curcolor, $font, $captcha[$i]);
        }

        session_start();
        $_SESSION['captcha'] = $captcha;

        header('Content-type: image/png');

        imagepng($im);
        imagedestroy($im);
    }
}

$obj = new captcha();
$obj->createCaptcha();