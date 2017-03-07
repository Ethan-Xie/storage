<?php
	header("content-type:text/html;charset=utf-8");
	//设置为北京时间
	date_default_timezone_set("PRC"); 
	//投稿有效期
	$time=20160417;
	$time_now=date('Ymd',time());
	if($time_now>$time)
	{
			echo "<script>alert('投稿有效期已过！')</script>";
			echo "<script>window.location.href = 'upload.html'</script>";
			exit();
	}
	/*
	echo "<pre>";
	print_r($_FILES);
	echo "</pre>";
	//文件上传<2M
	
	$file_size=$_FILES['myfile']['size'];
	echo $file_size;
	if($file_size>2*1024*1024)
	{
		echo "<script>alert('文件过大，无法上传！')</script>";
		exit();
	}
	*/
	
	session_start();
	if($_SESSION["yzm_code"]!=$_POST['yzm_code'])
	{
			echo "<script>alert('验证码输入错误！')</script>";
		////echo "<script>window.location.href = 'wxbMessege.php?no=1'</script>";
		echo "<script>window.location.href = 'upload.html'</script>";
		exit();
	}
	//限制文件类型
	$file_type=$_FILES['myfile']['type'];
	if($file_type!='text/plain' && $file_type!='application/msword' && $file_type!='application/vnd.openxmlformats-officedocument.wordprocessingml.document')
	{
		echo "<script>alert('文件类型错误！')</script>";
		////echo "<script>window.location.href = 'wxbMessege.php?no=1'</script>";
		echo "<script>window.location.href = 'upload.html'</script>";
		exit();
	}
	if(is_uploaded_file($_FILES['myfile']['tmp_name']))
	{
		$time1=date('m-d-h-i-s',time())."-".rand(0,1000);
		
			$uploaded_file=$_FILES['myfile']['tmp_name'];
			//$move_to_file=$_SERVER['DOCUMENT_ROOT']."xiejisen/new-PHP-test/file/".$time1."-".$_FILES['myfile']['name'];
			$move_to_file="zuoPin/".$time1."-".$_FILES['myfile']['name'];
			//echo $uploaded_file."---".$move_to_file;
			if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file)))
			{
				//echo $_FILES['myfile']['name']."上传成功";
				echo "<script>alert('上传成功！')</script>";
		
				echo "<script>window.location.href = 'upload.html'</script>";
			}else
			{
				//echo "文件上传中失败";
				echo "<script>alert('文件上传中失败！')</script>";
		
				echo "<script>window.location.href = 'upload.html'</script>";
			}

	}else
			{
				echo "<script>alert('文件上传失败！')</script>";
		
				echo "<script>window.location.href = 'upload.html'</script>";
			}

?>