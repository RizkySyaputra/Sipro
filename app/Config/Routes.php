<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/test', 'Master::test');
// $routes->get('/', 'Master::index');
$routes->get('/tabel', 'Master::tabel', ['filter' => 'permission']);
$routes->get('/nomenklatur', 'Master::nomenklatur', ['filter' => 'permission']);
$routes->get('/program', 'Master::program', ['filter' => 'permission']);
$routes->get('/kegiatan', 'Master::kawasan', ['filter' => 'permission']);
$routes->get('/kro', 'Master::kro', ['filter' => 'permission']);
$routes->get('/ro', 'Master::ro', ['filter' => 'permission']);
$routes->get('/user', 'Master::user', ['filter' => 'permission']);
$routes->get('/delete-user/(:segment)', 'Master::delete_user/$1');
$routes->post('/update-user', 'Master::update_user');
$routes->get('/provinsi', 'Master::provinsi');
$routes->get('/role', 'RoleController::index');
$routes->get('/menu', 'MenuController::index');
$routes->post('/menu/updateVisibilitas', 'MenuController::updateVisibilitas');
$routes->get('/role/permission/(:segment)', 'RoleController::permission/$1');
$routes->get('/role/edit_permission/(:num)', 'RoleController::editPermission/$1');
$routes->post('role/updatePermission/(:num)', 'RoleController::updatePermission/$1');

//master nomenklatur kegiatan
$routes->post('master/get_kegiatan', 'Master::get_kegiatan');
$routes->post('master/get_kro', 'Master::get_kro');
$routes->post('master/get_ro', 'Master::get_ro');
$routes->post('master/get_nomenklatur', 'Master::get_nomenklatur');
$routes->get('master/get_detail_nomenklatur', 'Master::get_detail_nomenklatur');
$routes->post('master/exportToExcel', 'Master::export_to_excel', ['filter' => 'permission']);

$routes->get('/forbidden', function () {
    return view('errors/html/production');
});

// $routes->get('/login', 'Login::index');
$routes->get('/form', 'Master::form', ['filter' => 'permission']);

//RPIW
$routes->get('/rpiw', 'Rpiw::index', ['filter' => 'permission']);
$routes->get('/detail/(:segment)', 'Rpiw::detail/$1', ['filter' => 'permission']);
$routes->get('/kawasan', 'Rpiw::kawasan', ['filter' => 'permission']);
$routes->get('/detail_kawasan/(:segment)', 'Rpiw::detail_kawasan/$1', ['filter' => 'permission']);

// Route untuk menampilkan GeoJSON
$routes->get('/shapefile', 'ShapefileController::showMap', ['filter' => 'permission']);

// Route untuk tampilan peta
// $routes->get('/map', 'ShpController::index');
$routes->get('/map', 'MapController::index', ['filter' => 'permission']);
// $routes->get('/map/getGeoJson', 'MapController::getGeoJson');
$routes->get('/leaflet-draw', 'LeafletDraw::index', ['filter' => 'permission']);
$routes->post('/Rpiw/upload_geojson', 'Rpiw::upload_geojson', ['filter' => 'permission']);
$routes->post('/Rpiw', 'Rpiw::index', ['filter' => 'permission']);
//routes untuk report program
$routes->get('/Report', 'Rpiw::report', ['filter' => 'permission']);
$routes->post('/Report_Rpiw', 'Rpiw::report', ['filter' => 'permission']);
$routes->post('/rekap', 'Rpiw::rekap', ['filter' => 'permission']);
$routes->get('/rekap', 'Rpiw::rekap', ['filter' => 'permission']);

//routes memorandum program
$routes->get('/', 'Memorandum::index');
$routes->get('/memorandum', 'Memorandum::index', ['filter' => 'permission']);
$routes->post('memorandum/filter_data', 'Memorandum::filter_data', ['filter' => 'permission']);
$routes->post('memorandum/get_kawasan', 'Memorandum::get_kawasan', ['filter' => 'permission']);
$routes->get('/daftar_program', 'Memorandum::listProgram', ['filter' => 'permission']);
$routes->post('/memorandum/get_program', 'Memorandum::get_program', ['filter' => 'permission']);
$routes->post('/memorandum', 'Memorandum::index', ['filter' => 'permission']);
$routes->get('/memo/(:segment)', 'Memorandum::detail/$1', ['filter' => 'permission']);
$routes->post('/add_memorandum', 'Memorandum::insert', ['filter' => 'permission']);
$routes->get('/detail_program/(:segment)', 'Memorandum::programMemorandumDetail/$1', ['filter' => 'permission']);
$routes->post('/add_catatan', 'Memorandum::addCatatan', ['filter' => 'permission']);


