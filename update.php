<?php
use App\Task;
require __DIR__.'/includes/app.php';
$id = $_GET['id'];
//validar que sea un id valido 
$id = filter_var($id, FILTER_VALIDATE_INT);
//si no es un id valido lo redireccionamos a el administrador
if (!$id) {
    header('location: /tasklist/index.php?mensaje=3');
}

$task = Task::find($id);
$errores = Task::getErrores();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $args = $_POST['task'];
    
    $errores = $task->validar();
    if(empty($errores)){
        $task->sincronizar($args);
        $task->guardar();
    }

}
incluirTemplate('header',$inicio = false);
?>
    <main>
        <form action="" method="post" class="formulario contenedor">
            <fieldset>
                <legend>Actualizar Tarea</legend>
                <?php include 'includes/templates/formulario.php' ?>
            </fieldset>

            <input type="submit" class="button-green submit" value="Actualizar">
        </form>
    </main>
    <?php include 'includes/templates/footer.php'; ?>