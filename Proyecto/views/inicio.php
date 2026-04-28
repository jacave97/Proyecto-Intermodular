<?php include __DIR__ . "/../_header.php"; ?>
 
<section>
    <h2 class="titulo">Destinos populares</h2>
 
    <div class="swiper-container">
        <div class="swiper-wrapper">
 
            <?php foreach ($arrayDestinos as $destino): ?>
                <div class="swiper-slide">
                    <img src="imagenes/<?= $destino->getImagen() ?>" alt="<?= $destino->getNombre() ?>">
                    <span class="carrusel-title-wrapper">
                        <span class="carrusel-title"><?= $destino->getNombre() ?></span>
                    </span>
                    <div class="swiper-slide-footer">
                        <p><?= $destino->getDescripcion() ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
 
        </div>
 
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
 
<section>
    <h2 class="titulo">Antes de viajar</h2>
 
    <div class="grid-viaje">
        <div class="card-viaje">
            <h3>🧳 Equipaje</h3>
            <p>Checklist de lo que debes llevar en tu maleta</p>
        </div>
        <div class="card-viaje">
            <h3>📄 Documentos</h3>
            <p>Pasaporte, visados y requisitos importantes</p>
        </div>
        <div class="card-viaje">
            <h3>💱 Divisa</h3>
            <p>Información sobre cambio de moneda</p>
        </div>
        <div class="card-viaje">
            <h3>💡 Consejos</h3>
            <p>Recomendaciones útiles para tu viaje</p>
        </div>
    </div>
</section>
 
<?php include __DIR__ . "/../_footer.php"; ?>
 
<script>
const swiper = new Swiper('.swiper-container', {
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    slidesPerView: 1,
    spaceBetween: 10
});
</script>