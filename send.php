<?php
// Receive a  data from forms in index.html
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$what=$_POST['what'];
	$question=$_POST['question'];
	
	// Адрес получателя  писем запросов
$to = "mv@1copro.ru";
// Тема письма
$subject = "Запрос с сайта 1coPro.ru от: ".htmlspecialchars($name);

// Текст письма запроса
$message = "Запрос с сайта 1coPro.ru поступил от: " .htmlspecialchars($name) ."\n" ."тел.: " .htmlspecialchars($phone)."\n"."email: ".htmlspecialchars($email)."\n"."Запрос отправлен из формы: " .$what."\n"."Вопрос посетителя: " .htmlspecialchars($question)."\n"."Не забудьте позвонить посетителю!";
$headers = "From: 1coPro.ru <mv@1coPro.ru>\r\nContent-type: text-html; 
charset=utf-8 \r\n";
mail($to, $subject, $message, $headers);
header('Location: thanks.html');
exit();	

?>