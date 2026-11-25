<?php
require_once __DIR__ . '/models/TabelKandidat.php';
require_once __DIR__ . '/views/ViewKandidat.php';
require_once __DIR__ . '/presenters/PresenterKandidat.php';
require_once __DIR__ . '/models/TabelLowongan.php';
require_once __DIR__ . '/views/ViewLowongan.php';
require_once __DIR__ . '/presenters/PresenterLowongan.php';

$page = $_GET['page'] ?? 'kandidat';
$screen = $_GET['screen'] ?? 'list';

if ($page === 'lowongan') {
    $presenter = new PresenterLowongan(new TabelLowongan('localhost', 'mvp_kandidat_db', 'root', ''), new ViewLowongan());

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        if ($action === 'tambah') {
            $presenter->tambahLowongan(trim($_POST['judul']), trim($_POST['departemen']), trim($_POST['lokasi']), (int)$_POST['gaji'], (int)$_POST['kuota']);
        } elseif ($action === 'ubah') {
            $presenter->ubahLowongan((int)$_POST['id'], trim($_POST['judul']), trim($_POST['departemen']), trim($_POST['lokasi']), (int)$_POST['gaji'], (int)$_POST['kuota']);
        } elseif ($action === 'hapus') {
            $presenter->hapusLowongan((int)$_POST['id']);
        }
        header("Location: index.php?page=lowongan");
        exit();
    } else {
        if ($screen === 'add') {
            echo $presenter->tampilkanFormLowongan();
        } elseif ($screen === 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormLowongan((int)$_GET['id']);
        } else {
            echo $presenter->tampilkanLowongan();
        }
    }
} else {
    $model = new TabelKandidat('localhost', 'mvp_kandidat_db', 'root', '');
    $view = new ViewKandidat();
    $presenter = new PresenterKandidat($model, $view);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        if ($action === 'tambah') {
            $presenter->tambahKandidat(trim($_POST['nama']), trim($_POST['posisi']), trim($_POST['domisili']), (int)$_POST['skorTes'], (int)$_POST['pengalamanTahun']);
        } elseif ($action === 'ubah') {
            $presenter->ubahKandidat((int)$_POST['id'], trim($_POST['nama']), trim($_POST['posisi']), trim($_POST['domisili']), (int)$_POST['skorTes'], (int)$_POST['pengalamanTahun']);
        } elseif ($action === 'hapus') {
            $presenter->hapusKandidat((int)$_POST['id']);
        }
        header("Location: index.php");
        exit();
    } else {
        if ($screen === 'add') {
            echo $presenter->tampilkanFormKandidat();
        } elseif ($screen === 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormKandidat((int)$_GET['id']);
        } else {
            echo $presenter->tampilkanKandidat();
        }
    }
}
?>