//routes desk
$routes->get('/desk_kawasan', 'DeskController::kawasan', ['filter' => 'permission']);
$routes->get('/desk_program', 'DeskController::program', ['filter' => 'permission']);
// $routes->post('/desk/get_program', 'DeskController::get_program', ['filter' => 'role:Rakorbangwil,Konreg, SuperAdmin']);
// $routes->get('/desk/get_program', 'DeskController::get_program', ['filter' => 'role:Rakorbangwil,Konreg, SuperAdmin']);
// $routes->get('desk/detail_program/(:segment)', 'DeskController::programDeskDetail/$1', ['filter' => 'permission']);
$routes->post('/desk/exportToExcel', 'DeskController::export_to_excel', ['filter' => 'permission']);
$routes->post('/desk/get_kawasan', 'DeskController::get_kawasan_program', ['filter' => 'permission']);
$routes->post('/desk/get_catatan', 'DeskController::getCatatanKawasan', ['filter' => 'permission']);
$routes->post('/desk/simpan_catatan', 'DeskController::add_catatan_provinsi', ['filter' => 'permission']);

//routes pejabat
$routes->get('/tanda_tangan/daftar', 'DeskController::daftar_ttd', ['filter' => 'permission']);
$routes->get('/tanda_tangan/tambah', 'DeskController::add_ttd', ['filter' => 'permission']);
$routes->post('/tanda_tangan/tambah', 'DeskController::add_ttd_new', ['filter' => 'permission']);
$routes->get('/pejabat/daftar', 'DeskController::daftar_pejabat', ['filter' => 'permission']);
$routes->get('/pejabat/tambah', 'DeskController::add_pejabat', ['filter' => 'permission']);
$routes->get('/pejabat/edit/(:segment)', 'DeskController::pejabat_edit/$1', ['filter' => 'permission:edit']);
$routes->get('/pejabat/detail/(:segment)', 'DeskController::pejabat_detail/$1', ['filter' => 'permission']);
$routes->post('/pejabat/edit', 'DeskController::edit_pejabat', ['filter' => 'permission:edit']);
$routes->get('/pejabat/detail', 'DeskController::detail_pejabat', ['filter' => 'permission']);
$routes->get('/pejabat/delete', 'DeskController::delete_pejabat', ['filter' => 'permission:delete']);
$routes->post('/pejabat/tambah', 'DeskController::add_pejabat_new', ['filter' => 'permission']);

// routes BAK
$routes->get('/berita_acara', 'DeskController::berita_acara', ['filter' => 'permission']);
$routes->get('/addBak2/(:segment)/(:segment)', 'DeskController::generatePdf2/$1/$2', ['filter' => 'permission']);
$routes->get('/addBak3/(:segment)/(:segment)', 'DeskController::generatePdf3/$1/$2', ['filter' => 'permission']);
$routes->post('/desk/get_pejabat', 'DeskController::get_pejabat_ba', ['filter' => 'permission']);
$routes->post('/desk/add_pejabat', 'DeskController::add_pejabat_ba', ['filter' => 'permission']);
$routes->get('/desk/get_pejabat', 'DeskController::get_pejabat_ba', ['filter' => 'permission']);
$routes->get('/desk/pejabat/(:segment)', 'DeskController::delete_pejabat/$1', ['filter' => 'permission:delete']);
$routes->get('/berita_acara2', 'DeskController::berita_acara2', ['filter' => 'permission']);


//routes Laporan
$routes->get('/desk/laporan1', 'DeskController::laporan1', ['filter' => 'permission']);
$routes->post('/desk/laporan1', 'DeskController::get_program_laporan1', ['filter' => 'permission']);
$routes->get('/desk/laporan11', 'DeskController::get_program_laporan1', ['filter' => 'permission']);
$routes->get('/desk/laporan2', 'DeskController::laporan2', ['filter' => 'permission']);
$routes->post('/desk/laporan2', 'DeskController::get_program_laporan2', ['filter' => 'permission']);
$routes->get('/desk/laporan22', 'DeskController::get_program_laporan2', ['filter' => 'permission']);
$routes->post('/desk/excel1', 'DeskController::excel_laporan1', ['filter' => 'permission']);
$routes->post('/desk/excel2', 'DeskController::excel_laporan2', ['filter' => 'permission']);

