<?php
$controla = false;
include('../../models/config.php');
include('../../models/lib.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../views/css/concesionarios_styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
    <title>Concesionarios</title>

</head>

<body>
    <header>
        <div class="logo">
            <a href="../../index.php">
                <img src="../../public/IMG/logo.jpg" alt="Logo del Concesionario" />
            </a>
        </div>
        <h1>Encuentra tu Concesionario KTM</h1>
        <a href="../../views/html/ayuda.html" class="contact-button">Contacto</a>
    </header>

    <main>
        <section class="info">
            <div class="text-content">
                <h2 class="center-title">¡Vive la Pasión por las Motos!</h2>
                <p>¡Siente la <strong>adrenalina</strong> fluir mientras conquistas cada curva! En nuestro concesionario, no solo vendemos motos; ofrecemos <strong>experiencias únicas</strong> sobre dos ruedas.</p>
                <p>¿Estás listo para ser el dueño de tu propia aventura? <em>Déjate llevar por la emoción de conducir una KTM, donde cada viaje se convierte en un recuerdo inolvidable.</em></p>
                <h3>¡Descubre un Mundo de Posibilidades!</h3>
                <ul>
                    <li><strong>Amplia Gama de Modelos:</strong> Desde veloces deportivas hasta cómodas cruisers, ¡tenemos lo que buscas!</li>
                    <li><strong>Asesoramiento Personalizado:</strong> Nuestro equipo de expertos está listo para guiarte hacia la moto de tus sueños.</li>
                    <li><strong>Financiamiento a tu Medida:</strong> Descubre opciones de pago flexibles que se adaptan a tu estilo de vida.</li>
                </ul>
                <p><strong>¡No esperes más!</strong> Ven a nuestro concesionario y descubre cómo una moto puede cambiar tu vida. ¡La aventura comienza aquí!</p>
            </div>
            <div class="image-content">
                <img src="../../public/IMG/foto_concesionarios2.jpeg" alt="Motos en el Concesionario" class="responsive-image" />
            </div>
        </section>

        <h2>Nuestro Concesionario KTM</h2>
        <section id="map">
            <div id="map"></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Tu Concesionario de Motos. Todos los derechos reservados.</p>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar el mapa
            var mapa = L.map('map').setView([40.416775, -3.703790], 6); // Centrado en España, zoom inicial 6

            // Capa de azulejos de OpenStreetMap
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(mapa);

            // Lista de concesionarios KTM en España (ejemplo)
            const concesionarios = [{
                    coords: [37.4186603, -6.0325378],
                    popup: "Concesionario KTM - Sevilla"
                },
                {
                    coords: [40.416775, -3.703790],
                    popup: "Concesionario KTM - Madrid"
                },
                {
                    coords: [41.387917, 2.169919],
                    popup: "Concesionario KTM - Barcelona"
                },
                {
                    coords: [39.469907, -0.376288],
                    popup: "Concesionario KTM - Valencia"
                },
                {
                    coords: [36.721302, -4.421636],
                    popup: "Concesionario KTM - Málaga"
                },
                {
                    coords: [43.263012, -2.934985],
                    popup: "Concesionario KTM - Bilbao"
                },
                {
                    coords: [37.992239, -1.130654],
                    popup: "Concesionario KTM - Murcia"
                },
                {
                    coords: [42.240599, -8.720726],
                    popup: "Concesionario KTM - Vigo"
                },
                {
                    coords: [28.489307, -16.315001],
                    popup: "Concesionario KTM - Tenerife"
                },
                {
                    coords: [38.345996, -0.490686],
                    popup: "Concesionario KTM - Alicante"
                }
            ];

            // Añadir marcadores para cada concesionario
            concesionarios.forEach(concesionario => {
                L.marker(concesionario.coords).addTo(mapa)
                    .bindPopup(concesionario.popup);
            });
        });
    </script>
</body>

</html>