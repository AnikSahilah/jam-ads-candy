<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<div class="container-fluid bg-primary py-5 mb-5 page-header" style="background-image: url('asset-user/images/watch (1) (1).jpg'); background-size: cover;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php foreach ($profil as $perusahaan) : ?>
                    <h1 class="display-3 text-white animated slideInDown">
                        <?php echo lang('Blog.titleActivities');
                        if (!empty($perusahaan)) {
                            echo ' ' . $perusahaan->nama_perusahaan;
                        } ?>
                    </h1>
                <?php endforeach ?>
                <h1 class="display-3 text-white animated slideInDown"><?php echo lang('Blog.titleActivities'); ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="<?= base_url('/') ?>"><?php echo lang('Blog.headerHome'); ?></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><?php echo lang('Blog.headerActivities'); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Activities Start -->
<div class="container-xxl py-1 mb-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3">
                <?= lang('Blog.headerActivities'); ?>
            </h3>
        </div>
        <div class="row pt-5">
            <?php if (isset($tbaktivitas) && is_iterable($tbaktivitas)) : ?>
                <?php foreach ($tbaktivitas as $aktivitas) : ?>
                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 mb-2 h-100 d-flex flex-column">
                            <a href="<?= base_url(($lang === 'en' ? 'en/activities/' . esc($aktivitas->slug_en) : 'id/kegiatan/' . esc($aktivitas->slug_id))) ?>" class="img-link">
                                <img data-src="<?= base_url('asset-user/images/' . esc($aktivitas->foto_aktivitas)) ?>" alt="<?= $isIndonesian ? esc($aktivitas->slug_id) : esc($aktivitas->slug_en); ?>" class="card-img-top lazyload">
                            </a>
                            <div class="card-body bg-light p-4 d-flex flex-column flex-grow-1 text-center">
                                <b>
                                    <a style="font-size: 20px;" class="card-title flex-grow-1" href="<?= base_url(($lang === 'en' ? 'en/activities/' . esc($aktivitas->slug_en) : 'id/kegiatan/' . esc($aktivitas->slug_id))) ?>">
                                        <?= $isIndonesian ? esc($aktivitas->nama_aktivitas_in) : esc($aktivitas->nama_aktivitas_en); ?>
                                    </a>
                                </b>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <p><?php echo lang('Blog.noActivitiesFound'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Activities End -->

<?= $this->endSection('content'); ?>