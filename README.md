# TP9 DPBO 2025/2026 - Model-View-Presenter (MVP)

## Janji
Saya Reza Putra Wardani dengan NIM 2507880 mengerjakan TP 9 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## 1. Desain Program
Aplikasi rekrutmen sederhana dengan dua modul, memakai arsitektur **MVP (Strict Passive View)**:

| Modul | Tabel | Keterangan |
|---|---|---|
| Kandidat | `kandidat` | modul dari starter (nama, posisi, domisili, skorTes, pengalamanTahun) |
| Lowongan (baru) | `lowongan_kerja` | judul, departemen, lokasi, gaji, kuota |

Kedua tabel tidak memiliki relasi (opsional pada soal).

```
project/
├── index.php                  -> routing (?page=kandidat|lowongan, ?screen=add|edit) + blok POST
├── models/
│   ├── DB.php                 -> koneksi PDO, executeQuery, getAllResult
│   ├── Kandidat.php, Lowongan.php                    -> entity
│   ├── KontrakModel.php, KontrakModelLowongan.php    -> interface model
│   └── TabelKandidat.php, TabelLowongan.php          -> query (prepared statement)
├── presenters/
│   ├── KontrakPresenter.php, KontrakPresenterLowongan.php
│   └── PresenterKandidat.php, PresenterLowongan.php
├── views/
│   ├── KontrakView.php        -> dipakai kedua view
│   └── ViewKandidat.php, ViewLowongan.php
└── template/                  -> skin.html, form.html, skin_lowongan.html, form_lowongan.html
```

## 2. Alur Program
1. Browser membuka `index.php` (kandidat) atau `index.php?page=lowongan`.
2. `index.php` membuat Model, View, dan Presenter, lalu memberikan Model dan View ke Presenter lewat constructor (bertipe interface/kontrak).
3. **Read**: Presenter memanggil Model (`getAll...`), menghitung total, merakit baris `<tr>` (`buildRowHtml`), lalu memanggil `View->renderDaftar($rowsHtml, $total)`. View hanya membaca template dan mengganti `{{TABLE_ROWS}}` dan `{{TOTAL_DATA}}`.
4. **Create/Update**: tombol membuka `?screen=add` atau `?screen=edit&id=` (Update sehingga form terisi dari Model lewat Presenter). Form mengirim POST dengan `action` = `tambah` / `ubah`, `index.php` memanggil Presenter, Presenter memanggil Model, lalu redirect ke daftar (redirect dilakukan di Presenter).
5. **Delete**: tombol Hapus mengirim POST `action=hapus` dengan konfirmasi.

Prinsip Passive View: folder `views/` tidak memakai `require` Model/Entity, `foreach`, maupun `count()`. Semua query memakai prepared statement.

## 3. Dokumentasi
[Demo](https://drive.google.com/file/d/1HFWO8gQn0JqaUHyah_RExhgSQihh9n1g/view?usp=sharing)
