<?php
/*定义头文件为图片*/
session_start();
	
header("Content-type: image/png");
/*调用生成验证码函数*/
/*随机生成两个数字*/
//		$num1 = rand(1, 20);	//,$num1,$num2
//		$num2 = rand(1, 20);
getCode(100, 24);
//	$he=$num1+$num2;
//	echo $he;
/**
 * 定义生成验证码图片函数 暂时只写了加法运算
 * @param int $w 图片宽
 * @param int $h 图片高
 */
//PHP生成验证码：[4]php计算验证码
//2.,$num1,$num2
function getCode($w, $h) {
/*创建图片设置字体颜色*/
$im = imagecreate($w, $h);
$red = imagecolorallocate($im, 255, 255, 255);
$white = imagecolorallocate($im, 255, 255, 255);

/*随机生成两个数字*/
$num1 = rand(1, 20);
$num2 = rand(1, 20);
/**/
$he=$num1+$num2;
$_SESSION['yzm_code']=$he;
/*设置图片背景颜色*/
$gray = imagecolorallocate($im, 118, 151, 199);
$black = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
//PHP生成验证码：[4]php计算验证码
//3.
/*创建图片背景*/
imagefilledrectangle($im, 0, 0, 100, 24, $black);
/*在画布上随机生成大量点*/
for ($i = 0; $i < 80; $i++) {
imagesetpixel($im, rand(0, $w), rand(0, $h), $gray);
}
/*将计算验证码写入到图片中*/
imagestring($im, 5, 5, 4, $num1, $red);
imagestring($im, 5, 30, 3, "+", $red);
imagestring($im, 5, 45, 4, $num2, $red);
imagestring($im, 5, 70, 3, "=", $red);
imagestring($im, 5, 80, 2, "?", $white);
/*输出图片*/
imagepng($im);
imagedestroy($im);
}