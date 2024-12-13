<?php

$profil = $profil ?? [];

?>
<?php foreach ($profil as $header) :  ?>
    <!-- <div class="top-header"> -->
        <!-- <div class="container"> -->
            <!-- <div class="top-header-left"> -->
                <!-- <div class="top-header-block"> -->
                    <!-- <a href="#" itemprop="email"><i class="fas fa-envelope"></i> <?= $header->email; ?></a> -->
                <!-- </div> -->
                <!-- <div class="top-header-block"> -->
                    <!-- <a href="#" itemprop="telephone"><i class="fas fa-phone"></i> <?= $header->no_hp; ?></a> -->
                <!-- </div> -->
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
    <?= $this->include('user/layout/nav'); ?>
<?php endforeach;  ?>
<!-- Navbar End -->