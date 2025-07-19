<?php

use PhpParser\Node\Stmt\Continue_;

$a = 1;
foreach ($pejabat as $pejabat) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $pejabat->nama_pejabat ?></td>
        <td><?= $pejabat->jabatan ?></td>
        <td><?= $pejabat->provinsi ?></td>
        <td>
            <a href="#"
                onclick="confirmDelete('<?= base_url('desk/pejabat/' . $pejabat->id) ?>');">
                <i class="fas fa-times" style="color: red;" title="hapus"></i>
            </a>
        </td>


    </tr>
<?php endforeach; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Tanda Tangan Pejabat Ini Akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengkonfirmasi, arahkan ke URL penghapusan
                window.location.href = url;
            }
        });
    }
</script>