//pasca rakorbangwil
// $routes->get('/nomenklatur', 'DeskController::nomenklatur', ['filter' => 'permission']);
$routes->get('/pasca_desk', 'DeskController::nomenklatur', ['filter' => 'permission']);
$routes->post('/add_nomenklatur', 'DeskController::add_nomenklatur', ['filter' => 'permission']);

//konreg
$routes->get('/usulanprovinsi', 'UsulanProvinsi::index', ['filter' => 'role:Konreg,SuperAdmin']);
$routes->post('/input_usulan_provinsi', 'UsulanProvinsi::input');
$routes->get('/getPP/(:num)', 'UsulanProvinsi::getPP/$1');
$routes->get('/getKP/(:num)', 'UsulanProvinsi::getKP/$1');
$routes->get('/getPROP/(:num)', 'UsulanProvinsi::getPROP/$1');
$routes->get('/listUsulan', 'UsulanProvinsi::listUsulan');
$routes->post('/listUsulan', 'UsulanProvinsi::listUsulan');
$routes->get('/detailusulan/(:segment)', 'UsulanProvinsi::detail/$1');
$routes->get('/editusulan/(:segment)', 'UsulanProvinsi::edit/$1', ['filter' => 'permission:edit']);
$routes->post('/UsulanProvinsi/edit', 'UsulanProvinsi::prosesEdit', ['filter' => 'permission:edit']);
$routes->post('/deleteusulan/(:segment)', 'UsulanProvinsi::delete/$1', ['filter' => 'permission:delete']);
$routes->get('/deleteusulan/(:segment)', 'UsulanProvinsi::delete/$1', ['filter' => 'permission:delete']);

//export excel
$routes->post('/konreg/exportToExcel', 'KonregController::export_to_excel', ['filter' => 'permission']);
$routes->get('/konreg/exportToExcel', 'KonregController::export_to_excel', ['filter' => 'permission']);
$routes->post('/rakortek/exportToExcel', 'KonregController::export_to_excel_rakortek', ['filter' => 'permission']);
$routes->post('/fkw/exportToExcel', 'KonregController::export_to_excel_fkw', ['filter' => 'permission']);
$routes->post('/fkb/exportToExcel', 'KonregController::export_to_excel_fkb', ['filter' => 'permission']);
$routes->post('/ditangguhkan/exportToExcel', 'KonregController::export_to_excel_ditangguhkan', ['filter' => 'permission']);
$routes->post('/rakorbangwil/exportToExcel', 'KonregController::export_to_excel_rakorbangwil', ['filter' => 'permission']);

$routes->post('/usulanProvinsi/filter_data', 'UsulanProvinsi::filter_data');
$routes->get('/usulanProvinsi/filter_data', 'UsulanProvinsi::filter_data');
$routes->get('/usulanProvinsi/filter_data', 'UsulanProvinsi::filter_data');
$routes->get('/Rakortek', 'KonregController::dataRakortek');
$routes->get('/apiUnor', 'KonregController::dataApiUnor');
$routes->post('/apiUnor/filter_data', 'KonregController::filter_dataApiUnor');
$routes->get('/ ', 'KonregController::filter_dataApiUnor');
$routes->get('/detail_dataUnor/(:segment)', 'KonregController::detail_dataRakortek/$1');

//input provinsi
$routes->post('UsulanProvinsi/get_pn', 'UsulanProvinsi::getPN');
$routes->post('UsulanProvinsi/get_pp', 'UsulanProvinsi::getPP');
$routes->post('UsulanProvinsi/get_kp', 'UsulanProvinsi::getKP');
$routes->post('UsulanProvinsi/get_prop', 'UsulanProvinsi::getPROP');
$routes->get('UsulanProvinsi/get_prop', 'UsulanProvinsi::getPROP');
$routes->post('UsulanProvinsi/add_catatan', 'UsulanProvinsi::addCatatan');
$routes->post('UsulanProvinsi/get_kawasan', 'UsulanProvinsi::get_kawasan');
$routes->post('UsulanProvinsi/get_kegiatan', 'UsulanProvinsi::get_kegiatan');
$routes->post('UsulanProvinsi/get_kro', 'UsulanProvinsi::get_kro');
$routes->post('UsulanProvinsi/get_ro', 'UsulanProvinsi::get_ro');
$routes->get('UsulanProvinsi/get_ro', 'UsulanProvinsi::get_ro');
$routes->post('UsulanProvinsi/get_satuan', 'UsulanProvinsi::get_satuan');
$routes->post('UsulanProvinsi/get_program', 'UsulanProvinsi::get_program');
// $routes->post('UsulanProvinsi/get_prop', 'UsulanProvinsi::get_prop');


