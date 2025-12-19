<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-family: Arial, sans-serif;
}

table th, table td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

table th {
    background-color: #f4f4f4;
}

.actions a {
    margin-right: 10px;
    text-decoration: none;
    color: #0066cc;
    font-weight: bold;
}

.actions a:hover {
    text-decoration: underline;
}

.top-bar {
    margin-bottom: 15px;
}
</style>

<h2>Listado de Productos</h2>

<div class="top-bar">
    <a href="index.php?page=Producto&mode=INS">➕ Nuevo Producto</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Marca</th>
            <th>Fecha Lanzamiento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        {{foreach productos}}
        <tr>
            <td>{{id_producto}}</td>
            <td>{{nombre}}</td>
            <td>{{tipo}}</td>
            <td>L {{precio}}</td>
            <td>{{marca}}</td>
            <td>{{fecha_lanzamiento}}</td>
            <td class="actions">
                <a href="index.php?page=Producto&mode=UPD&id={{id_producto}}">✏ Editar</a>
                <a href="index.php?page=Producto&mode=DEL&id={{id_producto}}">🗑 Eliminar</a>
            </td>
        </tr>
        {{endfor productos}}
    </tbody>
</table>

