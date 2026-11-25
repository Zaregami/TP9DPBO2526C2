<?php
interface KontrakModelLowongan {
    /** @return Lowongan[] */
    public function getAllLowongan(): array;
    public function getLowonganById(int $id): ?Lowongan;
    public function addLowongan(string $judul, string $departemen, string $lokasi, int $gaji, int $kuota): void;
    public function updateLowongan(int $id, string $judul, string $departemen, string $lokasi, int $gaji, int $kuota): void;
    public function deleteLowongan(int $id): void;
}
?>
