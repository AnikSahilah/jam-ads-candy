<?php
$profil = $profil ?? [];
?>
<div class="container-fluid footer bg-dark wow fadeIn" data-wow-delay=".3s">
    <div class="container mt-3 pt-5 pb-4">
        <div class="row justify-content-center">
            <?php foreach ($profil as $footer) : ?>
                <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                    <h5 class="text-uppercase text-light mb-4">Alamat</h5>
                    <p class="m-0"><span class="text-white"><?= $footer->alamat; ?></span></p>
                </div>
                <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                    <h5 class="text-uppercase text-light mb-4">Email</h5>
                    <p class="m-0"><a href="mailto:<?= $footer->email; ?>" class="text-white"><?= $footer->email; ?></a></p>
                </div>
                <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                    <h5 class="text-uppercase text-light mb-4">No. Telepon</h5>
                    <p class="m-0"><a href="tel:<?= $footer->no_hp; ?>" class="text-white"><?= $footer->no_hp; ?></a></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row mt-4">
            <div class="col text-center">
                <p class="m-0">&copy; <a class="text-white font-weight-bold" href="#">Timeless Elegance</a> All Rights Reserved.</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
