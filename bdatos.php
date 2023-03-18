<?php

//si usas xampp aqui solo cambias las variables para conexion

$host = 'localhost'; //localhost
$user = 'root';	// Root
$pass = '';	// 
$dabe = 'prueba';
$conn = new mysqli($host, $user, $pass, $dabe);
require 'PHPExcel-1.8\Classes\PHPExcel\IOFactory.php';
$uploadfile = $_FILES['uploadfile']['tmp_name'] ;


	$objPHPExcel = PHPEXCEL_IOFactory::load($uploadfile);	
	$objPHPExcel->setActiveSheetIndex(0);	
	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();




	for($i = 3; $i <= $numRows; $i++){

	
	
		$id 	 = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$project = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$nombre  = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$precio  = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();

			//SI LA TABLA DE ID ESTA VACIA CREA NUEVO AL CONTRARIO SOLO ACTUALIZA LOS DATOS
		if($id!='')
		{
		$update =  "UPDATE excelprueba SET project = '$project', nombre ='$nombre', price = '$precio'  WHERE id ='$id'  "; 
			var_dump($update);
			//$insertres = mysqli_query($conn , $update) ; DESACTIVA LOS COMENTARIOS PARA QUE SE SUBA LOS DATOS
	
		}else{
			$insertqry= "INSERT INTO excelprueba (project , nombre, price) VALUES ('$project','$nombre', '$precio')"; 
			
						var_dump($insertqry);
			//$insertres=mysqli_query ($conn,$insertqry); DESACTIVA LOS COMENTARIOS PARA QUE SE SUBA LOS DATOS
		

			
			

		}
	}
	//DESACTIVALO PARA QUE TE REGRESE
//header('location: exceljava.php')

?>