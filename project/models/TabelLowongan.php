<?php
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/KontrakModelLowongan.php';
require_once __DIR__ . '/Lowongan.php';

class TabelLowongan extends DB implements KontrakModelLowongan {

    public function __construct(
        string $host = "localhost",
        string $db_name = "mvp_kandidat_db",
        string $username = "root",
        string $password = ""
    ) {
        parent::__construct($host, $db_name, $username, $password);
    }

    private function mapRowToLowongan(array $row): Lowongan {
        return new Lowongan(
            (int)$row['id'],
            $row['judul'],
            $row['departemen'],
            $row['lokasi'],
            (int)$row['gaji'],
            (int)$row['kuota']
        );
    }

    public function getAllLowongan(): array {
        $this->executeQuery("SELECT * FROM lowongan_kerja ORDER BY id ASC");
        $rows = $this->getAllResult();

        $list = [];
        foreach ($rows as $row) {
            $list[] = $this->mapRowToLowongan($row);
        }
        return $list;
    }

    public function getLowonganById(int $id): ?Lowongan {
        $this->executeQuery("SELECT * FROM lowongan_kerja WHERE id = :id LIMIT 1", [':id' => $id]);
        $rows = $this->getAllResult();
        if (empty($rows)) {
            return null;
        }
        return $this->mapRowToLowongan($rows[0]);
    }

    public function addLowongan(string $judul, string $departemen, string $lokasi, int $gaji, int $kuota): void {
        $query = "INSERT INTO lowongan_kerja (judul, departemen, lokasi, gaji, kuota)
                  VALUES (:judul, :departemen, :lokasi, :gaji, :kuota)";
        $this->executeQuery($query, [
            ':judul' => $judul,
            ':departemen' => $departemen,
            ':lokasi' => $lokasi,
            ':gaji' => $gaji,
            ':kuota' => $kuota,
        ]);
    }

    public function updateLowongan(int $id, string $judul, string $departemen, string $lokasi, int $gaji, int $kuota): void {
        $query = "UPDATE lowongan_kerja SET judul = :judul, departemen = :departemen, lokasi = :lokasi,
                  gaji = :gaji, kuota = :kuota WHERE id = :id";
        $this->executeQuery($query, [
            ':judul' => $judul,
            ':departemen' => $departemen,
            ':lokasi' => $lokasi,
            ':gaji' => $gaji,
            ':kuota' => $kuota,
            ':id' => $id,
        ]);
    }

    public function deleteLowongan(int $id): void {
        $this->executeQuery("DELETE FROM lowongan_kerja WHERE id = :id", [':id' => $id]);
    }
}
?>
