<div class="input-ctn">
    <label for="titulo">Titulo:</label>
    <input 
    type="text" 
    id="titulo" 
    name="task[titulo]" 
    placeholder="El titulo" 
    value="<?php echo $task -> titulo?>">
</div>
<div class="input-ctn">
    <label for="descripcion">Descripcion:</label>
    <textarea name="task[descripcion]" id="descripcion"><?php echo $task -> descripcion?></textarea>
</div>