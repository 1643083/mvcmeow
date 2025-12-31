<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar animal</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-dark bg-success">
  <div class="container">
    <span class="navbar-brand">Refugio Huellitas</span>
  </div>
</nav>

<div class="container">
  <h1>Registro de animales</h1>

  <div class="mb-3">
    <a href="../index.php" class="btn btn-outline-secondary btn-sm">Huellitas</a>
    <a href="./listar.php" class="btn btn-outline-primary btn-sm">Listar</a>
    <a href="./crear.php" class="btn btn-outline-success btn-sm">Crear</a>
    <a href="./buscar.php" class="btn btn-outline-info btn-sm">Buscar</a>
  </div>
  <hr>

  <form id="formulario-animal" enctype="multipart/form-data">
    <div class="card">
      <div class="card-header">Complete el formulario</div>
      <div class="card-body">

        <div class="form-floating mb-2">
          <input type="text" id="nombre" class="form-control" required>
          <label for="nombre">Nombre del animal</label>
        </div>

        <div class="form-floating mb-2">
          <select id="especie" class="form-select" required>
            <option value="">Seleccione especie</option>
            <option value="Perro">Perro</option>
            <option value="Gato">Gato</option>
            <option value="Conejo">Conejo</option>
            <option value="Otro">Otro</option>
          </select>
        </div>

        <div class="form-floating mb-2">
          <input type="number" min="0" id="edad" class="form-control" required>
          <label for="edad">Edad (años)</label>
        </div>

        <div class="form-floating mb-2">
          <select id="estado" class="form-select" required>
            <option value="">Estado</option>
            <option value="Disponible">Disponible</option>
            <option value="Adoptado">Adoptado</option>
          </select>
        </div>

        <div class="mb-2">
          <label class="form-label">Foto del animal</label>
          <input type="file" id="foto" class="form-control" accept="image/*" required>
        </div>

        <div class="form-floating mb-2">
          <textarea id="descripcion" class="form-control" style="height: 100px"></textarea>
          <label for="descripcion">Descripción</label>
        </div>

      </div>
      <div class="card-footer text-end">
        <button class="btn btn-primary" type="button" id="btnGuardar">Guardar</button>
        <button class="btn btn-outline-secondary" type="reset">Cancelar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

  document.querySelector("#btnGuardar").addEventListener("click", function () {
    if (confirm("¿Desea registrar el animal?")) {
      guardarDatos()
    }
  })

  function guardarDatos() {
    const datos = new FormData()
    datos.append("operacion", "registrar")
    datos.append("nombre", document.querySelector("#nombre").value)
    datos.append("especie", document.querySelector("#especie").value)
    datos.append("edad", document.querySelector("#edad").value)
    datos.append("estado", document.querySelector("#estado").value)
    datos.append("descripcion", document.querySelector("#descripcion").value)
    datos.append("foto", document.querySelector("#foto").files[0])

    fetch('../../app/controllers/AnimalController.php', {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {
      console.log(data)
      if (data.id > 0) {
        alert("Animal registrado correctamente")
        document.querySelector("#formulario-animal").reset()
      } else {
        alert("No se pudo registrar el animal")
      }
    })
  }

})
</script>

</body>
</html>
