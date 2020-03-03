<?php 

session_start();

function randomCode() {
    $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    $pass = [];

    $strLength = strlen($string) - 1;
    for($i=0;$i<4;$i++) {
        $randStr = rand(0, $strLength);
        $pass[] = $string[$randStr];
    }

    // return implode($pass);
    return $pass;
}

$captcha = randomCode();
$capImplode = implode($captcha);
$_SESSION['captcha'] = $capImplode;

$rotateArr = [];
$posXArr = [];
$posYArr = [];
$fontSizeArr = [];
for($i=0;$i<count($captcha);$i++) {
    $rotate = rand(10, 22);
    $posX = rand(30, 40);
    $posY = rand(10, 15);
    $fontSize = rand(15, 17);

    $rotateArr[] = $rotate;
    $posXArr[] = $posX;
    $posYArr[] = $posY;
    $fontSizeArr[] = $fontSize;
}   

$canvas = imagecreatetruecolor(100, 50);

// // bg color
$bg = imagecolorallocate($canvas, 55, 59, 59);

// // text
$white = imagecolorallocate($canvas, 253, 252, 252);
$text = imagefill($canvas, 0, 0, $bg);
// $fontSize = 12;

$lineChance = rand(3,6);

// TODO random line
$linePosXArr = [];
$linePosYArr = [];
$endLineXArr = [];
$endLineYArr = [];
for($i=0;$i<$lineChance;$i++) { 
    $linePosXArr[] = rand(0, 100);
    $linePosYArr[] = rand(0,50);

    $endLineXArr[] = rand(0, 100);
    $endLineYArr[] = rand(0, 50);

    imageline($canvas, $linePosXArr[$i], $linePosYArr[$i], $endLineXArr[$i], $endLineYArr[$i], $white);
}

// TODO Generate Pixel
$pixel_color = imagecolorallocate($canvas, 230,245,230);
for($i=0;$i<200;$i++) {
    imagesetpixel($canvas, rand()%200, rand()%50, $pixel_color);
}

for($a=0;$a<count($captcha);$a++) {
    $captchaLetter = $captcha[$a];
    $fontSizeLetter = $fontSizeArr[$a];

    $chance = rand(0,1);
    if($chance) {
        // ? change to negative value
        $rotateArr[$a] = -abs($rotateArr[$a]);
    }

    $rotateLetter = $rotateArr[$a];

    $posY = rand(20,30);

    // imagestring($canvas, $fontSize, ($a+1)*20, ($posY/2)*5, $captchaLetter, $white);
    imagettftext($canvas, $fontSizeLetter, $rotateLetter, ($a+1)*15, $posY, $white, __DIR__.'\\Raleway-Medium.ttf', $captchaLetter);
}

header("Cache-Control: no-cache, must-revalidate");
header("Content-type: image/png");

imagepng($canvas);
imagedestroy($canvas);