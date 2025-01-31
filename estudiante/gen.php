
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congreso Estatal 2025</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            flex-direction: column;
        }

        .card {
            width: 90%;
            max-width: 400px;
            height: auto;
            border: 2px solid #5EC7A1;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            background-color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
        }

        .cord-space {
            height: 20px;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #611232;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .header h2 {
            font-size: 16px;
            margin: 0;
        }

        .header img {
            margin-top: 10px;
            height: 60px;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            text-align: center;
        }

        .content .name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .content .role {
            font-size: 16px;
            color: #fff;
            background-color: #5EC7A1;
            padding: 8px 15px;
            border-radius: 10px;
            margin: 10px 0;
        }

        .content .qr img {
            margin: 15px 0;
            width: 100px;
            height: 100px;
        }

        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }

        .footer span {
            display: block;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        button {
            background-color: #5EC7A1;
            color: white;
            font-size: 14px;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #4a9c85;
            transform: translateY(-2px);
        }

        button:active {
            background-color: #3e7b64;
            transform: translateY(2px);
        }

        @media (max-width: 480px) {
            .header h2 {
                font-size: 14px;
            }

            .content .name {
                font-size: 16px;
            }

            .content .role {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="card" id="content-to-pdf">
        <div class="cord-space"></div>
        <div class="header">
            <h2>CONGRESO ESTATAL DE TECNOLOGÍAS DE LA INFORMACIÓN <br> Y DESARROLLO DE SOFTWARE 2025</h2>
            <img src="../assets/img/contenido/LogoUTVM.png" alt="Logo">
        </div>
        <div class="content">
            <div class="name">
                <?php 
                    if (isset($filas['nombre']) && isset($filas['apellido'])) {
                        echo htmlspecialchars($filas['nombre']) . " " . htmlspecialchars($filas['apellido']);
                    } else {
                        echo "Nombre no disponible";
                    }
                ?>
            </div>
            <div class="role">ASISTENTE</div>
            <div class="qr">
                <?php 
                    if (isset($svg)) {
                        echo $svg;
                    } else {
                        echo "<img src='default-qr.png' alt='Código QR'>";
                    }
                ?>
            </div>
        </div>
        <div class="footer">
            <span>www.utvm.edu.mx</span>
            <span>ogarcia@utvm.edu.mx</span>
            <span>Carretera Ixmiquilpan-Capula Km. 4</span>
            <span><strong>Ixmiquilpan, Hidalgo, México</strong></span>
        </div>
    </div>

    <div class="buttons">
        <button id="download">Descargar PDF</button>
        <button id="close">Cerrar</button>
    </div>

    <script>
        document.getElementById('download').addEventListener('click', function () {
            const element = document.getElementById('content-to-pdf');
            html2pdf(element, {
                margin: 10,
                filename: 'gafete_congreso.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            });
        });

        document.getElementById('close').addEventListener('click', function () {
            window.history.back();
        });
    </script>
</body>
</html>