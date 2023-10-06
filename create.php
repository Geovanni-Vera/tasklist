<?php
require __DIR__.'/includes/app.php';
use App\Task;

$task = new Task;
$errores = Task::getErrores();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $task = new Task($_POST['task']);
    $errores = $task->validar();
    if(empty($errores)){
        $task -> crear();
    }
}

incluirTemplate('header',$inicio = false);
?>

    <main>
        <form action="" method="post" class="formulario contenedor">
            <fieldset>
                <legend>Crear tarea</legend>
                <?php include 'includes/templates/formulario.php' ?>
            </fieldset>

            <input type="submit" class="button-green submit" value="Crear">
        </form>
    </main>
    
<?php include 'includes/templates/footer.php';?>