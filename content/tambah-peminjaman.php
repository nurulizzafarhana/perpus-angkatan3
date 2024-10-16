<?php
if (isset($_POST['tambah'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    $id_kategori = $_POST['id_kategori'];

    //SQL
    // DML = Data Manipulation Language (select, update, delete, insert)

    //INSERT
    $insert = mysqli_query($koneksi, "INSERT INTO buku (nama_buku, penerbit, tahun_terbit, pengarang, id_kategori) VALUES ('$nama_buku', '$penerbit', '$tahun_terbit', '$pengarang', '$id_kategori')");
    header("location:?pg=buku&tambah=berhasil");


}


//EDIT
//show filled form/existed data to be edited
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editBuku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'");
$rowBuku = mysqli_fetch_assoc($editBuku);


//post edited data
if (isset($_POST['edit'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    $id_kategori = $_POST['id_kategori'];

    //update user, kolom apa yang mau diubah
    $update = mysqli_query($koneksi, "UPDATE buku SET nama_buku='$nama_buku', penerbit='$penerbit', tahun_terbit='$tahun_terbit', pengarang='$pengarang', id_kategori='$id_kategori' WHERE id='$id'");
    header("location:?pg=buku&ubah=berhasil");
}


//delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");
    header("location:?pg=buku&hapus=berhasil");
}

$queryBuku = mysqli_query($koneksi, "SELECT * FROM buku");


?>

<div class="mt-5 container">
    <fieldset class="border p-3 border-black border-2">
        <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Peminjaman
        </legend>

        <form action="" method="POST">
            <div class="mb-3 row">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="" class="form-label">No. Peminjaman</label>
                        <input type="text" class="form-control" name="no_peminjaman" value="" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Peminjaman</label>
                        <input type="date" class="form-control" name="tgl_peminjaman" value="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Buku</label>
                        <select name="" id="id_buku" class="form-control">
                            <option value="">Pilih Buku</option>
                            <?php while ($rowBuku = mysqli_fetch_assoc($queryBuku)): ?>
                                <option value="<?php $rowBuku['id'] ?>">
                                    <?php echo $rowBuku['nama_buku']; ?>
                                </option>
                            <?php endwhile ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Anggota</label>
                        <select id="" class="form-control" name="id_anggota">
                            <option value="">Pilih Anggota</option>
                            <!-- ambil data dari tabel anggota -->
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" name="tgl_pengembalian" value="">
                    </div>
                </div>
            </div>

            <div align="right" class="mb-3">
                <button type="button" id="add-row" class="btn btn-primary">Tambah Row</button>
            </div>


            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-row"></tbody>
            </table>
        </form>


    </fieldset>
</div>