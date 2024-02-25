<h1 class="mt-4">Peminjaman Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <?php
                    $date = date('y-m-d');
                    if (isset($_POST['submit'])) {
                        $BukuID = $_POST['BukuID'];
                        $UserID = $_SESSION['userid']['UserID'];
                        $TanggalPeminjaman = $date;
                        $TanggalPengembalian = date('y-m-d', strtotime($date. '+1 days'));
                        // $StatusPeminjaman = $_POST['StatusPeminjaman'];
                        $StatusPeminjaman = 'dipinjam';
                        
                        $buku = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID='$BukuID'"));

                        
                        if ($buku["Stok"] == 0) {
                            
                            echo "
                            <script>
                            alert('Stok Habis');
                            location.href = 'index.php?page=peminjaman_tambah';
                            </script>
                            ";       
                        } else {
                            $query_update_stok = mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE BukuID=$BukuID");
                            if ($query_update_stok) {
                                $query = mysqli_query($koneksi, "INSERT INTO peminjam(BukuID,UserID,TanggalPeminjaman,TanggalPengembalian,StatusPeminjaman) values('$BukuID','$UserID','$date','$TanggalPengembalian','$StatusPeminjaman')");
                                if ($query) {
                                    echo '
                                    <script>
                                    alert("Tambah Data Berhasil.")
                                    location.href = "index.php?page=peminjaman";
                                    </script>';
                                } else {
                                    echo '<script>alert("Tambah Data Gagal.")</script>';
                                }
                            }
                            

                        }
                            
                    }
                    ?>
                    <div class="row mb-3">
                        <div class="col-md-2">Buku</div>
                        <div class="col-md-8">
                            <!-- <select type="date" class="form-control" name="TanggalPeminjaman"></select>  -->
                            <select name="BukuID" class="form-control">
                                <?php
                                $buk = mysqli_query($koneksi, "SELECT*FROM buku");
                                while ($buku = mysqli_fetch_array($buk)) {
                                ?>
                                    <option value="<?php echo $buku['BukuID']; ?>"><?php echo $buku['Judul']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">Tanggal Peminjaman</div>
                        <div class="col-md-8">
                            <span><?php echo date('Y-m-d');?></span>
                        </div>
                    </div>

                    <!-- <div class="row mb-3">
                        <div class="col-md-2">Tanggal Pengembalian</div>
                        <div class="col-md-8">
                        <span>
                            <?php echo date('y-m-d', strtotime('+1 days'));?>
                        </span>
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <div class="col-md-2">Tanggal Pengembalian</div>
                        <div class="col-md-8">
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime('+1 days'));?>" name="TanggalPengembalian">
                        </div>
                    </div>

                    <!-- <div class="row mb-3">
                        <div class="col-md-2">Status Peminjaman</div>
                        <div class="col-md-8">
                            <select name="StatusPeminjaman" class="form-control">
                                <option value="dipinjam">Dipinjam</option>
                                <option value="dikembalikan">Dikembalikan</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <a href="?page=peminjaman" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>