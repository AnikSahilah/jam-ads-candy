<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\ProfilModel;
use App\Models\SliderModel;
use App\Models\ProdukModel;
use App\Models\AktivitasModel;
use App\Models\ArtikelModel;
use App\Models\Metadatamodels; // Import model metadata

class Contactctrl extends BaseController
{
    private $ProfilModel;
    private $SliderModel;
    private $ProdukModel;
    private $AktivitasModel;
    private $ArtikelModel;
    private $MetadataModel; // Tambahkan variabel untuk model metadata

    public function __construct()
    {
        $this->ProfilModel = new ProfilModel();
        $this->SliderModel = new SliderModel();
        $this->ProdukModel = new ProdukModel();
        $this->AktivitasModel = new AktivitasModel();
        $this->ArtikelModel = new ArtikelModel();
        $this->MetadataModel = new Metadatamodels(); // Inisialisasi model metadata
    }

    public function index()
    {
        // Ambil data dari model lain
        $data = [
            'profil' => $this->ProfilModel->findAll(),
            'tbslider' => $this->SliderModel->findAll(),
            'tbproduk' => $this->ProdukModel->findAll(),
            'tbaktivitas' => $this->AktivitasModel->findAll(),
            'artikelterbaru' => $this->ArtikelModel->getArtikelTerbaru(),
        ];

        // Ambil data metadata
        $metaData = $this->MetadataModel->getMetaData(); // Mengambil data metadata untuk halaman kontak

        // Set judul dan meta deskripsi
        $data['Title'] = $metaData['meta_title'] ?? 'Kontak - Default Title'; // Menggunakan judul dari metadata
        $data['Meta'] = $metaData['meta_description'] ?? 'Kontak - Default Description'; // Menggunakan deskripsi dari metadata

        helper('text');

        // Deskripsi perusahaan sesuai bahasa
        if (session('lang') === 'in') {
            $nama_perusahaan = $data['profil'][0]->nama_perusahaan;
            $deskripsi_perusahaan = strip_tags($data['profil'][0]->deskripsi_perusahaan_in);
            $teks = "Kontak dari $nama_perusahaan. $deskripsi_perusahaan";
        } else {
            $nama_perusahaan = $data['profil'][0]->nama_perusahaan;
            $deskripsi_perusahaan = strip_tags($data['profil'][0]->deskripsi_perusahaan_en);
            $teks = "Contact of $nama_perusahaan. $deskripsi_perusahaan";
        }

        // Batasi deskripsi untuk SEO
        $batasan = 150;
        $data['Meta'] = character_limiter($teks, $batasan);

        return view('user/contact/index', $data);
    }
}
