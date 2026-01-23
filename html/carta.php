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
</head>
<body>
  
    <!-- Header / Cabecera de la página -->  
    <?php include "header.php"; ?>

    <main class="carta">
        <?php
        include "db.php"; // Conexión a la base de datos

        $sql = "SELECT NOMBRE, CATEGORIA, PRECIO, STOCK FROM PRODUCTOS ORDER BY CATEGORIA, NOMBRE";
        $result = $conn->query($sql);

        $categoriaActual = "";

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Si cambia la categoría, mostramos título y lista nueva
                if ($categoriaActual != $row['CATEGORIA']) {
                    if ($categoriaActual != "") {
                        echo "</ul>";
                    }
                    $categoriaActual = $row['CATEGORIA'];
                    echo "<h2>" . htmlspecialchars($categoriaActual) . "</h2>";
                    echo "<ul class='productos'>";
                }

                // Mostrar cada producto con precio y stock
                echo "<li>";
                echo "<span class='nombre'>" . htmlspecialchars($row['NOMBRE']) . "</span>";
                echo "<span class='precio'>" . number_format($row['PRECIO'], 2) . "€</span>";
                echo "<span class='stock'>Disponible: " . intval($row['STOCK']) . "</span>";
                echo "</li>";
            }
            echo "</ul>"; // cerrar última lista
        } else {
            echo "<p>No hay productos disponibles.</p>";
        }

        $conn->close();
        ?>
    </main>

    <script src="js/script.js"></script>
</body>
</html>

