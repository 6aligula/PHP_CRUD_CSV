<?php
require_once "./clases/Cartera.php";
require_once "./clases/Empresa.php";

// Instanciar la Cartera
$cartera = new Cartera();
$cartera->loadData("data.csv");
// $cartera = new Cartera("data.csv");

// Recuperar el ID del cliente desde GET
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Intentar recuperar el cliente con ese ID
$client = $cartera->getClient($id);

// Verificar si el formulario ha sido enviado
if (count($_POST) > 0) {
    // Llamar al método update de Cartera con los datos enviados por POST
    $cartera->update($_POST);
    header("location: index.php"); // Redireccionar
}

// Mostrar el formulario si no se ha enviado o si es la primera carga de la página
?>

<form id="form_x" class="class_x" method="post" action="edit.php?id=<?= $id ?>">
    <input type="hidden" name="id" value="<?= $client->getId(); ?>">
    <div>
        <label for="company">Empresa:</label>
        <input type="text" id="company" name="company" value="<?= $client->getCompany(); ?>">
    </div>
    <div>
        <label for="investment">Inversión:</label>
        <input type="text" id="investment" name="investment" value="<?= $client->getInvestment(); ?>">
    </div>
    <div>
        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date" value="<?= $client->getDate(); ?>">
    </div>
    <div>
        <label for="active">Activo:</label>
        <select id="active" name="active">
            <option value="True" <?= $client->getActive() == 'True' ? 'selected' : '' ?>>Sí</option>
            <option value="False" <?= $client->getActive() == 'False' ? 'selected' : '' ?>>No</option>
        </select>
    </div>
    <button type="submit">Guardar</button>
</form>

