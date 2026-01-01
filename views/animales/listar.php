<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animales en adopción</title>
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
  <h1 class="mb-3">Animales registrados</h1>

  <div class="mb-3">
    <a href="../index.php" class="btn btn-outline-secondary btn-sm">Página principal</a>
    <a href="./listar.php" class="btn btn-outline-primary btn-sm">Listar</a>
    <a href="./crear.php" class="btn btn-outline-success btn-sm">Crear</a>
    <a href="./buscar.php" class="btn btn-outline-info btn-sm">Buscar</a>
  </div>

  <div class="row" id="contenedor-cards">
    <!-- cards dinámicas -->
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  obtenerDatos()
})

function obtenerDatos() {
  const datos = new FormData()
  datos.append("operacion", "listar")

  fetch("../../app/controllers/AnimalController.php", {
    method: "POST",
    body: datos
  })
  .then(response => response.json())
  .then(data => {
    const contenedor = document.querySelector("#contenedor-cards")
    contenedor.innerHTML = ""

    data.forEach(animal => {
      contenedor.innerHTML += `
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="../../public/images/${animal.foto}" 
                 class="card-img-top" 
                 alt="${animal.nombre}"
                 style="height: 250px; object-fit: cover;">

            <div class="card-body">
              <h5 class="card-title">${animal.nombre}</h5>
              <p class="card-text">
                <strong>Especie:</strong> ${animal.especie}<br>
                <strong>Edad:</strong> ${animal.edad} años<br>
                <strong>Estado:</strong> ${animal.estado}
              </p>
              <p class="card-text">${animal.descripcion ?? ""}</p>
            </div>

            <div class="card-footer text-end">
              <button 
                class="btn btn-sm btn-danger btn-eliminar"
                data-id="${animal.id}">
                Eliminar
              </button>
              <a href="editar.php?id=${animal.id}" 
                 class="btn btn-sm btn-info">
                Editar
              </a>
            </div>
          </div>
        </div>
      `
    })
  })
}

// eliminar
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("btn-eliminar")) {

    const id = e.target.dataset.id

    if (confirm("¿Desea eliminar este animal?")) {
      const datos = new FormData()
      datos.append("operacion", "eliminar")
      datos.append("id", id)

      fetch("../../app/controllers/AnimalController.php", {
        method: "POST",
        body: datos
      })
      .then(response => response.json())
      .then(() => obtenerDatos())
    }
  }
})
</script>

</body>
</html>
