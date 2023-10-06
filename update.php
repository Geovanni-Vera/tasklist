<?php
require __DIR__.'/includes/app.php';
incluirTemplate('header',$inicio = false);
?>
    <main>
        <form action="guardar.php" method="post" class="formulario contenedor">
            <fieldset>
                <legend>Update Task</legend>
                <div class="input-ctn">
                    <label for="titulo">Titulo:</label>
                    <input type="text" id="titulo" name="titulo" placeholder="El titulo"></div>
                <div class="input-ctn">
                    <label for="descripcion">Descripcion:</label>
                    <textarea name="descripcion" id="descripcion"></textarea>
                </div>
            </fieldset>

            <input type="submit" class="button-green submit" value="Actualizar">
        </form>
    </main>
    <?php include 'includes/templates/footer.php'; ?>