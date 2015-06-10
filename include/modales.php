<?php ?>
<!-- Definbimos el dialogo modal que se mostrará para la inserción y la edición de usuarios -->
<div id="dialogomodalinsertar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Usuarios</h4>
            </div>
            <!-- dialog body -->
            <div class="modal-body">
                <?php
                include '../include/formulrioinsercionusuario.php';
                ?>
            </div>
            <!-- dialog buttons -->
            <div class="modal-footer">
                <button type="button" id="btisi" class="btn btn-success">Enviar</button>
                <button type="button" id="btino" class="btn btn-warning">Cancelar</button>
            </div>
        </div>
    </div>
</div><!-- ./modal -->
<!-- Modal para eliminar -->
<div id="dialogomodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar</h4>
            </div>
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <span id="contenidomodal">Contenido modal</span>
            </div>
            <!-- dialog buttons -->
            <div class="modal-footer">
                <button type="button" id="btsi" class="btn btn-success">Aceptar</button>
                <button type="button" id="btno" class="btn btn-warning">Cancelar</button>
            </div>
        </div>
    </div>
</div><!-- ./modal para eliminar -->

<div id="dialogomodalinsertarS" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Añadir Sector</h4>
            </div>
            <!-- dialog body -->
            <div class="modal-body">
                <?php
                include '../include/formulrioinsercionsector.php';
                ?>
            </div>
            <!-- dialog buttons -->
            <div class="modal-footer">
                <button type="button" id="btisi" class="btn btn-success">Enviar</button>
                <button type="button" id="btino" class="btn btn-warning">Cancelar</button>
            </div>
        </div>
    </div>
</div><!-- ./modal Sectores -->
<!-- añadir horario -->
<div id="dialogomodalinsertarH" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Añadir Horario</h4>
            </div>
            <!-- dialog body -->
            <div class="modal-body">
                <?php
                include '../include/formulrioinsercionhorario.php';
                ?>
            </div>
            <!-- dialog buttons -->
            <div class="modal-footer">
                <button type="button" id="btisi" class="btn btn-success">Enviar</button>
                <button type="button" id="btino" class="btn btn-warning">Cancelar</button>
            </div>
        </div>
    </div>
</div><!-- ./modal Horarios -->