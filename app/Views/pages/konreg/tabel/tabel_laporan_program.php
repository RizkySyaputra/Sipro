        <?php
        $no = 1;
        $total = [
            'program_SDA' => 0,
            'anggaran_SDA' => 0,
            'program_BM' => 0,
            'anggaran_BM' => 0,
            'program_CK' => 0,
            'anggaran_CK' => 0,
            'program_PS' => 0,
            'anggaran_PS' => 0,
            'program' => 0,
            'anggaran' => 0
        ];

        foreach ($data as $row) {
            echo "<tr>
                <td>{$no}</td>
                <td>{$row->provinsi}</td>
                <td>{$row->program_SDA}</td>
                <td>" . number_format($row->anggaran_SDA, 0, ',', '.') . "</td>
                <td>{$row->program_BM}</td>
                <td>" . number_format($row->anggaran_BM, 0, ',', '.') . "</td>
                <td>{$row->program_CK}</td>
                <td>" . number_format($row->anggaran_CK, 0, ',', '.') . "</td>
                <td>{$row->program_PS}</td>
                <td>" . number_format($row->anggaran_PS, 0, ',', '.') . "</td>
                <td>{$row->program}</td>
                <td>" . number_format($row->anggaran, 0, ',', '.') . "</td>
            </tr>";

            // Hitung total
            foreach ($total as $k => $v) {
                $total[$k] += $row->$k;
            }

            $no++;
        }
        ?>
        <tr>
            <th colspan="2">TOTAL</th>
            <th hidden></th>
            <th><?= $total['program_SDA'] ?></th>
            <th><?= number_format($total['anggaran_SDA'], 0, ',', '.') ?></th>
            <th><?= $total['program_BM'] ?></th>
            <th><?= number_format($total['anggaran_BM'], 0, ',', '.') ?></th>
            <th><?= $total['program_CK'] ?></th>
            <th><?= number_format($total['anggaran_CK'], 0, ',', '.') ?></th>
            <th><?= $total['program_PS'] ?></th>
            <th><?= number_format($total['anggaran_PS'], 0, ',', '.') ?></th>
            <th><?= $total['program'] ?></th>
            <th><?= number_format($total['anggaran'], 0, ',', '.') ?></th>
        </tr>