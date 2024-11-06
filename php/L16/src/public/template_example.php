<?php

//var_dump($_SERVER);
//$theContent = '<ul>';
//
//foreach ($_POST as $key => $value) {
//    $theContent .= '<li>' . $key . '  value: ' . $value . '</li>';
//}
//
//$theContent .= '</ul>';
//
//var_dump($_FILES);
//$theContent .= '</ul>';

$theContent = $_SERVER;
require_once __DIR__ . '/template.php';