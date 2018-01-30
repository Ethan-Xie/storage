<?php
	
//	1、获取目标网站图片地址。
//2、读取图片内容。
//3、创建要保存图片的路径并命名图片名称。
//4、写入图片内容。
//5、完成。
	
	function make_dir($path){ 
    if(!file_exists($path)){//不存在则建立 
        $mk=@mkdir($path,0777); //权限 
        @chmod($path,0777); 
    } 
    return true; 
}
		function get_filename($filepath){ 
    $fr=explode("/",$filepath); 
    $count=count($fr)-1; 
    return $fr[$count]; 
}
//--------------------------------------下面为用到的程序
	function read_filetext($filepath){ 
    $filepath=trim($filepath); 
    $htmlfp=@fopen($filepath,"r"); 
    //远程 
    $string="";
    if(strstr($filepath,"://")){ 
        while($data=@fread($htmlfp,500000)){ 
            $string.=$data; 
        } 
    } 
    //本地 
    else{ 
        $string=@fread($htmlfp,@filesize($filepath)); 
    } 
    @fclose($htmlfp); 
    return $string; 
}

	function write_filetext($filepath,$string){ 
    //$string=stripSlashes($string); 
    $fp=@fopen($filepath,"w"); 
    @fputs($fp,$string); 
    @fclose($fp); 
}
	


	function save_pic($url,$savepath='',$k){ 
    //处理地址 
    $url=trim($url); 
    $url=str_replace(" ","%20",$url); //替换空格
    //读文件 
    $string=read_filetext($url); 
    if(empty($string)){ 
        echo '读取不了文件';exit; 
    } 
    //文件名 
    //$filename = get_filename($url); 
    //存放目录 
    //make_dir($savepath); //建立存放目录 
    //文件地址 
    $filepath = $savepath.'/'.$k.'.jpg'; 
    //写文件 
    write_filetext($filepath,$string); 
    return $filepath; 
}

	function get_pic($cont,$path,$rename){
		//建目录
	if(!file_exists($path)){//不存在则建立 
        if(!mkdir(iconv('utf-8', 'gbk', $path))){
        	echo "创建path失败";
        	exit;
        }
        //@mkdir($path,0777); //权限 
        //@chmod($path,0777); 
   } 
   //path=$path.'/';
    $pattern_src = '/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/'; 
    $num = preg_match_all($pattern_src, $cont, $match_src); 
    $pic_arr = $match_src[1]; //获得图片数组 0->匹配的值 1-->取出的值
    foreach ($pic_arr as $k => $v) { //循环取出每幅图的地址 
        $filepath=save_pic($v,$path,$k); //下载并保存图片 
        echo "[OK]--->图片".$k."：路径为".$filepath."<br/>"; 
    } 
    /*
    $rename = iconv('utf-8', 'gbk', $rename);
	  if(rename($path,$rename)){
	  echo "更名成功";
	  }else{
	    echo "更名失败";
	  }
	  */
}
	
	
	//我们采集网站上的图片
//$url = "http://mp.weixin.qq.com/s/4nSzgOcWekHmIWxesOhIlw"; //单面光黑丝遮光布
//$url = "http://mp.weixin.qq.com/s/Fg47t4Yv_timuW4_3UnNmw"; //单面光黑丝遮光布
//$url = "http://mp.weixin.qq.com/s/rSrCkLmOQaaYY3o-sITPOg"; //单面光黑丝遮光布
//$url = "http://mp.weixin.qq.com/s/7B3yXgEoXF_fEpeq0fn5Ug"; //单面光黑丝遮光布
//$url = "https://mp.weixin.qq.com/s/BRamHNUz3TZQD-D0Jyzm0g"; //单面光黑丝遮光布

//$url = "https://mp.weixin.qq.com/s/IIhRFFf5HUoVCW6HgqNGRA"; //单面光黑丝遮光布
//$url = "http://mp.weixin.qq.com/s/R3kcq9v35buhojqjHF3N2g"; //单面光黑丝遮光布
//$url = "http://mp.weixin.qq.com/s/FHA_JMWe55D8k_dtZi3Dfw"; //单面光黑丝遮光布
$url = "http://mp.weixin.qq.com/s/QakbdBBqzjUfjSLzLpY_Tw"; //单面光黑丝遮光布


//$url = "http://mp.weixin.qq.com/s/4nSzgOcWekHmIWxesOhIlw"; //单面光黑丝遮光布
//$url = "http://mp.weixin.qq.com/s/4nSzgOcWekHmIWxesOhIlw"; //单面光黑丝遮光布
//$url = "http://mp.weixin.qq.com/s/4nSzgOcWekHmIWxesOhIlw"; //单面光黑丝遮光布
$content = file_get_contents($url);//获取网页内容 

//$preg = '/<div id="img-content.*>(.*)<\/div>/';
$preg = '/ <h2 class="rich_media_title" id="activity-name">
(.*)<\/h2>
/';
preg_match_all($preg, $content, $arr); 
$rename=trim($arr[1][0]);
echo $rename;
/*
var_dump($arr);
var_dump($content);
echo $name;
exit;
*/
//$cont = $arr[1][0];  
//get_pic($content,'img0');
get_pic($content,'img9',$rename);
?>