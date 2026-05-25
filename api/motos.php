<?php 
require_once 'includes/data.php';
include 'includes/header.php'; 
?>

<section class="container">
    <h1 class="section-title">Catálogo Completo Honda</h1>
    <div class="grid">
        <?php foreach ($motos as $moto): ?>
        <?php $galeria = $moto['galeria'] ?? [$moto['imagen']]; ?>
        <div class="moto-card">
            <img class="moto-principal" src="<?php echo $galeria[0]; ?>" alt="<?php echo $moto['nombre']; ?>">
            <div class="mini-galeria">
                <?php foreach (array_slice($galeria, 0, 3) as $foto): ?>
                <img src="<?php echo $foto; ?>" alt="Foto de <?php echo $moto['nombre']; ?>">
                <?php endforeach; ?>
            </div>
            <div class="moto-info">
                <h3><?php echo $moto['nombre']; ?></h3>
                <p><?php echo $moto['categoria']; ?></p>
                <p class="price"><?php echo $moto['precio']; ?></p>
                <p><?php echo substr($moto['descripcion'], 0, 100) . '...'; ?></p>
                <br>
                <a href="detalle.php?id=<?php echo $moto['id']; ?>" class="btn-primary">Ficha Técnica</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
