$(document).ready(function() {
    var availableTags = [
        "Option 1",
        "Option 2",
        "Option 3",
        // Tambahkan opsi sesuai kebutuhan
    ];

    $("#cari").autocomplete({
        source: availableTags,
        minLength: 0 // Mengatur panjang minimum menjadi 0
    }).focus(function() {
        $(this).autocomplete("search", ""); // Mencari semua opsi saat fokus
    });
});