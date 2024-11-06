<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>Máme obsah</h1>
<ul>
    <?php foreach ($theContent as $key => $value): ?>
        <?php include __DIR__ . '/include.php'; ?>
    <?php endforeach; ?>
</ul>
</body>
</html>