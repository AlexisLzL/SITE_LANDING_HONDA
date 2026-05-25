<?php 
require_once 'includes/data.php';
include 'includes/header.php'; 
?>

<section class="hero">
    <h1>Domina el Camino</h1>
    <p>Descubre la excelencia en ingeniería de Honda</p>
    <br>
    <a href="motos.php" class="btn-primary">Ver Modelos</a>
</section>

<section class="container">
    <h2 class="section-title">Modelos Destacados</h2>
    <div class="grid">
        <?php foreach (array_slice($motos, 0, 3) as $moto): ?>
        <div class="moto-card">
            <img src="<?php echo $moto['imagen']; ?>" alt="<?php echo $moto['nombre']; ?>">
            <div class="moto-info">
                <h3><?php echo $moto['nombre']; ?></h3>
                <p><?php echo $moto['categoria']; ?></p>
                <p class="price"><?php echo $moto['precio']; ?></p>
                <br>
                <a href="detalle.php?id=<?php echo $moto['id']; ?>" class="btn-primary">Ver Detalles</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
