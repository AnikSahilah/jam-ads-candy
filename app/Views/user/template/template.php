<?php
// Ensure $profil is initialized
$profil = $profil ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Dynamic Meta Title and Meta Description -->
  <?php
  $lang = session()->get('lang'); // Misal session 'lang' digunakan untuk mengatur bahasa
  $metaTitle = 'default'; // Default meta title
  $metaDescription = 'default'; // Default meta description

  // Cek bahasa yang aktif
  $locale = service('request')->getLocale();
  // Cek bahasa aktif
  if ($lang === 'en') {
    // Meta title dan description untuk bahasa Inggris
    $metaTitle = $tbproduk->meta_title_inggris ?? $artikel->meta_title_inggris ?? $tbaktivitas->meta_title_inggris ?? $metadata['meta_title_inggris'] ?? 'default';
    $metaDescription = $tbproduk->meta_description_inggris ?? $artikel->meta_description_inggris ?? $tbaktivitas->meta_description_inggris ?? $metadata['meta_description_inggris'] ?? 'default';
  } else {
    // Meta title dan description untuk bahasa Indonesia
    $metaTitle = $tbproduk->meta_title ?? $artikel->meta_title ?? $tbaktivitas->meta_title ?? $metadata['meta_title'] ?? 'default';
    $metaDescription = $tbproduk->meta_description ?? $artikel->meta_description ?? $tbaktivitas->meta_description ?? $metadata['meta_description'] ?? 'default';
  }
  ?>

  <title><?= esc($metaTitle) ?></title>

  <!-- Meta Title -->
  <meta name="title" content="<?= esc($metaTitle) ?>">

  <!-- Meta Description -->
  <meta name="description" content="<?= esc($metaDescription) ?>">

  <!-- Canonical Tag -->
  <link rel="canonical" href="https://jagodigital.kadinkotamalang.com/beranda">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="https://jagodigital.kadinkotamalang.com/assets-new/images/favicon.png">

  <!-- CSS Links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  <link href="https://jagodigital.kadinkotamalang.com/assets-new/css/jdm.css" rel="stylesheet">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">



</head>

<body>

  <?= $this->include('user/layout/header'); ?>

  <!-- render halaman konten -->
  <?= $this->renderSection('content'); ?>

  <!-- footer -->
  <?= $this->include('user/layout/footer');  ?>

  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

  <!-- WhatsApp Button -->
  <a href="https://wa.me/6289696874489" class="btn btn-lg btn-primary btn-lg-square whatsapp-button" target="_blank">
    <i class="bi bi-whatsapp"></i>
  </a>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('asset-user') ?>/lib/wow/wow.min.js"></script>
  <script src="<?= base_url('asset-user') ?>/lib/easing/easing.min.js"></script>
  <script src="<?= base_url('asset-user') ?>/lib/waypoints/waypoints.min.js"></script>
  <script src="<?= base_url('asset-user') ?>/lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Template Javascript -->
  <script src="<?= base_url('asset-user') ?>/js/main.js"></script>
  <script src="<?= base_url('asset-user') ?>/js/lazysizes.min.js"></script>

  <!-- membuat halaman aktif -->
  <script>
    // Ambil URL halaman saat ini
    var currentURL = window.location.href;

    // Dapatkan daftar semua elemen <a> di dalam navbar
    var menuLinks = document.querySelectorAll(".navbar-nav a.nav-link");

    // Loop melalui setiap tautan menu untuk menandai halaman aktif
    for (var i = 0; i < menuLinks.length; i++) {
      var menuLink = menuLinks[i];

      // Normalisasi URL untuk memastikan kecocokan yang akurat
      var normalizedMenuURL = menuLink.href.split("?")[0]; // Hilangkan parameter query
      if (currentURL === normalizedMenuURL) {
        menuLink.classList.add("active");
        break;
      }
    }
  </script>

</body>

</html>