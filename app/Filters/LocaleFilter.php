<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LocaleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil session
        $session = session();

        // Ambil locale dari segmen pertama URL
        $locale = $request->getUri()->getSegment(1); // Ambil segmen pertama dari URL (misalnya 'en' atau 'in')

        // Cek apakah locale valid (misal, 'en' atau 'in')
        if ($locale && in_array($locale, ['en', 'in'])) {
            // Simpan locale ke session
            $session->set('lang', $locale);
        } else {
            // Atur locale default ke 'in' jika tidak ada di URL
            $session->set('lang', 'in');
        }

        // Set locale yang aktif
        service('request')->setLocale($session->get('lang'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi yang perlu dilakukan setelah request
    }
}
