<?php

//require_once __DIR__ . '/../src/Enum/Email.php';
//require_once __DIR__ . '/../src/Validator/EmailValidator.php';

use ssnd\Enum\Email;
use ssnd\Entity\Person;

require_once __DIR__ . '/../autoload.php';
spl_autoload_register('ssnd_class_autoloader');

$emailAddress = 'vlado@valid.';
//
try {
 $validEmail = new Email($emailAddress);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
    die();
}

$newUser = new Person($validEmail);
$newUser->setFirstName('Vladimir');
$newUser->setLastName('Krajnak');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<ul>
    <li><?php echo (string)$validEmail; ?></li>
    <li><?php echo $validEmail->get(); ?></li>
    <li><?php echo $validEmail->getName(); ?></li>
    <li><?php echo $validEmail->getDomain(); ?></li>
    <li><?php echo $newUser->getFirstName(); ?></li>
</ul>
</body>
</html>