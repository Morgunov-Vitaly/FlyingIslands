<?php
// Receive a  data from forms in index.html
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$what=$_POST['what'];
$question=$_POST['question'];
$ipaddress=$_SERVER['REMOTE_ADDR'];
	// создадим функцию для очистки данных от HTML и PHP тегов:
function clean($value = "") {
	$value = trim($value);
	$value = stripslashes($value);
	$value = strip_tags($value);
	$value = htmlspecialchars($value);

	return $value;
}
	// создадим функцию для проверки длинны строки:
function check_length($value = "", $min, $max) {
	$result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
	return !$result;
}
	// Очистим значения переменных от "грязи"
$name = clean($name);
$phone = clean($phone);
$email = clean($email);
$question = clean($question);
$what= clean($what);
// Адрес получателя  писем запросов
$to = "mv@1copro.ru"; //morgunov.vitaly@gmail.com
// Тема письма
$subject = "Запрос с сайта 1coPro.ru от: ".htmlspecialchars($name);


// Рассмотрим два варианта формы:
// Вариант 1 - форма Заявка на оценку
If ($what=="Заказать оценку") {
	if(!empty($name) && !empty($phone)) {
		if(check_length($name, 2, 50) && check_length($phone, 6, 20) && ($phone != "123456")) {
			// Составим текст письма запроса
			$message = "Запрос на оценку с сайта 1coPro.ru поступил от: " .$name ."\n" ."тел.: " .$phone."\n"."email: ".$email."\n"."Запрос отправлен из формы: " .$what."\n"."IP адрес: ".$ipaddress."\n"."Не забудьте позвонить посетителю!";
			$headers = 'From: 1coPro.ru <mail@1coPro.ru>'."\r\n";
			$headers .= 'Content-type: text/plain; charset=utf-8'. "\r\n";
			mail($to, $subject, $message, $headers);
			header('Location: thanks.html');
		} else {
			header('Location: sorry.html');
			//echo "Длинна данных указывает  на их некорректность";
		}
	} else {
			header('Location: sorry.html');
			//echo "Заполните недостающие данные";
		}
} elseif ($what=="Задать вопрос") {
	// Вариант 2 - форма с вопросом
	if(!empty($name) && !empty($phone) && !empty($email)) {
		$email_validate = filter_var($email, FILTER_VALIDATE_EMAIL); 

		if(check_length($name, 2, 50) && check_length($phone, 6, 20) && $email_validate && ($phone != "123456")) {
    	// Составим текст письма запроса
			$message = "Вопрос с сайта 1coPro.ru поступил от: " .$name ."\n" ."тел.: " .$phone."\n"."email: ".$email."\n"."Запрос отправлен из формы: " .$what."\n"."IP адрес: ".$ipaddress."\n"."Вопрос посетителя: " .$question."\n"."Не забудьте позвонить посетителю!";
			$headers = 'From: 1coPro.ru <mail@1coPro.ru>'."\r\n";
			$headers .= 'Content-type: text/plain; charset=utf-8'. "\r\n";
			mail($to, $subject, $message, $headers);
			header('Location: thanks.html');
		} else {
			header('Location: sorry.html');
			//echo "Длинна данных указывает  на их некорректность";
		}
	} else {
			header('Location: sorry.html');
			//echo "Заполните недостающие данные";
		}
} else {
	// Что-то пошло не так
	header('Location: sorry.html');
	//echo "форма источник-неопределена";
}
exit();	
?>