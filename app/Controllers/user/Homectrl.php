<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\ProfilModel;
use App\Models\SliderModel;
use App\Models\ProdukModel;
use App\Models\AktivitasModel;
use App\Models\ArtikelModel;
use App\Models\Metadatamodels; // Import model metadata

class Homectrl extends BaseController
{
    private $ProfilModel;
    private $SliderModel;
    private $ProdukModel;
    private $AktivitasModel;
    private $ArtikelModel;
    private $MetadataModel;

    public function __construct()
    {
        $this->ProfilModel = new ProfilModel();
        $this->SliderModel = new SliderModel();
        $this->ProdukModel = new ProdukModel();
        $this->AktivitasModel = new AktivitasModel();
        $this->ArtikelModel = new ArtikelModel();
        $this->MetadataModel = new Metadatamodels(); // Inisialisasi model metadata

        // Load text helper
        helper('text');
    }

    public function index()
    {
        $lang = session()->get('lang') ?? 'en';
        // Ambil data dari model lain
        $data = [
            'profil' => $this->ProfilModel->findAll(),
            'tbslider' => $this->SliderModel->findAll(),
            'tbproduk' => $this->ProdukModel->findAll(),
            'tbaktivitas' => $this->AktivitasModel->findAll(),
            'artikelterbaru' => $this->ArtikelModel->getArtikelTerbaru(),
            'lang' => $lang
        ];

        // Ambil data metadata
        $metaData = $this->MetadataModel->where('feature', 'home')->first(); // Mengambil data metadata

        $data['metadata'] = $metaData;

        // Set judul dan meta deskripsi dari database atau default
        // $data['Title'] = $metaData['meta_title'] ?? 'Default Title';
        // $data['Meta'] = $metaData['meta_description'] ?? 'Default Description';

        // Batasi deskripsi perusahaan sesuai bahasa yang dipilih
        if (session('lang') === 'in') {
            $teks = strip_tags($data['profil'][0]->deskripsi_perusahaan_in ?? '');
        } else {
            $teks = strip_tags($data['profil'][0]->deskripsi_perusahaan_en ?? '');
        }

        // Batasi jumlah karakter untuk meta description
        $batasan = 150;
        if (!empty($teks)) {
            $data['Meta'] = character_limiter($teks, $batasan);
        }

        return view('user/home/index', $data);
    }

    public function redirectToHome()
    {
        return redirect()->to('user/home');
    }

    public function language($locale)
    {
        $session = session();

        // Validasi bahasa yang diterima
        if ($locale === 'in' || $locale === 'en') {
            // Mengatur sesi bahasa ke bahasa yang dipilih
            $session->set('lang', $locale);
        }

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }
}
