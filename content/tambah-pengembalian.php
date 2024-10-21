<?php
if (isset($_POST['simpan'])) {
    $no_peminjaman = $_POST['no_peminjaman'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];
    $id_buku = $_POST['id_buku'];
    $status = "Dipinjam";

    //SQL
    // DML = Data Manipulation Language (select, update, delete, insert)

    //INSERT
    $insert = mysqli_query($koneksi, "INSERT INTO peminjaman (no_peminjaman, id_anggota, tgl_peminjaman, tgl_pengembalian, status) VALUES ('$no_peminjaman', '$id_anggota', '$tgl_peminjaman', '$tgl_pengembalian', '$status')");
    $id_peminjaman = mysqli_insert_id($koneksi);
    foreach ($id_buku as $key => $buku) {
        $buku = $_POST['id_buku'][$key];

        $insertDetail = mysqli_query($koneksi, "INSERT INTO detail_peminjaman (id_peminjaman, id_buku) VALUES ('$id_peminjaman', '$buku')");
    }
    header("location:?pg=peminjaman&tambah=berhasil");


}


//EDIT
//show filled form/existed data to be edited
$id = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryPeminjam = mysqli_query($koneksi, "SELECT anggota.nama_anggota, peminjaman.* FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota WHERE peminjaman.id = '$id'");
$rowPeminjam = mysqli_fetch_assoc($queryPeminjam);

//Detail Peminjaman Buku
$queryDetailPinjam = mysqli_query($koneksi, "SELECT buku.nama_buku, detail_peminjaman.* FROM detail_peminjaman LEFT JOIN buku ON buku.id = detail_peminjaman.id_buku WHERE id_peminjaman = '$id'");




//delete - soft delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "UPDATE peminjaman SET deleted_at = 1 WHERE id='$id'");
    header("location:?pg=peminjaman&hapus=berhasil");
}

$queryBuku = mysqli_query($koneksi, "SELECT * FROM buku");


//Anggota
$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota");
// $rowAnggota = mysqli_fetch_assoc($queryAnggota);

$queryKodePnjm = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status ='Dipinjam'");



// echo $kode_pinjam;


?>

<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3"><?php echo isset($_GET['detail']) ? 'Detail' : 'Tambah' ?> Pengembalian
            Buku
        </legend>

        <form action="" method="POST">
            <div class="mb-3 row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Peminjaman</label>
                        <select name="id_peminjaman" id="id_peminjaman" class="form-control">
                            <!-- data option diambil dari table peminjaman -->
                            <option value="">--No Peminjam--</option>
                            <?php while ($rowPeminjaman = mysqli_fetch_assoc($queryKodePnjm)): ?>
                                <option value="<?php echo $rowPeminjaman['no_peminjaman'] ?>">
                                    <?php echo $rowPeminjaman['no_peminjaman'] ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                Data Peminjam
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">No Peminjaman</label>
                                            <input type="text" readonly id="no_pinjam" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Tanggal Peminjaman</label>
                                            <input type="text" readonly id="tgl_peminjaman" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Denda</label>
                                            <input type="text" readonly id="denda" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nama Anggota</label>
                                            <input type="text" readonly id="nama_anggota" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Tanggal Pengembalian</label>
                                            <input type="text" readonly id="tgl_pengembalian" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- up, data dari query php -->

            <!-- data from js -->
            <table id="table-pengembalian" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Buku</th>
                    </tr>
                </thead>
                <tbody class="table-row"></tbody>
            </table>
            <div align="left" class="mb-3">
                <button type="submit" id="" name="simpan" class="btn btn-primary">Simpan</button>
            </div>

        </form>


    </fieldset>
</div>