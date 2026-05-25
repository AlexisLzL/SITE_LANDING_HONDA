<?php
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : 'N/A';
$email = isset($_POST['email']) ? $_POST['email'] : 'N/A';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : 'N/A';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : 'N/A';
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : 'N/A';
$fecha = date('d/m/Y H:i:s');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inscripción - Honda Motos</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .report-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, .15); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #cc0000; padding-bottom: 20px; margin-bottom: 20px; }
        .header img { height: 50px; }
        .title { font-size: 24px; font-weight: bold; color: #cc0000; }
        .section { margin-bottom: 20px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #ddd; margin-bottom: 10px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 10px; border-bottom: 1px solid #f9f9f9; }
        .label { font-weight: bold; width: 30%; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 20px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #cc0000; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
            <i class="fas fa-print"></i> Descargar como PDF / Imprimir
        </button>
        <p><small>(Seleccione "Guardar como PDF" en el destino de impresión)</small></p>
    </div>

    <div class="report-box">
        <div class="header">
            <div class="title">REPORTE DE INSCRIPCIÓN</div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7b/Honda_Logo.svg" alt="Honda Logo">
        </div>

        <div class="section">
            <div class="section-title">Detalles del Solicitante</div>
            <table>
                <tr>
                    <td class="label">Nombre:</td>
                    <td><?php echo htmlspecialchars($nombre); ?></td>
                </tr>
                <tr>
                    <td class="label">Correo:</td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <td class="label">Teléfono:</td>
                    <td><?php echo htmlspecialchars($telefono); ?></td>
                </tr>
                <tr>
                    <td class="label">Fecha de Solicitud:</td>
                    <td><?php echo $fecha; ?></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Información del Modelo</div>
            <table>
                <tr>
                    <td class="label">Modelo de Interés:</td>
                    <td><?php echo htmlspecialchars($modelo); ?></td>
                </tr>
                <tr>
                    <td class="label">Comentarios:</td>
                    <td><?php echo nl2br(htmlspecialchars($mensaje)); ?></td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Este es un documento oficial generado por el sistema de Honda Motos.</p>
            <p>Honda Motos - The Power of Dreams</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
