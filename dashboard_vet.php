<?php
session_start();
require_once("ListarMascotas.php");

$mensaje = $_SESSION['mensaje'] ?? null;
$tipo = $_SESSION['tipo_mensaje'] ?? null;
unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);

$porPagina = 5;

$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
if($pagina < 1){
    $pagina = 1;
}

$listar = new ListarMascotas();

$total = $listar->contar();
$totalPaginas = (int) ceil($total / $porPagina);
if($totalPaginas < 1){
    $totalPaginas = 1;
}

if($pagina > $totalPaginas){
    $pagina = $totalPaginas;
}

$mascotas = $listar->listar($pagina, $porPagina);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Veterinario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body{
            background:#f1f1f1;
        }

        .contenido{
            margin-left:270px;
            padding:25px;
        }

        .logo{
            width:90px;
            display:block;
            margin:auto;
        }

        .pagina-activa{
            font-weight:bold;
            text-decoration:underline;
        }
    </style>
</head>

<body>

<div class="w3-sidebar w3-bar-block w3-card w3-blue" style="width:270px;">

    <div class="w3-container w3-center w3-padding-16 w3-card">
        <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" class="logo">
        <h4>Veterinaria Jari</h4>
        <p><b>Administrador</b></p>
    </div>

    <button onclick="document.getElementById('m1').classList.toggle('w3-show')" class="w3-button w3-block w3-left-align w3-hover-blue">
        <i class="fa fa-dog"></i> Mascotas
    </button>

    <div id="m1" class="w3-hide w3-white w3-show">
        <a href="lista.php" class="w3-bar-item w3-button w3-hover-blue">Lista de Mascotas</a>
        <a href="dashboard_vet.php" class="w3-bar-item w3-button w3-hover-blue">Registro de Pacientes</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Actualizar Datos de Mascota</a>
    </div>

    <button onclick="document.getElementById('m2').classList.toggle('w3-show')" class="w3-button w3-block w3-left-align w3-hover-blue">
        <i class="fa fa-user-doctor"></i> Cirugías
    </button>

    <div id="m2" class="w3-hide w3-white">
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Calendario de Cirugías</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Programar Cirugía</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Seguimiento Postoperatorio</a>
    </div>

    <button onclick="document.getElementById('m3').classList.toggle('w3-show')" class="w3-button w3-block w3-left-align w3-hover-blue">
        <i class="fa fa-syringe"></i> Vacunación
    </button>

    <div id="m3" class="w3-hide w3-white">
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Historial de Vacunación</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Registrar Nueva Vacuna</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Próximas Vacunas</a>
    </div>

    <button onclick="document.getElementById('m4').classList.toggle('w3-show')" class="w3-button w3-block w3-left-align w3-hover-blue">
        <i class="fa fa-pills"></i> Farmacia
    </button>

    <div id="m4" class="w3-hide w3-white">
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Inventario de Farmacia</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Entrada de Medicamentos</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Medicamentos por Vencer</a>
    </div>

    <button onclick="document.getElementById('m5').classList.toggle('w3-show')" class="w3-button w3-block w3-left-align w3-hover-blue">
        <i class="fa fa-file-invoice-dollar"></i> Facturación
    </button>

    <div id="m5" class="w3-hide w3-white">
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Nueva Factura</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Historial de Facturas</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Pagos Pendientes</a>
    </div>

    <button onclick="document.getElementById('m6').classList.toggle('w3-show')" class="w3-button w3-block w3-left-align w3-hover-blue">
        <i class="fa fa-gear"></i> Configuración
    </button>

    <div id="m6" class="w3-hide w3-white">
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Datos de la Clínica</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Usuarios del Sistema</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-blue">Cerrar Sesión</a>
    </div>

</div>

