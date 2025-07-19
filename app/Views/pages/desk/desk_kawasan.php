        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .filter-section {
                background: #007bff;
                color: white;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .table-section {
                margin-bottom: 20px;
                display: none;
                /* Tabel disembunyikan awalnya */
            }

            .note-section {
                padding: 20px;
                background: #e9ecef;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                display: none;
                /* Kolom catatan disembunyikan awalnya */
            }
        </style>

        <div class="container my-4">
            <!-- Filter Section -->
            <div class="filter-section">
                <h4>Filter Kawasan</h4>
                <div class="form-group">
                    <label for="provinsi">Pilih Provinsi</label>
                    <select id="provinsi" class="form-control">
                        <option value="" disabled selected>Pilih Provinsi</option>
                        <option value="Aceh">Aceh</option>
                        <option value="Sumatera Utara">Sumatera Utara</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <!-- Tambahkan provinsi lainnya -->
                    </select>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <h4>Daftar Kawasan</h4>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kawasan</th>
                            <th>Provinsi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- Data kawasan akan ditambahkan di sini -->
                    </tbody>
                </table>
            </div>

            <!-- Note Section with Save Button -->
            <div class="note-section">
                <h4>Catatan Kawasan</h4>
                <div class="form-group">
                    <label for="catatan">Masukkan Catatan</label>
                    <textarea id="catatan" class="form-control" rows="5" placeholder="Tulis catatan di sini..."></textarea>
                </div>
                <button id="saveButton" class="btn btn-primary">Simpan Catatan</button>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                // Data dummy untuk daftar kawasan
                const kawasanData = {
                    Aceh: ["Kawasan Sabang", "Kawasan Banda Aceh"],
                    "Sumatera Utara": ["Kawasan Medan", "Kawasan Parapat"],
                    "Jawa Barat": ["Kawasan Bandung", "Kawasan Bogor"]
                };

                // Event handler untuk filter provinsi
                $('#provinsi').on('change', function() {
                    const selectedProvinsi = $(this).val();
                    const tableBody = $('#table-body');
                    tableBody.empty(); // Kosongkan tabel sebelum diisi

                    if (kawasanData[selectedProvinsi]) {
                        kawasanData[selectedProvinsi].forEach((kawasan, index) => {
                            tableBody.append(
                                `<tr>
                                    <td>${index + 1}</td>
                                    <td>${kawasan}</td>
                                    <td>${selectedProvinsi}</td>
                                </tr>`
                            );
                        });

                        // Tampilkan tabel dan kolom catatan setelah provinsi dipilih
                        $('.table-section').fadeIn();
                        $('.note-section').fadeIn();
                    } else {
                        tableBody.append(
                            `<tr>
                                <td colspan="3" class="text-center">Tidak ada data kawasan</td>
                            </tr>`
                        );
                    }
                });

                // Event handler untuk tombol Simpan
                $('#saveButton').on('click', function() {
                    const catatan = $('#catatan').val();
                    const provinsi = $('#provinsi').val();

                    if (!provinsi) {
                        alert('Silakan pilih provinsi terlebih dahulu.');
                        return;
                    }

                    if (catatan.trim() === '') {
                        alert('Catatan tidak boleh kosong.');
                        return;
                    }

                    // Mengirimkan data catatan ke server menggunakan AJAX
                    $.ajax({
                        url: 'simpan_catatan.php', // URL PHP untuk menyimpan catatan
                        type: 'POST',
                        data: {
                            provinsi: provinsi,
                            catatan: catatan
                        },
                        success: function(response) {
                            alert('Catatan berhasil disimpan!');
                            $('#catatan').val(''); // Kosongkan textarea setelah simpan
                        },
                        error: function() {
                            alert('Terjadi kesalahan. Coba lagi!');
                        }
                    });
                });
            });
        </script>