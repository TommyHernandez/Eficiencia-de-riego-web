<?php

?>
<form>
    <div class="form-group">
        <label for="id">IdSector</label>
        <input type="text" name="id" class="form-control" id="idsec" value="" placeholder="id del sector" required="require">
    </div>
    <div class="form-group">
        <label for="id">Numero de olivos</label>
        <input type="number" name="olivos" class="form-control" id="olivos" value="" >
    </div>
    <div class="form-group">
        <label for="id">Zona del contador</label>
        <input type="text" name="contador" class="form-control" id="contador" value="" placeholder="Zona">
    </div>
    <div class="form-group">
        <label for="nombre">Nombre del Sector</label>
        <input type="text" id="nsec" name="nombre" class="form-control"  value="" placeholder="Nombre del sector">
    </div>
    <div class="form-group">
        <label for="id">Metodo</label>
        <select name="riego" id="riego" class="form-control">
            <option selected="selected">Gravedad</option>
            <option>Rebombeo</option>
        </select>
    </div>
</form>