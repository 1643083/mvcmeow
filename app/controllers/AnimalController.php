<?php

require_once '../models/Animal.php';
$animal = new Animal();

if (isset($_POST['operacion'])) {

  switch ($_POST['operacion']) {

    case 'listar':
      echo json_encode($animal->listar());
      break;

    // Registrar
    case 'registrar':

      // Nombre del archivo de la foto
      $nombreFoto = null;

      if (isset($_FILES['foto'])) {
        $nombreFoto = time() . "_" . $_FILES['foto']['name'];
        $rutaDestino = "../../public/images/" . $nombreFoto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
      }

      $datos = [
        "nombre"        => $_POST['nombre'],
        "especie"       => $_POST['especie'],
        "edad"          => $_POST['edad'],
        "descripcion"   => $_POST['descripcion'],
        "foto"          => $nombreFoto,
        "estado"        => $_POST['estado']
      ];

      $id = $animal->registrar($datos);
      echo json_encode(["id" => $id]);
      break;

    // Actualizar
    case 'actualizar':

      $nombreFoto = $_POST['foto_actual'];

      if (!empty($_FILES['foto']['name'])) {
        $nombreFoto = time() . "_" . $_FILES['foto']['name'];
        $rutaDestino = "../../public/images/" . $nombreFoto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
      }

      $datos = [
        "id"            => $_POST['id'],
        "nombre"        => $_POST['nombre'],
        "especie"       => $_POST['especie'],
        "edad"          => $_POST['edad'],
        "descripcion"   => $_POST['descripcion'],
        "foto"          => $nombreFoto,
        "estado"        => $_POST['estado']
      ];

      echo json_encode([
        "filas" => $animal->actualizar($datos)
      ]);
      break;

    // Eliminar
    case 'eliminar':
      echo json_encode([
        "filas" => $animal->eliminar($_POST['id'])
      ]);
      break;

    // Buscar por ID
    case 'buscarPorId':
      echo json_encode($animal->buscarPorId($_POST['id']));
      break;

    // Buscar por especie
    case 'buscarPorEspecie':
      echo json_encode($animal->buscarPorEspecie($_POST['especie']));
      break;

    // Buscar por estado (Disponible / Adoptado)
    case 'buscarPorEstado':
      echo json_encode($animal->buscarPorEstado($_POST['estado']));
      break;

    // para el landing page
    case 'listarDisponibles':
    echo json_encode($animal->listarDisponibles());
    break;

  }
}
