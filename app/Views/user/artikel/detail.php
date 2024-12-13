<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<?php if (is_object($artikel)): ?>
    <?= $this->section('meta'); ?>
    <meta name="description" content="<?= esc($artikel->deskripsi_artikel); ?>"> <!-- Ringkasan Artikel -->
    <meta name="keywords" content="Artikel, <?= esc($artikel->judul_artikel); ?>"> <!-- Kata kunci dari artikel -->
    <meta name="author" content="Nama Penulis"> <!-- Ganti dengan nama penulis atau organisasi -->
    <title><?= esc($artikel->judul_artikel); ?> | Nama Website</title>
    <?= $this->endSection(); ?>
<?php endif; ?>

<style>
    .article-title {
        white-space: normal;
        word-wrap: break-word;
        overflow-wrap: break-word;
        width: 100%;
    }

    .article-item {
        display: flex;
        height: 110px;
        overflow: hidden;
    }

    .article-image {
        width: 110px;
        height: 110px;
        object-fit: cover;
    }

    .article-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex: 1;
        padding: 0 1rem;
        white-space: normal;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="container-fluid bg-primary py-5 mb-5 page-header" style="background-image: url('<?= base_url('asset-user/images/watch (1) (1).jpg'); ?>'); background-size: cover;">
    <div class="container text-center py-5">
        <?php if (is_array($profil)) : ?>
            <?php foreach ($profil as $perusahaan) : ?>
                <h3 class="display-2 text-white mb-4 animated slideInDown">
                    <?php echo lang('Blog.titleOurarticle');
                    if (!empty($perusahaan)) {
                        echo ' ' . $perusahaan->nama_perusahaan;
                    } ?>
                </h3>
            <?php endforeach; ?>
        <?php endif; ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0 animated slideInDown">
                <p class="text-white text-center">
                    <a href="<?= base_url('/') ?>"> <?php echo lang('Blog.headerHome'); ?></a>
                    <span class="mx-2">/</span>
                    <span><?php echo lang('Blog.headerArticle');  ?></span>
                </p>
            </ol>
        </nav>
    </div>
</div>

<!-- News Detail Start -->
<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="position-relative mb-3">
                    <?php if (is_object($artikel)) : ?>
                        <img class="img-fluid w-100" src="<?= base_url('asset-user/images/' . $artikel->foto_artikel); ?>" style="object-fit: cover;">
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                <a class="text-uppercase mb-3 text-body"><?= date('d F Y', strtotime($artikel->created_at)); ?></a>
                            </div>
                            <h1 class="display-5 mb-2 article-title">
                                <?= lang('Blog.Languange') == 'en' ? $artikel->slug_en : $artikel->slug_id; ?>
                            </h1>
                            <p class="fs-5">
                                <?= lang('Blog.Languange') == 'en' ? $artikel->slug_en : $artikel->slug_id; ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- News Detail End -->
            </div>

            <div class="col-lg-4">
                <!-- Popular News Start -->
                <div class="mb-3">
                    <h5 class="mb-2 px-3 py-1 text-dark rounded-pill d-inline-block border border-2 border-primary">Baca Juga</h5>
                </div>
                <br>
                <div class="bg-white border border-top-0 p-3">
                    <?php if (is_array($artikel_lain)) : ?>
                        <?php foreach ($artikel_lain as $artikel_item) : ?>
                            <div class="d-flex align-items-center bg-white mb-3 article-item">
                                <?php if (is_object($artikel_item)) : ?>
                                    <img class="img-fluid article-image" src="<?= base_url('asset-user/images/' . $artikel_item->foto_artikel); ?>" alt="">
                                    <div class="w-100 h-100 d-flex flex-column justify-content-center border border-left-0 article-content">
                                        <div class="mb-2">
                                            <a class="text-body" href="<?= base_url('/artikel/detail/' . $artikel_item->id_artikel) ?>"><small><?= date('d F Y', strtotime($artikel_item->created_at)); ?></small></a>
                                        </div>
                                        <a class="h6 m-0 display-7" href="<?= base_url('/artikel/detail/' . $artikel_item->id_artikel) ?>">
                                            <?= lang('Blog.Languange') == 'en' ? $artikel_item->judul_inggris : $artikel_item->judul_artikel; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <!-- Popular News End -->
            </div>
        </div>
    </div>
</div>
<!-- News Detail End -->

<?= $this->endSection('content'); ?>