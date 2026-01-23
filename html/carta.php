<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta - DAILY DOSE</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/carta.css">
</head>
<body>
  
    <!-- Header / Cabecera de la página -->  
    <?php include "header.php"; ?>

    <main class="carta-layout">
        <?php
        include "config.php"; 

        // 1. CONSULTA DE PRODUCTOS (CARTA GENERAL)
        $sqlProductos = "SELECT NOMBRE, CATEGORIA, PRECIO, STOCK FROM PRODUCTOS ORDER BY CATEGORIA, NOMBRE";
        $resultProductos = $conn->query($sqlProductos);

        // 2. CONSULTA DE ESPECIALIDAD (DERECHA)
        // Buscamos la especialidad activa según el mes actual (ignorando el año para que sea cíclico o funcione ya)
        $mesActual = date('m');
        $diaActual = date('d');
        // Armamos una fecha ficticia de 2026 para comparar con tu BD
        $fechaComparar = "2026-$mesActual-$diaActual";

        $sqlEspecialidad = "SELECT * FROM ESPECIALIDAD_ACTUAL 
                            WHERE '$fechaComparar' BETWEEN FECHA_INICIO AND FECHA_FIN 
                            LIMIT 1";
        
        // Si no encuentra por fecha exacta (por si acaso), toma la primera disponible como fallback
        $resultEspecialidad = $conn->query($sqlEspecialidad);
        if ($resultEspecialidad->num_rows == 0) {
             $sqlEspecialidad = "SELECT * FROM ESPECIALIDAD_ACTUAL LIMIT 1";
             $resultEspecialidad = $conn->query($sqlEspecialidad);
        }
        
        $especial = $resultEspecialidad->fetch_assoc();
        ?>

        <section class="columna-productos">
            <?php
            $categoriaActual = "";

            if ($resultProductos && $resultProductos->num_rows > 0) {
                while($row = $resultProductos->fetch_assoc()) {
                    if ($categoriaActual != $row['CATEGORIA']) {
                        if ($categoriaActual != "") { echo "</ul>"; }
                        $categoriaActual = $row['CATEGORIA'];
                        echo "<h2>" . htmlspecialchars($categoriaActual) . "</h2>";
                        echo "<ul class='productos'>";
                    }
                    echo "<li>";
                    echo "<div class='info-prod'>";
                    echo "<span class='nombre'>" . htmlspecialchars($row['NOMBRE']) . "</span>";
                    echo "</div>";
                    
                    echo "<div class='meta-prod'>";
                    echo "<span class='precio'>" . number_format($row['PRECIO'], 2) . "€</span>";
                    // Pequeña lógica visual para el stock
                    $claseStock = ($row['STOCK'] < 10) ? 'stock-bajo' : 'stock-ok';
                    echo "<span class='stock $claseStock'>Stock: " . intval($row['STOCK']) . "</span>";
                    echo "</div>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='mensaje-vacio'>No hay productos disponibles.</p>";
            }
            ?>
        </section>

        <aside class="columna-lateral">
            <?php if ($especial): ?>
                <div class="tarjeta-especialidad">
                    <div class="header-especial">
                        <h3>DAILY SPECIAL</h3>
                        <p class="fechas">Edición Limitada</p>
                    </div>

                    <div class="seccion-grano">
                        <h4>Origen del Grano</h4>
                        <p class="origen"><?php echo htmlspecialchars($especial['ORIGEN_GRANO']); ?></p>
                        <p class="notas"><i>"<?php echo htmlspecialchars($especial['NOTAS_CATA']); ?>"</i></p>
                        <div class="etiqueta"><?php echo htmlspecialchars($especial['TUESTE']); ?></div>
                    </div>

                    <hr>

                    <div class="seccion-metodo">
                        <h4>Recomendación de Barista</h4>
                        <p class="metodo"><?php echo htmlspecialchars($especial['METODO_FILTRO']); ?></p>
                        <p class="desc-filtro"><?php echo htmlspecialchars($especial['DESCRIPCION_FILTRO']); ?></p>
                    </div>

                    <div class="destacado-seasonal">
                        <h4>Bebida de Temporada</h4>
                        <p class="seasonal-nombre"><?php echo htmlspecialchars($especial['SEASONAL_NOMBRE']); ?></p>
                        <p class="seasonal-desc"><?php echo htmlspecialchars($especial['SEASONAL_DESCRIPCION']); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </aside>

        <?php $conn->close(); ?>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

