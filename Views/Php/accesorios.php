<?php
// Conexión a la base de datos
include('../../models/config.php');
include('../../models/lib.php');
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);


$query = "SELECT * FROM accesorios";
$result = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Concesionario KTM</title>
    <link rel="stylesheet" href="../../views/css/accesorios_styles.css">
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
</head>

<body>

    <header>
        <div class="header-section container">
            <a href="../../index.php">
                <img class="logo" src="../../public/IMG/logo.jpg" alt="Logo">
            </a>
            <h1>Accesorios que marcan la diferencia:</h1>
            <div>
                <img onclick="showCart()" class="cart" src="../../public/img/carrito-compra.jpg" alt="Carrito de compras">
                <p class="count-product">0</p>
            </div>
            <div class="cart-products" id="products-id">
                <p class="close-btn" onclick="closeBtn()">X</p>
                <h3>Mi carrito</h3>
                <div class="card-items">
                    <!-- Aquí me irán apareciendo los productos asignados -->
                </div>
                <h2>Total: €<strong class="price-total">0</strong></h2>
            </div>
        </div>
    </header>

    <section class="container">
        <div class="products">
            <!-- Mostrar los productos desde la base de datos -->
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="carts">
                    <div class="imagen-producto">
                        <!-- Mostrar imagen desde la base de datos -->
                        <img src="../../public/img/<?php echo $row['imagen']; ?>" alt="<?php echo $row['titulo_producto']; ?>">
                        <p><span><?php echo $row['precio']; ?></span>€</p>
                    </div>
                    <p class="title"><?php echo $row['titulo_producto']; ?></p>
                    <a href="#" data-id="<?php echo $row['id']; ?>" class="btn-add-cart">Añadir a la cesta</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <script>
        function showCart() {
            console.log("Mostrando el carrito");
            document.getElementById("products-id").style.display = "block";
        }

        function closeBtn() {
            console.log("Cerrando el carrito");
            document.getElementById("products-id").style.display = "none";
        }
    </script>
    <script src="../../views/js/accesorios.js"></script>

</body>

</html>