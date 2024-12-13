<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<!-- Header Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header" style="background-image: url('asset-user/images/watch (1) (1).jpg'); background-size: cover;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown"><?php echo lang('Blog.titleAboutUs'); ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="<?= base_url('/') ?>"><?php echo lang('Blog.headerHome');  ?></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><?php echo lang('Blog.headerAbout');  ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
            <?php foreach ($profil as $descper) : ?>
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="position-relative h-100 d-flex justify-content-center">
                            <img style="object-fit: cover;" class="img-fluid lazyload" data-src="asset-user/images/<?= $descper->foto_utama; ?>" alt="<?= $descper->nama_perusahaan; ?>">
                        </div>
                    </div>
                    <div class="col-lg-7 wow fadeInUp">
                        <h6 class="section-title bg-white text-start text-primary pe-3"><?php echo lang('Blog.titleAboutUs')  ?></h6>
                        <h1 class="mb-4"><?= $descper->nama_perusahaan; ?></h1>
                        <p class="mb-4">
                            <?php if (lang('Blog.Languange') == 'en') {
                                echo $descper->deskripsi_perusahaan_en;
                            } elseif (lang('Blog.Languange') == 'in') {
                                echo $descper->deskripsi_perusahaan_in;
                            } ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
            <p><?php echo lang('Blog.noProfileFound'); ?></p>
    </div>
</div>
<!-- About End -->

<?= $this->endSection('content'); ?>
