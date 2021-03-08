<?php
require __DIR__.'/bootstrap.php';
_d(readData());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple Boxes</title>
</head>
<body>

<h1>Apple Boxes</h1>
<a href="<?= URL ?>create.php">Create</a>

<ul>
<?php foreach (readData() as $box) : ?> 
<li>
<span>ID: <?= $box['id'] ?></span>
<span>Count: <?= $box['apple'] ?></span>
<a href="<?= URL ?>update.php?id=<?= $box['id'] ?>">[EDIT]</a>
<form action="<?= URL ?>delete.php?id=<?= $box['id'] ?>" method="post">
<button type="submit">[DELETE]</button>
</form>
</li>
<?php endforeach ?>
</ul>
    
</body>
</html>