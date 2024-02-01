<?php
// Incluir la lógica para manejar la inserción aquí, si se ha enviado el formulario
require_once "./clases/Cartera.php";
require_once "./clases/Empresa.php";

// Instanciar la Cartera
$cartera = new Cartera();
$cartera->loadData("data.csv");

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Llamar al método insert de Cartera con los datos enviados por POST
    $cartera->insert($_POST);
    header("Location: index.php"); // Redireccionar
    exit; // Asegurar que el script se detiene después de la redirección
}

?>

<form method="post" action="create.php">
    <div>
        <label for="company">Empresa:</label>
        <input type="text" id="company" name="company">
    </div>
    <div>
        <label for="investment">Inversión:</label>
        <input type="text" id="investment" name="investment">
    </div>
    <div>
        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date">
    </div>
    <div>
        <label for="active">Activo:</label>
        <select id="active" name="active">
            <option value="True">Sí</option>
            <option value="False">No</option>
        </select>
    </div>
    <button type="submit">Añadir</button>
</form>
