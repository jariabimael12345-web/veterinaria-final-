<?php

require_once("ListarMascotas.php");

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
    <title>Lista de Mascotas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body{ background:#f1f1f1; }
        .contenedor{ max-width:1000px; margin:30px auto; padding:0 15px; }
        .pagina-activa{ font-weight:bold; text-decoration:underline; }
    </style>
</head>
<body>

<div class="contenedor">

    <div class="w3-card w3-white w3-padding">

        <h2 class="w3-text-blue">
            <i class="fa fa-list"></i> Lista de Mascotas Registradas
        </h2>

        <p>
            <a href="index.php" class="w3-button w3-blue w3-margin-bottom">
                <i class="fa fa-arrow-left"></i> Volver al registro
            </a>
            <a href="dashboard_vet.php" class="w3-button w3-blue w3-margin-bottom">
                <i class="fa fa-gauge"></i> Ir al Dashboard
            </a>
        </p>

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

</body>
</html>
