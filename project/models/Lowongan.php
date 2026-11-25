<?php
class Lowongan {
    private ?int $id;
    private string $judul;
    private string $departemen;
    private string $lokasi;
    private int $gaji;
    private int $kuota;

    public function __construct(?int $id, string $judul, string $departemen, string $lokasi, int $gaji, int $kuota) {
        $this->id = $id;
        $this->judul = $judul;
        $this->departemen = $departemen;
        $this->lokasi = $lokasi;
        $this->gaji = $gaji;
        $this->kuota = $kuota;
    }

    public function getId(): ?int { return $this->id; }
    public function getJudul(): string { return $this->judul; }
    public function getDepartemen(): string { return $this->departemen; }
    public function getLokasi(): string { return $this->lokasi; }
    public function getGaji(): int { return $this->gaji; }
    public function getKuota(): int { return $this->kuota; }
}
?>
