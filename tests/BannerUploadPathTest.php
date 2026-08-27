<?php

$controller = file_get_contents(__DIR__ . '/../app/Controllers/Admin/BannerController.php');
$expected = "APPROOT . '/public/assets/images/banners/'";

if ($controller === false || strpos($controller, $expected) === false || strpos($controller, "../public/assets/images/banners/") !== false) {
    fwrite(STDERR, "[FAIL] Banner uploads must use the application's absolute public path.\n");
    exit(1);
}

echo "[PASS] Banner uploads use the application's absolute public path.\n";
