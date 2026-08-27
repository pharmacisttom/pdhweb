<?php

$forms = [
    'app/Views/admin/departments/edit.php' => '<?= URLROOT ?>/admin/department/update/<?= $department->id ?>',
    'app/Views/admin/pages/edit.php' => '<?= URLROOT ?>/admin/page/update/<?= $page->id ?>',
    'app/Views/admin/doctors/edit.php' => '<?= URLROOT ?>/admin/doctor/update/<?= $doctor->id ?>',
    'app/Views/admin/services/edit.php' => '<?= URLROOT ?>/admin/service/update/<?= $service->id ?>',
    'app/Views/admin/clinics/edit.php' => '<?= URLROOT ?>/admin/clinic/update/<?= $clinic->id ?>',
    'app/Views/admin/banners/create.php' => '<?= URLROOT ?>/admin/banner/create',
    'app/Views/admin/donations/items/create.php' => '<?= URLROOT ?>/admin/donationitem/create',
    'app/Views/admin/news/create.php' => '<?= URLROOT ?>/admin/news/create',
    'app/Views/admin/appointments/index.php' => '<?= URLROOT ?>/admin/appointment/updateStatus/<?= $appt->id ?>',
    'app/Views/queue/room.php' => '<?= URLROOT ?>/queue/action',
];

foreach ($forms as $path => $expected) {
    $view = file_get_contents(__DIR__ . '/../' . $path);
    if ($view === false || strpos($view, $expected) === false) {
        fwrite(STDERR, "[FAIL] {$path} must post to a registered backend route.\n");
        exit(1);
    }
}

echo "[PASS] Backend forms post to registered routes.\n";
