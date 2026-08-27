<?php

$migration = file_get_contents(__DIR__ . '/../database/migrations/006_create_documents.sql');
$controller = file_get_contents(__DIR__ . '/../app/Controllers/Admin/DocumentController.php');

if ($migration === false || strpos($migration, 'CREATE TABLE IF NOT EXISTS documents') === false) {
    fwrite(STDERR, "[FAIL] Documents migration is missing.\n");
    exit(1);
}

if ($controller === false || strpos($controller, "'application/pdf'") === false || strpos($controller, '20 * 1024 * 1024') === false) {
    fwrite(STDERR, "[FAIL] Document upload must validate PDF MIME type and size.\n");
    exit(1);
}

echo "[PASS] Document module migration and PDF upload validation are present.\n";
