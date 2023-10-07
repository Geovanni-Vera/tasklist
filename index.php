<?php
require __DIR__.'/includes/app.php';
use App\Task;
$mensaje = $_GET['mensaje'] ?? null;
$tasks = Task::all();
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //obtener los valores del formulario id y validamos que sean validos
    $id = $_POST['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    //validamos que exista un id
    if($id){
        $task = Task::find($id);
        $task -> eliminar();    
    }
}
incluirTemplate('header',$inicio = true);
?>
<main class="main">
    <h1>LISTA DE TAREAS</h1>
    <?php  if(intval($mensaje) === 1):?>
        <div class="alerta correcto contenedor">
            <p><?php echo "tarea creada correctamente" ?></p>
        </div>
    <?php  elseif(intval($mensaje) === 2):?>
        <div class="alerta correcto contenedor">
            <p><?php echo "tarea actualizada correctamente" ?></p>
        </div>    
    <?php  elseif(intval($mensaje) === 3):?>
        <div class="alerta error contenedor" >
            <p><?php echo "archivo no autorizado" ?></p>
        </div>     
    <?php  elseif(intval($mensaje) === 4):?>
        <div class="alerta correcto contenedor" >
            <p><?php echo "Tarea borrada correctamente" ?></p>
        </div>      
    <?php endif;?>
    <?php 
    if(isset($mensaje)){
        header( "refresh:1;URL=index.php" );
    }
    ?>
    <section class="task-container contenedor">
        <!--Card task-->
        <?php foreach($tasks as $row ): ?>
            <div class="task">
                <div class="task-info">
                    <div class="task-info-title">
                        <h3><?php echo $row->titulo ?></h3>
                    </div>
                    <div class="task-info-paragraph">
                        <p><?php echo $row->descripcion ?></p>
                    </div>
                </div>
                <div class="task-boton">
                    <a href="update.php?id=<?php echo $row->id ?>" class="button-yellow">actualizar tarea</a>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $row->id ?>">
                        <input type="submit" value="Borrar" class="button-red w-100">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <!--fin card-->

    </section>
</main>
<?php include 'includes/templates/footer.php'; ?>