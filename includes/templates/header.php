<?php
$inicio ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="build/css/app.css">
</head>

<body>
    <header class="header">
        <div class="header-container contenedor">
            <a href="/tasklist/index.php"><h2 class='logo'><span>Task</span> List</h2></a>
            <nav class="navegacion-principal">
                <?php if($inicio):?>
                    <a href="create.php" class="button-green">crear tarea</a>
                <?php elseif($inicio === false):?>
                    <a href="index.php" class="button-green">Volver</a>
                <?php endif; ?>    
            </nav>
        </div>
    </header>