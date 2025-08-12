<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Horarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .group-buttons {
            margin-bottom: 20px;
        }

        .group-buttons button {
            padding: 10px 20px;
            margin: 0 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .group-buttons button.active {
            background-color: #007bff;
            color: #fff;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ccc;
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            cursor: pointer;
        }

        td:hover {
            background-color: #e6f7ff;
        }
    </style>
</head>
<body>
    <div class="group-buttons">
        <button id="EVN10A" onclick="selectGroup('EVN10A')">EVN10A</button>
        <button id="EVN10B" onclick="selectGroup('EVN10B')">EVN10B</button>
        <button id="TI4A" onclick="selectGroup('TI4A')">TI4A</button>
		<button id="b" onclick="selectGroup('b')">Borra</button>
    </div>

    <table id="schedule">
        <thead>
            <tr>
                <th>Hora/Día</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>
        <tbody>
            <!-- Generar horarios dinámicamente con JavaScript -->
        </tbody>
    </table>

    <script>
        const scheduleTable = document.getElementById('schedule').getElementsByTagName('tbody')[0];
        const startTime = 7; // Hora de inicio
        const endTime = 16; // Hora de fin
        let activeGroup = null;

        // Generar filas de la tabla
        for (let hour = startTime; hour < endTime; hour++) {
            const row = scheduleTable.insertRow();
            const timeCell = row.insertCell();
            timeCell.textContent = `${hour}:00 - ${hour + 1}:00`;

            for (let day = 1; day <= 5; day++) {
                const cell = row.insertCell();
                cell.addEventListener('click', () => assignGroup(cell));
            }
        }

        // Selección de grupo
        function selectGroup(groupId) {
            activeGroup = groupId;

            // Cambiar colores de los botones
            document.querySelectorAll('.group-buttons button').forEach(button => {
                button.classList.remove('active');
            });
            document.getElementById(groupId).classList.add('active');
        }

        // Asignar grupo a la celda
        function assignGroup(cell) {
            if (activeGroup) {
                cell.textContent = activeGroup;
                cell.style.backgroundColor = '#d9edf7';
            }
			if (activeGroup=='b') {
                cell.textContent = '';
                cell.style.backgroundColor = '#ffffff';
            }
        }
    </script>
</body>
</html>
