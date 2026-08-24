<?php

/** @var \App\Core\Router $router */

// ============================================================================
// PUBLIC FRONTEND ROUTES
// ============================================================================
$router->get('/', 'HomeController@index');

// Public News
$router->get('/news', 'NewsController@index');
$router->get('/news/{slug}', 'NewsController@show');

// Public ITA / MOIT
$router->get('/ita', 'ItaController@index');

// Public Contact Us & Directions
$router->get('/contact', 'ContactController@index');

// Public Risk Management System (HRMS / Thai-NRLS)
$router->get('/risk', 'RiskController@index');
$router->get('/hrms', 'RiskController@index');

// Public Donations (แคมเปญการให้ไม่มีสิ้นสุด)
$router->get('/donation', 'DonationController@index');
$router->get('/donations', 'DonationController@index');
$router->get('/donation/show/{id}', 'DonationController@show');
$router->post('/donation/store', 'DonationController@store');

// Public Medical Services & Doctors
$router->get('/doctors', 'DoctorController@index');
$router->get('/doctor', 'DoctorController@index');
$router->get('/clinics', 'ClinicController@index');
$router->get('/clinic', 'ClinicController@index');
$router->get('/services', 'ServiceController@index');
$router->get('/service', 'ServiceController@index');
$router->get('/department', 'DepartmentController@index');
$router->get('/departments', 'DepartmentController@index');

// Public Procurements
$router->get('/procurement', 'ProcurementController@index');
$router->get('/procurements', 'ProcurementController@index');

// Public Complaints
$router->get('/complaint', 'ComplaintController@index');
$router->get('/complaints', 'ComplaintController@index');
$router->post('/complaint/store', 'ComplaintController@store');

// Public Appointments & Queue
$router->get('/appointment', 'AppointmentController@index');
$router->get('/appointments', 'AppointmentController@index');
$router->post('/appointment/store', 'AppointmentController@store');
$router->get('/queue', 'QueueController@index');
$router->get('/queue/kiosk', 'QueueController@kiosk');
$router->get('/queue/display/{id}', 'QueueController@display');


// ============================================================================
// ADMIN AUTHENTICATION & DASHBOARD
// ============================================================================
$router->get('/admin/login', 'Admin\AuthController@loginForm');
$router->post('/admin/login', 'Admin\AuthController@login');
$router->get('/admin/logout', 'Admin\AuthController@logout');
$router->get('/auth/logout', 'Admin\AuthController@logout');

$router->get('/admin', 'Admin\DashboardController@index');
$router->get('/admin/dashboard', 'Admin\DashboardController@index');


// ============================================================================
// ADMIN CONTENT MANAGEMENT (CMS)
// ============================================================================

// 1. News & Articles
$router->get('/admin/news', 'Admin\NewsController@index');
$router->get('/admin/news/create', 'Admin\NewsController@create');
$router->post('/admin/news/create', 'Admin\NewsController@store');
$router->get('/admin/news/edit/{id}', 'Admin\NewsController@edit');
$router->post('/admin/news/update/{id}', 'Admin\NewsController@update');
$router->post('/admin/news/delete/{id}', 'Admin\NewsController@delete');

// 2. Banner Slider Management
$router->get('/admin/banner', 'Admin\BannerController@index');
$router->get('/admin/banners', 'Admin\BannerController@index');
$router->get('/admin/banner/create', 'Admin\BannerController@create');
$router->post('/admin/banner/create', 'Admin\BannerController@store');
$router->get('/admin/banner/edit/{id}', 'Admin\BannerController@edit');
$router->post('/admin/banner/update/{id}', 'Admin\BannerController@update');
$router->post('/admin/banner/delete/{id}', 'Admin\BannerController@delete');
$router->post('/admin/banner/toggle/{id}', 'Admin\BannerController@toggle');
$router->post('/admin/banner/move/{id}', 'Admin\BannerController@move');
$router->post('/admin/banner/updateSliderSettings', 'Admin\BannerController@updateSliderSettings');

// 3. Departments (กลุ่มงาน/ฝ่าย)
$router->get('/admin/department', 'Admin\DepartmentController@index');
$router->get('/admin/departments', 'Admin\DepartmentController@index');
$router->get('/admin/department/create', 'Admin\DepartmentController@create');
$router->post('/admin/department/create', 'Admin\DepartmentController@store');
$router->get('/admin/department/edit/{id}', 'Admin\DepartmentController@edit');
$router->post('/admin/department/update/{id}', 'Admin\DepartmentController@update');
$router->post('/admin/department/delete/{id}', 'Admin\DepartmentController@delete');

// 4. Services (บริการผู้ป่วย)
$router->get('/admin/service', 'Admin\ServiceController@index');
$router->get('/admin/services', 'Admin\ServiceController@index');
$router->get('/admin/service/create', 'Admin\ServiceController@create');
$router->post('/admin/service/create', 'Admin\ServiceController@store');
$router->get('/admin/service/edit/{id}', 'Admin\ServiceController@edit');
$router->post('/admin/service/update/{id}', 'Admin\ServiceController@update');
$router->post('/admin/service/delete/{id}', 'Admin\ServiceController@delete');

