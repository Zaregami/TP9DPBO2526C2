<?php
require_once __DIR__ . '/KontrakView.php';

class ViewLowongan implements KontrakView {
    private string $skinPath;
    private string $formPath;

    public function __construct(string $skinPath = '', string $formPath = '') {
        $this->skinPath = $skinPath ?: __DIR__ . '/../template/skin_lowongan.html';
        $this->formPath = $formPath ?: __DIR__ . '/../template/form_lowongan.html';
    }

    public function renderDaftar(string $tableRowsHtml, int $totalData): string {
        $template = file_get_contents($this->skinPath);

        $tokens = [
            '{{TABLE_ROWS}}' => $tableRowsHtml,
            '{{TOTAL_DATA}}' => (string)$totalData,
        ];

        return str_replace(array_keys($tokens), array_values($tokens), $template);
    }

    public function renderForm(string $title, string $action, array $formData = []): string {
        $template = file_get_contents($this->formPath);

        $tokens = [
            '{{FORM_TITLE}}' => htmlspecialchars($title),
            '{{ACTION}}'     => htmlspecialchars($action),
            '{{ID}}'         => htmlspecialchars((string)($formData['id'] ?? '')),
            '{{JUDUL}}'      => htmlspecialchars($formData['judul'] ?? ''),
            '{{DEPARTEMEN}}' => htmlspecialchars($formData['departemen'] ?? ''),
            '{{LOKASI}}'     => htmlspecialchars($formData['lokasi'] ?? ''),
            '{{GAJI}}'       => htmlspecialchars((string)($formData['gaji'] ?? 0)),
            '{{KUOTA}}'      => htmlspecialchars((string)($formData['kuota'] ?? 1)),
        ];

        return str_replace(array_keys($tokens), array_values($tokens), $template);
    }
}
?>
