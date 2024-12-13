<?= $this->extend('user/template/template') ?>
<?= $this->Section('content'); ?>

<div class="container-fluid bg-primary py-5 mb-5 page-header" style="background-image: url('asset-user/images/watch (1) (1).jpg'); background-size: cover;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                    <?php foreach ($profil as $perusahaan) : ?>
                        <h1 class="display-3 text-white animated slideInDown">
                            <?php echo lang('Blog.titleOurContact');
                            if (!empty($perusahaan)) {
                                echo ' ' . $perusahaan->nama_perusahaan;
                            } ?>
                        </h1>
                    <?php endforeach ?>
                    <h1 class="display-3 text-white animated slideInDown"><?php echo lang('Blog.titleOurContact'); ?></h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="<?= base_url('/') ?>"><?php echo lang('Blog.headerHome');  ?></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><?php echo lang('Blog.headerContact');  ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<div class="container py-3">
    <div class="row py-5">
        <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
            <div class="map-container">
                <?php if (isset($profil) && is_iterable($profil)) : ?>
                    <?php foreach ($profil as $maps) : ?>
                        <?php echo $maps->link_maps ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="row px-3">
                <div class="col-12 p-0">
                    <?php if (isset($profil) && is_iterable($profil)) : ?>
                        <?php foreach ($profil as $desc) : ?>
                            <blockquote>
                                <p>
                                    <?php if (lang('Blog.Languange') == 'en') {
                                        echo $desc->deskripsi_kontak_en;
                                    } elseif (lang('Blog.Languange') == 'in') {
                                        echo $desc->deskripsi_kontak_in;
                                    } ?>
                                </p>
                            </blockquote>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p><?php echo lang('Blog.noContactInfo'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
