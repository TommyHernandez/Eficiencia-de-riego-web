<?php
if ($ajax === FALSE) {
    
}
?>
<form>
    <div class="form-group">
        <label for="id">IdSector</label>
        <input type="text" name="id" class="form-control" id="idsec" value="" placeholder="id del sector">
    </div>
    <div class="form-group">
        <label for="id">Numero de olivos</label>
        <input type="number" name="olivos" class="form-control" id="olivos" value="" >
    </div>
    <div class="form-group">
        <label for="id">Zona del contador</label>
        <input type="text" name="contador" class="form-control" id="contador" value="" placeholder="id del sector">
    </div>
    <div class="form-group">
        <label for="id">Metodo</label>
        <select name="riego" class="form-control">
            <option selected="selected" value="gravedad">Gravedad</option>
            <option value="rebombeo">Rebombeo</option>
        </select>
    </div>
</form>