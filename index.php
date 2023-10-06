<?php
require __DIR__.'/includes/app.php';
$db = conectarDB();

$query = "SELECT * FROM tasks;";

if($db) {
    $result = mysqli_query($db, $query);
    
}
incluirTemplate('header',$inicio = true);
?>
<main class="main">
    <h1>Tasks</h1>
    <section class="task-container contenedor">
        <!--Card task-->
        <?php while ($task = mysqli_fetch_assoc($result)) : ?>
            <div class="task">
                <div class="task-info">
                    <div class="task-info-title">
                        <h3><?php echo $task['titulo'] ?></h3>
                    </div>
                    <div class="task-info-paragraph">
                        <p><?php echo $task['descripcion'] ?></p>
                    </div>
                </div>
                <div class="task-boton">
                    <a href="update.php?id=<?php echo $task['id'] ?>" class="button-yellow">actualizar tarea</a>
                    <form action="" method="post">
                        <input type="hidden">
                        <input type="submit" value="Borrar" class="button-red w-100">
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
        <!--fin card-->

    </section>
</main>
<?php include 'includes/templates/footer.php'; ?>