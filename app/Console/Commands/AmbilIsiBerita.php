<?php

namespace App\Console\Commands;

use DOMDocument;
use DOMXPath;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AmbilIsiBerita extends Command
{
    protected $signature = 'berita:ambil-isi';

    protected $description = 'Unduh isi artikel (div.article-body) dua berita dari jalatrang.id ke database/seeders/data';

    // nama file tujuan => alamat berita di website
    private array $sumber = [
        'berita-1.html' => 'https://jalatrang.id/berita/malam-penuh-gengsi-dimulai-16-tim-berebut-mahkota-juara-di-ajang-cvc-cup-2026-desa-jalatrang',
        'berita-2.html' => 'https://jalatrang.id/berita/pemerintah-desa-jalatrang-kukuhkan-desa-siaga-tb-perkuat-kolaborasi-lintas-sektor-basmi-tuberkulosis',
    ];

    public function handle(): int
    {
        $folder = database_path('seeders/data');
        if (! is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        foreach ($this->sumber as $file => $url) {
            $this->info("Mengambil: {$url}");

            // withoutVerifying: menghindari error SSL "cURL error 60" yang umum di Laragon/Windows
            $res = Http::withoutVerifying()
                ->withHeaders(['User-Agent' => 'Mozilla/5.0'])
                ->timeout(30)
                ->get($url);

            if (! $res->successful()) {
                $this->error("Gagal mengunduh (HTTP {$res->status()}).");
                return self::FAILURE;
            }

            $isi = $this->ambilArtikel($res->body());
            if ($isi === null || $isi === '') {
                $this->error('Bagian article-body tidak ditemukan di halaman.');
                return self::FAILURE;
            }

            file_put_contents("{$folder}/{$file}", $isi);
            $this->info("Tersimpan: database/seeders/data/{$file} (" . strlen($isi) . ' byte)');
        }

        $this->newLine();
        $this->info('Selesai. Sekarang jalankan: php artisan migrate:fresh --seed --seeder=BeritaSeeder');

        return self::SUCCESS;
    }

    private function ambilArtikel(string $halaman): ?string
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML('<?xml encoding="UTF-8">' . $halaman);

        $xpath = new DOMXPath($dom);
        $node  = $xpath->query("//div[contains(concat(' ', normalize-space(@class), ' '), ' article-body ')]")->item(0);

        if (! $node) {
            return null;
        }

        $hasil = '';
        foreach ($node->childNodes as $anak) {
            $hasil .= $dom->saveHTML($anak);
        }

        return trim($hasil);
    }
}
