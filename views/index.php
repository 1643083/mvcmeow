<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Refugio Huellitas</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-dark bg-success">
  <div class="container">
    <span class="navbar-brand">Refugio Huellitas</span>
  </div>
</nav>

<!-- HERO -->
<div class="container mt-5 text-center">
  <h1>Encuentra a tu nuevo mejor amigo</h1>
  <p class="text-muted">
    Todos nuestros animales están buscando un hogar lleno de amor
  </p>
    <a href="./animales/listar.php" class="btn btn-outline-primary btn-sm">Listar</a>
    
</div>

<!-- LISTADO -->
<div class="container mt-4">
  <h3 class="mb-3">Animales disponibles</h3>
  <div class="row" id="contenedor-animales"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

  const contenedor = document.querySelector("#contenedor-animales")

  fetch("../app/controllers/AnimalController.php", {
    method: "POST",
    body: new URLSearchParams({
      operacion: "listarDisponibles"
    })
  })
  .then(r => r.json())
  .then(data => {

    if (data.length === 0){
      contenedor.innerHTML = "<p>No hay animales disponibles</p>"
      return
    }

    data.forEach(a => {
      contenedor.innerHTML += `
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="../public/images/${a.foto}"
                 class="card-img-top"
                 style="height:220px; object-fit:cover;">
            <div class="card-body">
              <h5>${a.nombre}</h5>
              <p>
                <strong>Especie:</strong> ${a.especie}<br>
                <strong>Edad:</strong> ${a.edad} años
              </p>
              <span class="badge bg-success">Disponible</span>
            </div>
          </div>
        </div>
      `
    })

  })

})
</script>

</body>
</html>
