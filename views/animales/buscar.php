<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Buscar animales</title>
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
  <h1>Búsqueda de animales</h1>

  <div class="mb-3">
    <a href="../index.php" class="btn btn-outline-secondary btn-sm">Página principal</a>
    <a href="./listar.php" class="btn btn-outline-primary btn-sm">Listar</a>
    <a href="./crear.php" class="btn btn-outline-success btn-sm">Crear</a>
    <a href="./buscar.php" class="btn btn-outline-info btn-sm">Buscar</a>
  </div>


  <form id="form-busqueda-id" class="mb-3">
    <label>Buscar por ID</label>
    <div class="input-group">
      <input type="number" id="idbuscado" class="form-control">
      <button class="btn btn-success">Buscar</button>
    </div>
  </form>


  <form id="form-busqueda-especie" class="mb-3">
    <label>Buscar por especie</label>
    <div class="input-group">
      <select id="especie" class="form-select">
        <option value="">Seleccione</option>
        <option value="perro">Perro</option>
        <option value="gato">Gato</option>
        <option value="otro">Otro</option>
      </select>
      <button class="btn btn-success">Buscar</button>
    </div>
  </form>


  <form id="form-busqueda-estado" class="mb-3">
    <label>Buscar por estado</label>
    <div class="input-group">
      <select id="estado" class="form-select">
        <option value="">Seleccione</option>
        <option value="disponible">Disponible</option>
        <option value="adoptado">Adoptado</option>
      </select>
      <button class="btn btn-success">Buscar</button>
    </div>
  </form>

  <hr>


  <div class="row" id="contenedor-resultados"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

  function renderizarCards(data){
    const contenedor = document.querySelector("#contenedor-resultados")
    contenedor.innerHTML = ""

    if (data.length === 0){
      contenedor.innerHTML = `<p class="text-muted">No se encontraron resultados</p>`
      return
    }

    data.forEach(a => {
      contenedor.innerHTML += `
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="../../public/images/${a.foto}" 
                 class="card-img-top"
                 style="height:220px; object-fit:cover;">
            <div class="card-body">
              <h5>${a.nombre}</h5>
              <p>
                <strong>Especie:</strong> ${a.especie}<br>
                <strong>Edad:</strong> ${a.edad}<br>
                <strong>Estado:</strong> ${a.estado}
              </p>
              <p>${a.descripcion ?? ""}</p>
            </div>
          </div>
        </div>
      `
    })
  }

  // ID
  document.querySelector("#form-busqueda-id").addEventListener("submit", function(e){
    e.preventDefault()
    const datos = new FormData()
    datos.append("operacion", "buscarPorId")
    datos.append("id", document.querySelector("#idbuscado").value)

    fetch("../../app/controllers/AnimalController.php", { method:"POST", body:datos })
      .then(r => r.json())
      .then(data => renderizarCards(data))
  })

  // Especie
  document.querySelector("#form-busqueda-especie").addEventListener("submit", function(e){
    e.preventDefault()
    const datos = new FormData()
    datos.append("operacion", "buscarPorEspecie")
    datos.append("especie", document.querySelector("#especie").value)

    fetch("../../app/controllers/AnimalController.php", { method:"POST", body:datos })
      .then(r => r.json())
      .then(data => renderizarCards(data))
  })

  // Estado
  document.querySelector("#form-busqueda-estado").addEventListener("submit", function(e){
    e.preventDefault()
    const datos = new FormData()
    datos.append("operacion", "buscarPorEstado")
    datos.append("estado", document.querySelector("#estado").value)

    fetch("../../app/controllers/AnimalController.php", { method:"POST", body:datos })
      .then(r => r.json())
      .then(data => renderizarCards(data))
  })

})
</script>

</body>
</html>
