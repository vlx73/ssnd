<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<ul>
    <?php foreach ($users as $user): ?>
        <li><?php echo $user->getFirstName(); ?></li>
        <li><?php echo $user->getLastName(); ?></li>
        <li><?php echo (string)$user->getEmail(); ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>