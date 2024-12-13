<?php

namespace App\Controllers\user;

use App\Controllers\user\BaseController;
use App\Models\ProfilModel;
use App\Models\SliderModel;
use App\Models\ArtikelModel;

class Artikelctrl extends BaseController
{
    private $ProfilModel;
    private $SliderModel;
    private $ArtikelModel;

    public function __construct()
    {
        $this->ProfilModel = new ProfilModel();
        $this->SliderModel = new SliderModel();
        $this->ArtikelModel = new ArtikelModel();

        helper(['text', 'url']);
    }

    public function index()
    {
        $lang = session()->get('lang') ?? 'en';
        // Ambil data profil, slider, dan artikel terbaru
        $profil = $this->ProfilModel->findAll();
        $slider = $this->SliderModel->findAll();
        $artikelTerbaru = $this->ArtikelModel->getArtikelTerbaru();

        // Jika profil tidak ditemukan, tangani kesalahan
        if (empty($profil)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data profil tidak ditemukan.');
        }

        // Tentukan bahasa yang aktif dari session atau locale
        $locale = session('lang') ?? service('request')->getLocale();

        // Tentukan judul halaman berdasarkan bahasa
        $title = ($locale === 'en') ? 'Articles' : 'Artikel';

        // Sesuaikan artikel terbaru dengan bahasa yang aktif
        foreach ($artikelTerbaru as $key => $artikel) {
            if ($locale === 'en') {
                $artikelTerbaru[$key]->judul = $artikel->judul_inggris ?? $artikel->judul_artikel;
                $artikelTerbaru[$key]->deskripsi = $artikel->description_inggris ?? $artikel->deskripsi_artikel;
            } else {
                $artikelTerbaru[$key]->judul = $artikel->judul_artikel;
                $artikelTerbaru[$key]->deskripsi = $artikel->deskripsi_artikel;
            }
        }

        $data = [
            'profil' => $profil,
            'tbslider' => $slider,
            'artikelterbaru' => $artikelTerbaru,
            'Title' => $title,
            'lang' => $lang
        ];

        // Set meta description berdasarkan bahasa yang aktif
        $metaDescription = $this->generateMetaDescription($data, $locale);
        $data['Meta'] = character_limiter($metaDescription, 150);

        return view('user/artikel/index', $data);
    }

    public function detail($slug)
    {
        // Tentukan bahasa yang aktif dari session atau locale
        $locale = session('lang') ?? service('request')->getLocale();

        // Tentukan field slug berdasarkan bahasa yang aktif
        if ($locale == 'en') {
            $artikel = $this->ArtikelModel->where('slug_en', $slug)->first();
        } else {
            $artikel = $this->ArtikelModel->where('slug_id', $slug)->first();
        }

        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel dengan slug $slug tidak ditemukan");
        }

        // Tentukan judul halaman berdasarkan bahasa
        $title = ($locale === 'en') ? 'Articles' : 'Artikel';

        // Tentukan field judul dan deskripsi berdasarkan bahasa yang aktif
        if ($locale == 'en') {
            $judul_artikel = $artikel->judul_inggris ?? $artikel->judul_artikel; // Fallback ke judul default jika tidak ada
            $deskripsi_artikel = $artikel->description_inggris ?? $artikel->deskripsi_artikel;
        } else {
            $judul_artikel = $artikel->judul_artikel ?? $artikel->judul_artikel;
            $deskripsi_artikel = $artikel->deskripsi_artikel ?? $artikel->deskripsi_artikel;
        }

        $data = [
            'profil' => $this->ProfilModel->findAll(),
            'artikel' => $artikel,
            'artikel_lain' => $this->ArtikelModel->getArtikelLainnya($artikel->id_artikel, 4),
            'judul_artikel' => $judul_artikel,
            'deskripsi_artikel' => $deskripsi_artikel,
            'lang' => $locale
        ];

        helper('text');

        // Set meta description
        $metaDescription = $this->generateMetaDescription($data, $locale);
        $data['Meta'] = character_limiter($metaDescription, 150);

        // Tentukan judul halaman berdasarkan bahasa
        $data['Title'] = $judul_artikel ?? 'Detail Artikel';

        return view('user/artikel/detail', $data);
    }

    private function generateMetaDescription($data, $locale)
    {
        // Periksa apakah data profil tersedia
        if (empty($data['profil']) || !isset($data['profil'][0])) {
            return $locale === 'in' ? "Profil tidak tersedia" : "Profile not available";
        }

        $nama_perusahaan = $data['profil'][0]->nama_perusahaan ?? 'Perusahaan Tidak Diketahui';
        $deskripsi_perusahaan = $locale === 'in'
            ? strip_tags($data['profil'][0]->deskripsi_perusahaan_in ?? 'Deskripsi tidak tersedia')
            : strip_tags($data['profil'][0]->deskripsi_perusahaan_en ?? 'Description not available');

        return $locale === 'in'
            ? "Artikel dari $nama_perusahaan. $deskripsi_perusahaan"
            : "Articles from $nama_perusahaan. $deskripsi_perusahaan";
    }
}
