<?php
/*����ͷ�ļ�ΪͼƬ*/
session_start();
	
header("Content-type: image/png");
/*����������֤�뺯��*/
/*���������������*/
//		$num1 = rand(1, 20);	//,$num1,$num2
//		$num2 = rand(1, 20);
getCode(100, 24);
//	$he=$num1+$num2;
//	echo $he;
/**
 * ����������֤��ͼƬ���� ��ʱֻд�˼ӷ�����
 * @param int $w ͼƬ��
 * @param int $h ͼƬ��
 */
//PHP������֤�룺[4]php������֤��
//2.,$num1,$num2
function getCode($w, $h) {
/*����ͼƬ����������ɫ*/
$im = imagecreate($w, $h);
$red = imagecolorallocate($im, 255, 255, 255);
$white = imagecolorallocate($im, 255, 255, 255);

/*���������������*/
$num1 = rand(1, 20);
$num2 = rand(1, 20);
/**/
$he=$num1+$num2;
$_SESSION['yzm_code']=$he;
/*����ͼƬ������ɫ*/
$gray = imagecolorallocate($im, 118, 151, 199);
$black = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
//PHP������֤�룺[4]php������֤��
//3.
/*����ͼƬ����*/
imagefilledrectangle($im, 0, 0, 100, 24, $black);
/*�ڻ�����������ɴ�����*/
for ($i = 0; $i < 80; $i++) {
imagesetpixel($im, rand(0, $w), rand(0, $h), $gray);
}
/*��������֤��д�뵽ͼƬ��*/
imagestring($im, 5, 5, 4, $num1, $red);
imagestring($im, 5, 30, 3, "+", $red);
imagestring($im, 5, 45, 4, $num2, $red);
imagestring($im, 5, 70, 3, "=", $red);
imagestring($im, 5, 80, 2, "?", $white);
/*���ͼƬ*/
imagepng($im);
imagedestroy($im);
}