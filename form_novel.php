<?php 
require_once "koneksi.php";
if(defined("GELANG")===false){
    die("Anda tidak dapat membuka halaman ini secara langsung!");
}
$sql="SELECT * FROM user WHERE soft_delete=0";
$result_user=mysqli_query($conn,$sql);
$sql2="SELECT * FROM genres WHERE soft_delete=0";
$result_genre=mysqli_query($conn,$sql2);
?>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="?page=simpan_novel" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Judul Novel</label>
                    <input type="text" name="judul_novel" class="form-control" placeholder="Masukkan Judul Novel" required>
                </div>
                <div class="form-group">
                    <label>Sinopsis</label>
                    <textarea name="sinopsis" rows="5" class="form-control" placeholder="Masukkan Sinopsis Novel" required></textarea>
                </div>
                <div class="form-group">
                    <label>Tanggal Terbit</label>
                    <input type="date" name="tgl_terbit" class="form-control">
                </div>
                <div class="form-group">
                    <label>Genre</label>
                    <?php
                        while ($row = mysqli_fetch_assoc($result_genre)) 
                        {
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" name="genre[]" value="'.$row['id_genre'].'">
                                <label class="form-check-label">
                                    '.$row['nama_genre'].'
                                </label>';
                            echo '</div>';
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label>File Cover</label>
                    <input type="file" name="file_cover" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>File Novel</label>
                    <input type="file" name="file_novel" class="form-control" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan" name="kirim">
            </form>
        </div>
    </div>
</div>