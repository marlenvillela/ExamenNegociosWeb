<style>
.form-container {
    max-width: 500px;
    margin: 30px auto;
    font-family: Arial, sans-serif;
}

.form-container h2 {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 12px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 4px;
}

.form-group input {
    width: 100%;
    padding: 6px;
    box-sizing: border-box;
}

.form-actions {
    margin-top: 20px;
    display: flex;
    gap: 10px;
}

.form-actions button,
.form-actions a {
    padding: 6px 12px;
    text-decoration: none;
    border: 1px solid #ccc;
    background-color: #f4f4f4;
    cursor: pointer;
}

.form-actions button.primary {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}
</style>

<div class="form-container">
    <h2>{{modeDsc}}</h2>

    <form action="index.php?page=Producto&mode={{mode}}&id={{id_producto}}" method="post">

        <input type="hidden" name="id_producto" value="{{id_producto}}">
        <input type="hidden" name="xsrToken" value="{{xsrToken}}">

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{nombre}}">
        </div>

        <div class="form-group">
            <label>Tipo</label>
            <input type="text" name="tipo" value="{{tipo}}">
        </div>

        <div class="form-group">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" value="{{precio}}">
        </div>

        <div class="form-group">
            <label>Marca</label>
            <input type="text" name="marca" value="{{marca}}">
        </div>

        <div class="form-group">
            <label>Fecha de lanzamiento</label>
            <input type="date" name="fecha_lanzamiento" value="{{fecha_lanzamiento}}">
        </div>

        <div class="form-actions">
            <button type="submit" class="primary">Guardar</button>
            <a href="index.php?page=Productos">Cancelar</a>
        </div>

    </form>
</div>