//pradesk rakorbangwil
$routes->get('/daftarRakorbangwil', 'KonregController::program', ['filter' => 'permission']);
$routes->post('/pradesk/get_program', 'KonregController::get_program', ['filter' => 'permission']);
$routes->get('/pradesk/get_program', 'KonregController::get_program', ['filter' => 'permission']);
$routes->get('rakorbangwil/detail_program/(:segment)', 'KonregController::programDeskDetail/$1', ['filter' => 'permission']);
$routes->get('rakorbangwil/edit_program/(:segment)', 'KonregController::programDeskEdit/$1', ['filter' => 'permission']);
$routes->post('/prosesRakorbangwil', 'KonregController::inputRakorbangwil', ['filter' => 'permission']);
$routes->get('/sitebaru', 'KonregController::fungsibaru', ['filter' => 'permission']);

//Program Konreg
$routes->get('/program-konreg/fkw', 'KonregController::program_fkw', ['filter' => 'permission']);
$routes->get('/program-konreg/fkb', 'KonregController::program_fkb', ['filter' => 'permission']);
$routes->post('/program/get_program_fkw', 'KonregController::get_program_fkw', ['filter' => 'permission']);
$routes->get('/program/get_program_fkw', 'KonregController::get_program_fkw', ['filter' => 'permission']);
$routes->post('/program/get_program_fkb', 'KonregController::get_program_fkb', ['filter' => 'permission']);
$routes->get('/program/get_program_fkb', 'KonregController::get_program_fkb', ['filter' => 'permission']);
$routes->get('program/detail_program_fkw/(:segment)', 'KonregController::programFkwDetail/$1', ['filter' => 'permission']);
$routes->get('program/detail_program_fkb/(:segment)', 'KonregController::programFkbDetail/$1', ['filter' => 'permission']);
//temp fkw fb unor
$routes->get('/unor/fkw', 'KonregController::unor_program_fkw', ['filter' => 'permission']);
$routes->get('/unor/fkb', 'KonregController::unor_program_fkb', ['filter' => 'permission']);
$routes->post('/unor/get_program_fkw', 'KonregController::unor_get_program_fkw', ['filter' => 'permission']);
$routes->get('/unor/get_program_fkw', 'KonregController::unor_get_program_fkw', ['filter' => 'permission']);
$routes->post('/unor/get_program_fkb', 'KonregController::unor_get_program_fkb', ['filter' => 'permission']);
$routes->get('/unor/get_program_fkb', 'KonregController::unor_get_program_fkb', ['filter' => 'permission']);
$routes->get('/unor/detail_program_fkw/(:segment)', 'KonregController::unor_programFkwDetail/$1', ['filter' => 'permission']);
$routes->get('/unor/detail_program_fkb/(:segment)', 'KonregController::unor_programFkbDetail/$1', ['filter' => 'permission']);
//$routes->post('/prosesRakorbangwil', 'KonregController::inputRakorbangwil', ['filter' => 'permission']);

//api
// $routes->post('api/usulan_provinsi/create', 'Api\UsulanProvinsiController::create');
$routes->group('api', ['filter' => 'api-token'], function ($routes) {
    $routes->post('dataKonregUnor', 'Api\ApiController::insert_api_unor');
    $routes->post('Unorfkw', 'Api\ApiController::api_post_unor_fkw');
    $routes->post('Unorfkb', 'Api\ApiController::api_post_unor_fkb');
    $routes->put('Unorfkb/(:segment)', 'Api\ApiController::api_put_unor_fkb/$1');
    $routes->put('Unorfkw/(:segment)', 'Api\ApiController::api_put_unor_fkw/$1');
    $routes->get('Unorfkw', 'Api\ApiController::api_get_unor_fkw');
    $routes->get('Unorfkw/(:segment)', 'Api\ApiController::api_get_unor_fkw/$1');
    $routes->delete('Unorfkw/(:segment)', 'Api\ApiController::api_delete_unor_fkw/$1', ['filter' => 'permission:delete']);
    $routes->get('Unorfkb', 'Api\ApiController::api_get_unor_fkb');
    $routes->get('Unorfkb/(:segment)', 'Api\ApiController::api_get_unor_fkb/$1');
    $routes->delete('Unorfkb/(:segment)', 'Api\ApiController::api_delete_unor_fkb/$1', ['filter' => 'permission:delete']);
    $routes->post('dataKonregRakortek', 'Api\ApiController::insert_api_rakortek');
    $routes->put('api/rakortek/(:segment)', 'Api\ApiController::update_api_rakortek/$1');
    $routes->post('Unorfkw2', 'Api\ApiController::api_post_unor_fkw2');
    $routes->get('getfkw', 'Api\ApiController::get_unor_fkw');
    $routes->get('getfkb', 'Api\ApiController::get_unor_fkb');
});
//rakortek
$routes->get('import_rakortek', 'Api\ApiController::importFromApiRakortek', ['filter' => 'permission']);
$routes->post('/Rakortek/filter_data', 'KonregController::filter_dataRakortek');
$routes->get('/Rakortek/filter_data', 'KonregController::filter_dataRakortek');
$routes->get('/detail_Rakortek/(:segment)', 'KonregController::detail_dataRakortek/$1');
$routes->get('/edit_rakortek/(:segment)', 'KonregController::edit_dataRakortek/$1', ['filter' => 'permission:edit']);
$routes->post('proses/edit_rakortek', 'KonregController::prosesEditRakortek', ['filter' => 'permission:edit']);
$routes->get('proses/edit_rakortek', 'KonregController::prosesEditRakortek', ['filter' => 'permission:edit']);

