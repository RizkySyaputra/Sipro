$(document).ready(function() {
    //ambil kawasan untuk filter
    $('#filter-provinsi').on('change', function() {
        var provinsiId = $(this).val(); // Ambil nilai provinsi yang dipilih
        $.ajax({
            url: '<?= base_url("memorandum/get_kawasan") ?>', // URL untuk memproses ambil data kawasan
            type: 'POST',
            data: {
                provinsi_id: provinsiId
            }, // Kirimkan ID provinsi sebagai data
            success: function(response) {
                // Kosongkan dropdown kawasan
                $('#filter-kawasan').empty();
                // Tambahkan opsi default
                $('#filter-kawasan').append('<option value="">Semua Kawasan</option>');

                // Update data option select kawasan dengan data yang diterima
                $.each(response, function(index, kawasan) {
                    $('#filter-kawasan').append('<option value="' + kawasan.kode_kawasan + '">' + kawasan.nama_kawasan + '</option>');
                });
            },
            error: function() {
                alert('Error loading data');
            }
        });
    });


    // Inisialisasi Select2 untuk semua dropdown
    $('#filter-unor, #filter-provinsi, #filter-kawasan, #filter-residu, #filter-tahun_anggaran').select2();
    // Restore values from local storage
    $('#filter-unor').val(localStorage.getItem('selectedUnor'));
    $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
    $('#filter-kawasan').val(localStorage.getItem('selectedKawasan'));
    $('#filter-residu').val(localStorage.getItem('selectedResidu'));
    $('#filter-tahun_anggaran').val(localStorage.getItem('selectedTahun'));

    // On form submit, save the selected values
    $('#filter-form').on('submit', function() {
        event.preventDefault();

        $('#loading-spinner').show();
        $('#button-text').hide();
        // Ambil data filter dari form
        var filterData = $(this).serialize();
        // Kirim request AJAX
        $.ajax({
            url: '<?= base_url("memorandum/filter_data") ?>', // URL untuk memproses filter
            type: 'POST',
            data: filterData,
            success: function(response) {
                // Hapus inisialisasi DataTables yang lama
                if ($.fn.DataTable.isDataTable('#datatables')) {
                    $('#datatables').DataTable().destroy();
                }
                // Update tabel dengan data yang diterima
                $('#datatables tbody').html(response);


                //Inisialisasi DataTables kembali
                $('#datatables').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records",
                    }
                });
            },
            error: function() {
                alert('Error loading data');
            },
            complete: function() {
                // Sembunyikan spinner dan kembalikan teks tombol
                $('#loading-spinner').hide();
                $('#button-text').show();
            }
        });
    });

    $('#reset-filters').on('click', function() {
        // Reset dropdowns to their default values
        $('#filter-unor').val('').trigger('change');
        $('#filter-provinsi').val('').trigger('change');
        $('#filter-kawasan').val('').trigger('change');
        $('#filter-residu').val('').trigger('change');
        $('#filter-tahun_anggaran').val('').trigger('change');

        // Optionally clear the table data
        //$('#datatables tbody').empty();

        // Optionally, you could also clear the local storage if needed
        localStorage.removeItem('selectedUnor');
        localStorage.removeItem('selectedProvinsi');
        localStorage.removeItem('selectedKawasan');
        localStorage.removeItem('selectedResidu');
        localStorage.removeItem('selectedTahun');
    });
});