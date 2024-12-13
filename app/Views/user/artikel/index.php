<?= $this->extend('user/template/template') ?>
<?= $this->section('content'); ?>

<div class="container-fluid bg-primary py-5 mb-5 page-header" style="background-image: url('<?= base_url('asset-user/images/watch (1) (1).jpg') ?>'); background-size: cover;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <?php foreach ($profil as $perusahaan) : ?>
                    <h1 class="display-3 text-white animated slideInDown">
                        <?= lang('Blog.titleOurarticle') . ' ' . esc($perusahaan->nama_perusahaan ?? '') ?>
                    </h1>
                <?php endforeach ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="<?= base_url('/') ?>"><?= lang('Blog.headerHome'); ?></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page"><?= lang('Blog.headerArticle'); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Latest Articles Start -->
<div class="container-xxl py-1 mb-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title bg-white text-center text-primary px-3">
                <?= lang('Blog.headerArticle'); ?>
            </h3>
        </div>
        <div class="row pt-5">
            <?php foreach ($artikelterbaru as $row) : ?>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 mb-2 h-100 d-flex flex-column">
                        <a href="<?= base_url(($lang === 'en' ? 'en/article/' . esc($row->slug_en) : 'id/artikel/' . esc($row->slug_id))) ?>" class="img-link">
                            <img data-src="<?= base_url('asset-user/images/' . esc($row->foto_artikel)) ?>" alt="<?= esc($row->judul) ?>" class="card-img-top lazyload" style="object-fit: cover; border-radius: 10px;">
                        </a>
                        <div class="card-body bg-light p-4 d-flex flex-column flex-grow-1">
                            <b>
                                <a style="font-size: 20px;" class="card-title flex-grow-1" href="<?= base_url(($lang === 'en' ? 'en/article/' . esc($row->slug_en) : 'id/artikel/' . esc($row->slug_id))) ?>">
                                    <?= esc($row->judul) ?>
                                </a>
                            </b>
                            <div class="mb-2">
                                <a class="text-uppercase mb-3 text-body"><?= date('d F Y', strtotime($row->created_at)); ?></a>
                            </div>
                            <p><?= esc(substr(strip_tags($row->deskripsi), 0, 100)) ?>...</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Latest Articles End -->

<?= $this->endSection(); ?>