<div class="contenido">

    <div class="w3-card w3-white w3-padding">

        <h2 class="w3-text-blue">
            <i class="fa fa-paw"></i>
            Registro de Pacientes
        </h2>

        <?php if($mensaje): ?>
            <div class="w3-panel <?= $tipo === 'exito' ? 'w3-green' : 'w3-red' ?> w3-round">
                <p><?= htmlspecialchars($mensaje) ?></p>
            </div>
        <?php endif; ?>

        <form action="guardar.php" method="post">

            <input type="hidden" name="origen" value="dashboard">

            <div class="w3-row-padding">

                <div class="w3-half">
                    <label>Nombre de la Mascota</label>
                    <input class="w3-input w3-border" type="text" name="nombre" required>
                </div>

                <div class="w3-half">
                    <label>Especie</label>
                    <input class="w3-input w3-border" type="text" name="especie" required>
                </div>

            </div>

            <br>

            <div class="w3-row-padding">

                <div class="w3-half">
                    <label>Raza</label>
                    <input class="w3-input w3-border" type="text" name="raza" required>
                </div>

                <div class="w3-half">
                    <label>Edad</label>
                    <input class="w3-input w3-border" type="number" name="edad" required>
                </div>

            </div>

            <br>

            <div class="w3-row-padding">

                <div class="w3-half">
                    <label>Peso</label>
                    <input class="w3-input w3-border" type="number" step="0.01" name="peso" required>
                </div>

                <div class="w3-half">
                    <label>Color / Señas físicas</label>
                    <input class="w3-input w3-border" type="text" name="color">
                </div>

            </div>

            <br>

            <div class="w3-row-padding">

                <div class="w3-half">
                    <label>Responsable</label>
                    <input class="w3-input w3-border" type="text" name="responsable" required>
                </div>

                <div class="w3-half">
                    <label>Teléfono</label>
                    <input class="w3-input w3-border" type="text" name="telefono">
                </div>

            </div>

            <br>

            <button class="w3-button w3-green" type="submit">
                <i class="fa fa-save"></i> Guardar
            </button>

            <button type="reset" class="w3-button w3-red">
                <i class="fa fa-trash"></i> Limpiar
            </button>

        </form>

        <hr class="w3-margin-top w3-margin-bottom">

        <?php if(count($mascotas) === 0): ?>

            <p>Todavía no hay mascotas registradas.</p>

        <?php else: ?>

            <table class="w3-table-all w3-hoverable">
                <thead>
                    <tr class="w3-blue">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Raza</th>
                        <th>Edad</th>
                        <th>Peso</th>
                        <th>Color</th>
                        <th>Responsable</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($mascotas as $m): ?>
                        <tr>
                            <td><?= htmlspecialchars($m['id']) ?></td>
                            <td><?= htmlspecialchars($m['nombre']) ?></td>
                            <td><?= htmlspecialchars($m['especie']) ?></td>
                            <td><?= htmlspecialchars($m['raza']) ?></td>
                            <td><?= htmlspecialchars($m['edad']) ?></td>
                            <td><?= htmlspecialchars($m['peso']) ?></td>
                            <td><?= htmlspecialchars($m['color']) ?></td>
                            <td><?= htmlspecialchars($m['responsable']) ?></td>
                            <td><?= htmlspecialchars($m['telefono']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="w3-bar w3-margin-top w3-center">

                <a href="?pagina=<?= max(1, $pagina - 1) ?>"
                   class="w3-bar-item w3-button w3-border <?= $pagina <= 1 ? 'w3-disabled' : '' ?>">
                    <i class="fa fa-chevron-left"></i> Anterior
                </a>

                <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a href="?pagina=<?= $i ?>"
                       class="w3-bar-item w3-button w3-border <?= $i === $pagina ? 'w3-blue pagina-activa' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <a href="?pagina=<?= min($totalPaginas, $pagina + 1) ?>"
                   class="w3-bar-item w3-button w3-border <?= $pagina >= $totalPaginas ? 'w3-disabled' : '' ?>">
                    Siguiente <i class="fa fa-chevron-right"></i>
                </a>

            </div>

            <p class="w3-small w3-text-grey w3-center">
                Página <?= $pagina ?> de <?= $totalPaginas ?> — <?= $total ?> mascota(s) en total.
            </p>

        <?php endif; ?>

    </div>

</div>

<footer>
    <p>Jari Abimael Rodriguez</p>
</footer>

</body>
</html>