// 5. Clinics (คลินิกเฉพาะโรค)
$router->get('/admin/clinic', 'Admin\ClinicController@index');
$router->get('/admin/clinics', 'Admin\ClinicController@index');
$router->get('/admin/clinic/create', 'Admin\ClinicController@create');
$router->post('/admin/clinic/create', 'Admin\ClinicController@store');
$router->get('/admin/clinic/edit/{id}', 'Admin\ClinicController@edit');
$router->post('/admin/clinic/update/{id}', 'Admin\ClinicController@update');
$router->post('/admin/clinic/delete/{id}', 'Admin\ClinicController@delete');

// 6. Doctors (ทำเนียบแพทย์)
$router->get('/admin/doctor', 'Admin\DoctorController@index');
$router->get('/admin/doctors', 'Admin\DoctorController@index');
$router->get('/admin/doctor/create', 'Admin\DoctorController@create');
$router->post('/admin/doctor/create', 'Admin\DoctorController@store');
$router->get('/admin/doctor/edit/{id}', 'Admin\DoctorController@edit');
$router->post('/admin/doctor/update/{id}', 'Admin\DoctorController@update');
$router->post('/admin/doctor/delete/{id}', 'Admin\DoctorController@delete');

// 7. Donations (ระบบบริจาค)
$router->get('/admin/donationitem', 'Admin\DonationItemController@index');
$router->get('/admin/donationitems', 'Admin\DonationItemController@index');
$router->get('/admin/donationitem/create', 'Admin\DonationItemController@create');
$router->post('/admin/donationitem/create', 'Admin\DonationItemController@store');
$router->get('/admin/donationitem/edit/{id}', 'Admin\DonationItemController@edit');
$router->post('/admin/donationitem/update/{id}', 'Admin\DonationItemController@update');
$router->post('/admin/donationitem/delete/{id}', 'Admin\DonationItemController@delete');

$router->get('/admin/donation', 'Admin\DonationController@index');
$router->get('/admin/donations', 'Admin\DonationController@index');
$router->get('/admin/donation/show/{id}', 'Admin\DonationController@show');
$router->post('/admin/donation/updateStatus/{id}', 'Admin\DonationController@updateStatus');
$router->post('/admin/donation/delete/{id}', 'Admin\DonationController@delete');

// 8. Procurements (จัดซื้อจัดจ้าง)
$router->get('/admin/procurement', 'Admin\ProcurementController@index');
$router->get('/admin/procurements', 'Admin\ProcurementController@index');
$router->get('/admin/procurement/create', 'Admin\ProcurementController@create');
$router->post('/admin/procurement/create', 'Admin\ProcurementController@store');
$router->get('/admin/procurement/edit/{id}', 'Admin\ProcurementController@edit');
$router->post('/admin/procurement/update/{id}', 'Admin\ProcurementController@update');
$router->post('/admin/procurement/delete/{id}', 'Admin\ProcurementController@delete');

// 9. Complaints (เรื่องร้องเรียน)
$router->get('/admin/complaint', 'Admin\ComplaintController@index');
$router->get('/admin/complaints', 'Admin\ComplaintController@index');
$router->get('/admin/complaint/show/{id}', 'Admin\ComplaintController@show');
$router->post('/admin/complaint/updateStatus/{id}', 'Admin\ComplaintController@updateStatus');

// 10. Appointments & Quotas (คิวนัดหมาย)
$router->get('/admin/appointment', 'Admin\AppointmentController@index');
$router->get('/admin/appointments', 'Admin\AppointmentController@index');
$router->post('/admin/appointment/updateStatus/{id}', 'Admin\AppointmentController@updateStatus');
$router->post('/admin/appointment/delete/{id}', 'Admin\AppointmentController@delete');

// 11. Queues (ระบบเรียกคิว)
$router->get('/admin/queue', 'Admin\QueueController@index');
$router->get('/admin/queues', 'Admin\QueueController@index');

// 12. Static Pages (หน้าเพจองค์กร)
$router->get('/admin/page', 'Admin\PageController@index');
$router->get('/admin/pages', 'Admin\PageController@index');
$router->get('/admin/page/create', 'Admin\PageController@create');
$router->post('/admin/page/create', 'Admin\PageController@store');
$router->get('/admin/page/edit/{id}', 'Admin\PageController@edit');
$router->post('/admin/page/update/{id}', 'Admin\PageController@update');
$router->post('/admin/page/delete/{id}', 'Admin\PageController@delete');

// 13. System Settings (ตั้งค่าระบบ)
$router->get('/admin/settings', 'Admin\SettingsController@index');
$router->get('/admin/setting', 'Admin\SettingsController@index');
$router->post('/admin/settings/updateHospital', 'Admin\SettingsController@updateHospital');
$router->post('/admin/settings/updateSocial', 'Admin\SettingsController@updateSocial');
$router->post('/admin/settings/testLineNotify', 'Admin\SettingsController@testLineNotify');
$router->post('/admin/settings/updateCategories', 'Admin\SettingsController@updateCategories');

// 14. Audit Logs (ประวัติการใช้งาน)
$router->get('/admin/logs', 'Admin\AuditLogController@index');
$router->get('/admin/audit_logs', 'Admin\AuditLogController@index');
$router->post('/admin/logs/clear', 'Admin\AuditLogController@clear');