//desk konreg
$routes->get('program/edit_program_fkw/(:segment)', 'KonregController::programFkwEdit/$1', ['filter' => 'permission:edit']);
$routes->get('program/edit_program_fkb/(:segment)', 'KonregController::programFkbEdit/$1', ['filter' => 'permission:edit']);
$routes->post('program/editFkw', 'KonregController::prosesEditFkw', ['filter' => 'permission:edit']);
$routes->post('program/editFkb', 'KonregController::prosesEditFkb', ['filter' => 'permission:edit']);
$routes->get('program/editFkb', 'KonregController::prosesEditFkb', ['filter' => 'permission:edit']);
$routes->get('daftar_pejabat', 'KonregController::daftar_pejabat_konreg', ['filter' => 'permission']);
$routes->post('Konreg/get_kro', 'KonregController::get_kro');
$routes->get('Konreg/get_kro', 'KonregController::get_kro');
$routes->post('Konreg/get_ro', 'KonregController::get_ro');
$routes->get('Konreg/get_ro', 'KonregController::get_ro');
$routes->post('/UsulanProvinsi/edit', 'KonregController::inputFUP', ['filter' => 'permission:edit']);

$routes->post('/Konreg/get/Repot1', 'KonregController::get_laporan1');
$routes->get('/Konreg/Repot1', 'KonregController::laporan1');
$routes->get('/Konreg/fks', 'KonregController::rekap_fks');
$routes->post('/program/get_rekap_fks', 'KonregController::get_rekap_fks');
$routes->get('/program/get_rekap_fks', 'KonregController::get_rekap_fks');
$routes->get('/Konreg/ditangguhkan', 'KonregController::rekap_ditangguhkan');
$routes->post('/program/get_rekap_ditangguhkan', 'KonregController::get_rekap_ditangguhkan');
$routes->get('/program/get_rekap_ditangguhkan', 'KonregController::get_rekap_ditangguhkan');

// routes BAK Konreg
$routes->get('/konreg/berita_acara', 'KonregController::berita_acara', ['filter' => 'permission']);
$routes->post('/konreg/get_pejabat', 'KonregController::get_pejabat_ba', ['filter' => 'permission']);
$routes->post('/konreg/add_pejabat', 'KonregController::add_pejabat_ba', ['filter' => 'permission']);
$routes->get('/konreg/pejabat/(:segment)', 'KonregController::delete_pejabat/$1', ['filter' => 'permission:delete']);
$routes->get('/addBakKonreg/(:segment)/(:segment)/(:segment)', 'KonregController::generateBA/$1/$2/$3', ['filter' => 'permission']);
// $routes->get('/addBak3/(:segment)/(:segment)', 'DeskController::generatePdf3/$1/$2', ['filter' => 'permission']);
// $routes->post('/desk/get_pejabat', 'DeskController::get_pejabat_ba', ['filter' => 'permission']);
// $routes->get('/desk/get_pejabat', 'DeskController::get_pejabat_ba', ['filter' => 'permission']);
// $routes->post('/desk/add_pejabat', 'DeskController::add_pejabat_ba', ['filter' => 'permission']);
// $routes->get('/berita_acara2', 'DeskController::berita_acara2', ['filter' => 'permission']);

//unor to fkw fkb 
// $routes->get('proses/api_to_fkw', 'KonregController::api_to_fkw');
// $routes->get('proses/api_to_fkb', 'KonregController::api_to_fkb');

$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::attemptRegister');
