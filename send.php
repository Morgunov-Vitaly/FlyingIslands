<?php
// Receive a  data from forms in index.html
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$what=$_POST['what'];
	
	// Адрес получателя  писем запросов
$to = "mv@1copro.ru";
// Тема письма
$subject = "Запрос с сайта 1coPro.ru от: ".htmlspecialchars($name);

// Текст письма запроса
$message = "Запрос с сайта 1coPro.ru поступил от: " .htmlspecialchars($name) ."<br> тел.: " .htmlspecialchars($phone)."<br> Запрос отправлен из формы" .$what."<br>Не забуьте позвонить посетителю.";
$headers = "From: 1coPro.ru <site-mv@1coPro.ru>\r\nContent-type: text-html; 
charset=utf-8 \r\n";
mail($to, $subject, $message, $headers);
header('Location: thanks.html');
exit();	

?>