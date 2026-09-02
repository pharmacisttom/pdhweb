<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Database.php';

$db = new \App\Core\Database();
$files = glob(__DIR__ . '/../database/migrations/*.sql');
sort($files);

foreach ($files as $file) {
    echo "Running migration: " . basename($file) . " ... ";
    $sql = file_get_contents($file);
    $queries = explode(';', $sql);
    $allOk = true;
    foreach ($queries as $q) {
        $q = trim($q);
        if (!empty($q)) {
            try {
                $db->query($q);
                $db->execute();
            } catch (\Throwable $e) {
                // Ignore if column/table already exists
                if (stripos($e->getMessage(), 'Duplicate') === false && stripos($e->getMessage(), 'already exists') === false) {
                    echo "Notice: " . $e->getMessage() . " ";
                }
            }
        }
    }
    echo "Done.\n";
}

echo "All migrations processed.\n";
