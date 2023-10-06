<?php
    include 'includes/templates/header.php';
?>
    <main class="main">
        <h1>Tasks</h1>
        <section class="task-container contenedor">
            <!--Card task-->
            <div class="task">
                <div class="task-info">
                    <div class="task-info-title">
                        <h3>Task title</h3>
                    </div>
                    <div class="task-info-paragraph">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid repudiandae voluptas
                            facilis cupiditate odio, facere eum delectus autem ab saepe.
                        </p>
                    </div>
                </div>
                <div class="task-boton">
                    <a href="update.html" class="button-yellow">update</a>
                    <form action="" method="post">
                        <input type="hidden">
                        <input type="submit" value="Delete" class="button-red w-100">
                    </form>
                </div>
            </div>
            <!--fin card-->
            
        </section>
    </main>
    <?php include 'includes/templates/footer.php'; ?>