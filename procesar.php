<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validación básica
    $nombre = trim(htmlspecialchars(strip_tags($_POST['nombre'] ?? ''), ENT_QUOTES, 'UTF-8'));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $telefono = trim(htmlspecialchars(strip_tags($_POST['telefono'] ?? ''), ENT_QUOTES, 'UTF-8'));
    $modelo = trim(htmlspecialchars(strip_tags($_POST['modelo'] ?? ''), ENT_QUOTES, 'UTF-8'));
    $mensaje = trim(htmlspecialchars(strip_tags($_POST['mensaje'] ?? ''), ENT_QUOTES, 'UTF-8'));

    $errores = [];

    // Validaciones estrictas
    if (empty($nombre) || strlen($nombre) < 3) {
        $errores[] = "El nombre es obligatorio y debe tener al menos 3 caracteres.";
    }
    if (!$email) {
        $errores[] = "Debe proporcionar un correo electrónico válido.";
    }
    if (empty($telefono) || !preg_match('/^[0-9\-\+\s]{7,15}$/', $telefono)) {
        $errores[] = "El teléfono es obligatorio y debe contener un formato válido (7 a 15 dígitos).";
    }
    if (empty($modelo)) {
        $errores[] = "Debe seleccionar un modelo de interés.";
    }

    if (empty($errores)) {
        // Guardar en la base de datos SQLite
        try {
            $db = new Database();
            $pdo = $db->getPdo();
            
            $stmt = $pdo->prepare("INSERT INTO inscripciones (nombre, email, telefono, modelo, mensaje) VALUES (:nombre, :email, :telefono, :modelo, :mensaje)");
            $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':telefono' => $telefono,
                ':modelo' => $modelo,
                ':mensaje' => $mensaje
            ]);
        } catch (PDOException $e) {
            $errores[] = "Error al guardar en la base de datos: " . $e->getMessage();
        }
    }

    include 'includes/header.php';
    ?>
    <section class="container">
        <div class="form-container" style="text-align: center;">
            <?php if (empty($errores)): ?>
                <i class="fas fa-check-circle" style="font-size: 4rem; color: green; margin-bottom: 1rem;"></i>
                <h2>¡Inscripción Exitosa!</h2>
                <p>Gracias <strong><?php echo $nombre; ?></strong> por tu interés en Honda.</p>
                
                <div style="text-align: left; background: white; padding: 1.5rem; margin: 2rem 0; border-radius: 5px; border-left: 5px solid var(--honda-red);">
                    <h3>Resumen de datos:</h3>
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                    <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
                    <p><strong>Modelo:</strong> <?php echo $modelo; ?></p>
                    <p><strong>Mensaje:</strong> <?php echo $mensaje; ?></p>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="index.php" class="btn-primary" style="background: var(--honda-black);">Volver al Inicio</a>
                    <form action="reporte.php" method="POST" target="_blank">
                        <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="hidden" name="telefono" value="<?php echo $telefono; ?>">
                        <input type="hidden" name="modelo" value="<?php echo $modelo; ?>">
                        <input type="hidden" name="mensaje" value="<?php echo $mensaje; ?>">
                        <button type="submit" class="btn-primary"><i class="fas fa-file-pdf"></i> Descargar PDF</button>
                    </form>
                </div>
            <?php else: ?>
                <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: var(--honda-red); margin-bottom: 1rem;"></i>
                <h2>Error en la validación</h2>
                <ul style="list-style: none; margin: 1rem 0; color: var(--honda-red);">
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="javascript:history.back()" class="btn-primary">Corregir Datos</a>
            <?php endif; ?>
        </div>
    </section>
    <?php
    include 'includes/footer.php';
} else {
    header('Location: registro.php');
}
?>
