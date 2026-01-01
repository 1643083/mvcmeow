<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar animal</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-dark bg-success">
  <div class="container">
    <span class="navbar-brand">Refugio Meow</span>
  </div>
</nav>

<div class="container">
  <h1>Editar animal</h1>

  <form id="form-editar" enctype="multipart/form-data">
    <input type="hidden" id="id">
    <input type="hidden" id="foto_actual">

    <div class="mb-2">
      <label>Nombre</label>
      <input class="form-control" id="nombre" required>
    </div>

    <div class="mb-2">
      <label>Especie</label>
      <select class="form-select" id="especie" required>
        <option value="">Seleccione</option>
        <option value="perro">Perro</option>
        <option value="gato">Gato</option>
        <option value="otro">Otro</option>
      </select>
    </div>

    <div class="mb-2">
      <label>Edad</label>
      <input type="number" min="0" class="form-control" id="edad">
    </div>

    <div class="mb-2">
      <label>Estado</label>
      <select class="form-select" id="estado">
        <option value="disponible">Disponible</option>
        <option value="adoptado">Adoptado</option>
      </select>
    </div>

    <div class="mb-2">
      <label>Descripción</label>
      <textarea class="form-control" id="descripcion"></textarea>
    </div>

    <div class="mb-2">
      <label>Foto actual</label><br>
      <img id="preview" src="" class="img-thumbnail mb-2" style="max-height:200px;">
    </div>

    <div class="mb-3">
      <label>Nueva foto (opcional)</label>
      <input type="file" class="form-control" id="foto">
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<script>
const params = new URLSearchParams(window.location.search)
const id = params.get("id")

// traer datos
const datos = new FormData()
datos.append("operacion", "buscarPorId")
datos.append("id", id)

fetch("../../app/controllers/AnimalController.php", {
  method: "POST",
  body: datos
})
.then(res => res.json())
.then(data => {
  const a = data[0]

  document.querySelector("#id").value = a.id
  document.querySelector("#nombre").value = a.nombre
  document.querySelector("#especie").value = a.especie
  document.querySelector("#edad").value = a.edad
  document.querySelector("#estado").value = a.estado
  document.querySelector("#descripcion").value = a.descripcion
  document.querySelector("#foto_actual").value = a.foto

  document.querySelector("#preview").src =
    "../../public/images/" + a.foto
})

// actualizar
document.querySelector("#form-editar").addEventListener("submit", function(e){
  e.preventDefault()

  const datos = new FormData()
  datos.append("operacion", "actualizar")
  datos.append("id", document.querySelector("#id").value)
  datos.append("nombre", document.querySelector("#nombre").value)
  datos.append("especie", document.querySelector("#especie").value)
  datos.append("edad", document.querySelector("#edad").value)
  datos.append("estado", document.querySelector("#estado").value)
  datos.append("descripcion", document.querySelector("#descripcion").value)
  datos.append("foto_actual", document.querySelector("#foto_actual").value)

  const foto = document.querySelector("#foto").files[0]
  if (foto) {
    datos.append("foto", foto)
  }

  fetch("../../app/controllers/AnimalController.php", {
    method: "POST",
    body: datos
  })
  .then(res => res.json())
  .then(() => {
    window.location.href = "listar.php"
  })
})
</script>

</body>
</html>
