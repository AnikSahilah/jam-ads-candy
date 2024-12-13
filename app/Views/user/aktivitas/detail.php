<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<div class="container-fluid bg-primary py-5 mb-5 page-header" style="background-image: url('<?= base_url('asset-user/images/watch (1) (1).jpg'); ?>'); background-size: cover;">    <div class="container py-5">
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
                        <li class="breadcrumb-item"><a class="text-white" href="<?= base_url('/') ?>"><?php echo lang('Blog.headerHome');  ?></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><?php echo lang('Blog.headerActivities');  ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<?php if (isset($profil) && is_iterable($profil)) : ?>
    <?php foreach ($profil as $descper) : ?>
        <div class="container py-3">
            <div class="row py-5">
                <div class="col-lg-5">
                    <div class="row px-3">
                        <div class="col-12 p-0">
                            <?php if (isset($tbaktivitas)) : ?>
                                <img class="img-fluid w-100 lazyload" data-src="/asset-user/images/<?= $tbaktivitas->foto_aktivitas ?>" alt="Image placeholder">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                    <h1 class="text-primary">
                        <b>
                            <?php if (isset($tbaktivitas)) : ?>
                                <?php if (lang('Blog.Languange') == 'en') {
                                    echo $tbaktivitas->nama_aktivitas_en;
                                } elseif (lang('Blog.Languange') == 'in') {
                                    echo $tbaktivitas->nama_aktivitas_in;
                                } ?>
                            <?php endif; ?>
                        </b>
                    </h1>
                    <p>
                        <?php if (isset($tbaktivitas)) : ?>
                            <?php if (lang('Blog.Languange') == 'en') {
                                echo $tbaktivitas->deskripsi_aktivitas_en;
                            } elseif (lang('Blog.Languange') == 'in') {
                                echo $tbaktivitas->deskripsi_aktivitas_in;
                            } ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php else : ?>
    <div class="container py-3">
        <div class="row py-5">
            <div class="col-12 text-center">
                <p><?php echo lang('Blog.noProfileFound'); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection('content'); ?>
