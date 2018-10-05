<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	//Khai bao mảng (key => value)
	$a=array(9,10,-5,20,'Hello');
	
	$b=array('qty'=>2,'name'=>'Hello');
	
	print_r($a);
	echo '<hr>';
	var_dump($b);
	
	//them 1 phan tu 7=>100 vao mang $a (neu da co key la 7 => update. Nguoc lai => insert
	$a[7]=100;
	
	//Them phan tu co value=200;
	$a[]=200;
	
	//Xoa phan tu khoi mang
	//unset($b['qty']);
	
	echo '<hr>';
	print_r($a);
	
	//Duyet mang
	//$n=count($a);
	//for($i=0;$i<$n;$i++)
	//	echo $a[$i],',';
	
	foreach($a as $k=>$v)
		echo $ti,',';
		
	
	//Mang 2 chieu
	$a2=array(array(1,2,3),array(4,5,6));
	echo '<hr>';
	echo $a2[0][2];
	
	echo '<pre>';
	
	print_r($a2);
	
	echo '</pre>';
	
	foreach($a2 as $v)
	foreach($v as $v2)
	echo $v2,'<br>';
	
	
?>
</body>
</html>