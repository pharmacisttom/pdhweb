<?php

$view = file_get_contents(__DIR__ . '/../app/Views/admin/departments/edit.php');
$expected = '<?= URLROOT ?>/admin/department/update/<?= $department->id ?>';

if ($view === false || strpos($view, $expected) === false) {
    fwrite(STDERR, "[FAIL] Department edit form must post to the update route.\n");
    exit(1);
}

echo "[PASS] Department edit form posts to the update route.\n";
