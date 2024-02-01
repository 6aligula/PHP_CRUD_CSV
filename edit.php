<?php
require_once "./clases/Cartera.php";
require_once "./clases/Empresa.php";

// Instanciar la Cartera
$cartera = new Cartera();
$cartera->loadData("data.csv");

// Recuperar el ID del cliente desde GET
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Intentar recuperar el cliente con ese ID
$client = $cartera->getClient($id);

// Verificar si el formulario ha sido enviado
if (count($_POST) > 0) {
    // Llamar al método update de Cartera con los datos enviados por POST
    $cartera->update($_POST);
    ob_start(); // Iniciar buffer de salida
// Tu código PHP aquí
header("location: index.php"); // Redireccionar
ob_end_flush(); // Enviar el buffer al navegador y finalizarlo
    exit; // Asegurar que el script se detiene después de la redirección
}

// Mostrar el formulario si no se ha enviado o si es la primera carga de la página
?>

<form id="form_x" class="class_x" method="post" action="edit.php?id=<?= $id ?>">
    <!-- Asumiendo que tienes campos como id, company, etc. en tu objeto cliente -->
    <input type="hidden" name="id" value="<?= $client->getId(); ?>">
    <div>
        <label for="company">Empresa:</label>
        <input type="text" id="company" name="company" value="<?= $client->getCompany(); ?>">
    </div>

    <button type="submit">Guardar</button>
</form>
