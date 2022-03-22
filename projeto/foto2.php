<?php
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Headers: *");
 
 
  define('UPLOAD_DIR', 'imagens/');
	$img = $_FILES['photo']['name'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$success = file_put_contents($file, $data);
 
http_response_code(200);
echo json_encode($response);