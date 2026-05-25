<?php 
require_once 'includes/data.php';
include 'includes/header.php'; 

$moto_seleccionada = isset($_GET['moto']) ? $_GET['moto'] : '';
?>

<section class="container">
    <h1 class="section-title">Formulario de Inscripción</h1>
    <div class="form-container">
        <form action="procesar.php" method="POST" id="registrationForm">
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo de Interés:</label>
                <select id="modelo" name="modelo" required>
                    <option value="">Seleccione una moto</option>
                    <?php foreach ($motos as $m): ?>
                        <option value="<?php echo $m['nombre']; ?>" <?php echo ($moto_seleccionada == $m['nombre']) ? 'selected' : ''; ?>>
                            <?php echo $m['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="mensaje">Comentarios:</label>
                <textarea id="mensaje" name="mensaje" rows="4"></textarea>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Enviar Inscripción</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
