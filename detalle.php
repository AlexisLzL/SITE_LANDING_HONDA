<?php 
require_once 'includes/data.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$moto = null;

foreach ($motos as $m) {
    if ($m['id'] === $id) {
        $moto = $m;
        break;
    }
}

if (!$moto) {
    header('Location: motos.php');
    exit;
}

include 'includes/header.php'; 
?>

<section class="container">
    <?php $galeria = $moto['galeria'] ?? [$moto['imagen']]; ?>
    <div class="detalle-grid">
        <div class="detalle-imagen">
            <img src="<?php echo $galeria[0]; ?>" alt="<?php echo $moto['nombre']; ?>" class="detalle-principal">
            <div class="detalle-miniaturas">
                <?php foreach ($galeria as $foto): ?>
                <img src="<?php echo $foto; ?>" alt="Vista de <?php echo $moto['nombre']; ?>">
                <?php endforeach; ?>
            </div>
            <div style="margin-top: 2rem;">
                <h2><?php echo $moto['nombre']; ?></h2>
                <p class="categoria"><?php echo $moto['categoria']; ?></p>
                <p class="price" style="font-size: 2rem; margin: 1rem 0;"><?php echo $moto['precio']; ?></p>
                <p><?php echo $moto['descripcion']; ?></p>
                <br>
                <a href="registro.php?moto=<?php echo urlencode($moto['nombre']); ?>" class="btn-primary">Solicitar Información</a>
            </div>
        </div>
        
        <div class="ficha-tecnica">
            <h3>Ficha Técnica</h3>
            <br>
            <table>
                <?php foreach ($moto['ficha'] as $key => $value): ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $value; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
