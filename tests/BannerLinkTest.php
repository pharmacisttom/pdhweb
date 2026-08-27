<?php

require_once __DIR__ . '/../config/config.php';

$cases = [
    'legacy localhost link' => [
        'http://localhost/pdhweb/services',
        rtrim(URLROOT, '/') . '/services',
    ],
    'legacy localhost link with query' => [
        'http://127.0.0.1/pdhweb/public/doctors?specialty=general',
        rtrim(URLROOT, '/') . '/doctors?specialty=general',
    ],
    'external HTTPS link' => [
        'https://example.org/campaign',
        'https://example.org/campaign',
    ],
    'unsafe protocol' => [
        'javascript:alert(1)',
        '',
    ],
];

foreach ($cases as $name => [$input, $expected]) {
    if (normalize_banner_link($input) !== $expected) {
        fwrite(STDERR, "[FAIL] {$name}\n");
        exit(1);
    }
}

echo "[PASS] Banner links are normalized safely.\n";
