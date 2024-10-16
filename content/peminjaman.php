<?php
$peminjaman = mysqli_query($koneksi, "SELECT anggota.nama_anggota, peminjaman.* FROM peminjaman LEFT JOIN anggota 
ON anggota.id = peminjaman.id_anggota ORDER BY id DESC");
?>

<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3">Data Peminjaman</legend>
        <div align="right">
            <a href="?pg=tambah-peminjaman" class="btn btn-primary">Tambah</a>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>No Peminjaman</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($peminjaman)):
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $rowBuku['nama_anggota'] ?></td>
                            <td><?php echo $rowBuku['no_peminjaman'] ?></td>
                            <td><?php echo $rowBuku['tgl_peminjaman'] ?></td>
                            <td><?php echo $rowBuku['tgl_pengembalian'] ?></td>
                            <td><?php echo $rowBuku['status'] ?></td>
                            <td>
                                <!-- <a id="edit-buku" data-id=""></a> -->
                                <a href="?pg=tambah-peminjaman&edit=<?php echo $row['id'] ?>"
                                    class="btn btn-success btn-sm">Edit</a> |
                                <a href="?pg=tambah-peminjaman&delete=<?php echo $row['id'] ?>"
                                    onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')"
                                    class="btn btn-danger btn-sm">Delete</a>
                                <!-- <i class="bi bi-trash"></i> | <i class="bi bi-pencil"></i> </i> -->
                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>