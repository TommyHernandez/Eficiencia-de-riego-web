<?php
if ($ajax === FALSE) {
    
}
?>
<form id="finsertusuario" method="post" action="phpinsert.php">
    
        <div class="form-group">
            <label for="login">login</label>
            <input type="text" name="login" class="form-control" id="login" value="" placeholder="Login del usuario">
        </div>
        <div class="form-group">
            <label for="clave">Clave</label>
            <input type="text" name="login" class="form-control" name="clave" id="clave" value="" placeholder="clave">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text"  class="form-control" name="nombre"  id="nombre" value="" placeholder="Nombre del usuario">
        </div>
        <div class="form-group">
            <label for="nombre">Email</label>
            <input type="email"  class="form-control" name="email" id="email" value=""  placeholder="correo@correo.es">
        </div>
        <div class="form-group">
            <label for="isroot">is root</label>            
                <!--<input type="text" id="isroot" name="isroot" value="" />-->
            <?php echo Util::getSiNo("", "isroot", "isroot", false); ?>

        </div>
    <table>
        <tr>
            <td colspan="2">
                <?php
                if ($ajax === FALSE) {
                    ?>

                    <input type='submit' value="inserción" id="botoninsert" class="btn btn-success" />
                    <?php
                }
                ?>

            </td>
        </tr>
    </table>
</form>