<?php
$controla = false;
include('../../models/config.php');
include('../../models/lib.php');

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Reservas</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400&display=swap" rel="stylesheet">
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
    <link rel="stylesheet" href="../Css/style_reserva.css">
</head>

<body>

    <h1>Calendario de Reservas</h1>
    <div class="selector-mes">
        <select id="selectorMes" onchange="cambiarMes()"></select>
    </div>
    <div class="calendario" id="calendario"></div>

    <script>
        const meses = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];

        let anoActual = new Date().getFullYear();
        let mesActual = new Date().getMonth();

        function cargarSelectorMes() {
            const selectorMes = document.getElementById('selectorMes');
            meses.forEach((mes, indice) => {
                const opcion = document.createElement('option');
                opcion.value = indice;
                opcion.textContent = mes;
                opcion.selected = indice === mesActual;
                selectorMes.appendChild(opcion);
            });
        }

        function crearCalendario(mes, ano) {
            const elementoCalendario = document.getElementById('calendario');
            elementoCalendario.innerHTML = '';

            const diasEnMes = new Date(ano, mes + 1, 0).getDate();
            const hoy = new Date();

            // Determinar si el mes es pasado
            const esMesPasado = ano < hoy.getFullYear() || (ano === hoy.getFullYear() && mes < hoy.getMonth());

            const diasSemana = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];
            diasSemana.forEach(dia => {
                const elementoEncabezado = document.createElement('div');
                elementoEncabezado.className = 'dia';
                elementoEncabezado.innerHTML = `<h3>${dia}</h3>`;
                elementoCalendario.appendChild(elementoEncabezado);
            });

            const primerDia = new Date(ano, mes, 1).getDay();

            for (let i = 0; i < primerDia; i++) {
                const elementoVacio = document.createElement('div');
                elementoVacio.className = 'dia';
                elementoCalendario.appendChild(elementoVacio);
            }

            for (let dia = 1; dia <= diasEnMes; dia++) {
                const elementoDia = document.createElement('div');
                elementoDia.className = 'dia';

                const fecha = new Date(ano, mes, dia);
                const esDiaPasado = esMesPasado || (fecha < hoy && mes === hoy.getMonth() && ano === hoy.getFullYear());

                elementoDia.innerHTML = `
                <h3>${dia}</h3>
                <button class="boton-reserva ${esDiaPasado ? 'dia-pasado' : ''}" ${esDiaPasado ? 'disabled' : ''} onclick="reservar(${dia})">
                    ${esDiaPasado ? 'No Disponible' : 'Reservar'}
                </button>
            `;
                elementoCalendario.appendChild(elementoDia);
            }
        }

        function cambiarMes() {
            const selectorMes = document.getElementById('selectorMes');
            mesActual = parseInt(selectorMes.value);
            crearCalendario(mesActual, anoActual);
        }

        cargarSelectorMes();
        crearCalendario(mesActual, anoActual);

        function reservar(dia) {
            const mesFormateado = (mesActual + 1).toString().padStart(2, '0'); // Formatea el mes (agrega un cero al inicio si es un mes de un solo dígito)
            const diaFormateado = dia.toString().padStart(2, '0'); // Formatea el día (agrega un cero al inicio si es un día de un solo dígito)
            const fechaSeleccionada = `${anoActual}-${mesFormateado}-${diaFormateado}`;

            // Redirige al formulario de reserva con la fecha seleccionada como parámetro en la URL
            window.location.href = `../../views/php/formulario_reserva.php?fecha=${fechaSeleccionada}`;
        }
    </script>

</body>

</html>