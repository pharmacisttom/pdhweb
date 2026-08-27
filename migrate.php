<?php

require_once __DIR__ . '/config/config.php';

$migrationPath = __DIR__ . '/database/migrations';
$files = glob($migrationPath . '/*.sql') ?: [];
sort($files, SORT_NATURAL);

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $pdo->exec('CREATE TABLE IF NOT EXISTS schema_migrations (filename VARCHAR(255) NOT NULL PRIMARY KEY, applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $applied = $pdo->query('SELECT filename FROM schema_migrations')->fetchAll(PDO::FETCH_COLUMN);

    foreach ($files as $file) {
        $filename = basename($file);
        if (in_array($filename, $applied, true)) {
            echo "SKIP {$filename}\n";
            continue;
        }

        $sql = file_get_contents($file);
        if (preg_match('/\b(DROP|TRUNCATE)\b/i', $sql)) {
            throw new RuntimeException("Refusing destructive migration: {$filename}");
        }

        $pdo->exec($sql);
        $statement = $pdo->prepare('INSERT INTO schema_migrations (filename) VALUES (:filename)');
        $statement->execute([':filename' => $filename]);
        echo "APPLIED {$filename}\n";
    }
} catch (Throwable $exception) {
    fwrite(STDERR, 'Migration failed: ' . $exception->getMessage() . PHP_EOL);
    exit(1);
}
