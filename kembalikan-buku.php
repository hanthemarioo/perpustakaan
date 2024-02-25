<?php
 $id = $_GET['id'];
 $date = date('Y-m-d');
 $query = mysqli_query($koneksi, "UPDATE peminjam SET StatusPeminjaman = 'dikembalikan', TanggalPengembalian = '$date' WHERE PeminjamanID=$id");
 $BukuID = mysqli_fetch_row(mysqli_query($koneksi, "SELECT BukuID FROM peminjam WHERE PeminjamanID=$id"))[0];
 mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE BukuID=$BukuID");
?>
<script>
    alert('Berhasil Mengembalikan Buku');
    location.href = 'index.php?peminjaman=buku';
</script>