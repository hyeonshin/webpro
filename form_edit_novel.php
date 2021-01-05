<?php 
if(defined("GELANG"===false)){
    die("Anda tidak dapat membuka halaman ini secara langsung");
}
require_once("koneksi.php");
$id=$_GET['id'];
$sql="SELECT * FROM novel WHERE id_novel=".$id;
$sql2="SELECT * FROM user WHERE soft_delete=0";
$result_user=mysqli_query($conn,$sql2);
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
?>
<div class="contain">
    <div class="row">
        <div class="col">
            <form action="?page=simpan_novel&id=<?=$row['id_novel'];?>" method="post">
                <div class="form-group">
                    <label>Masukkan Judul Novel</label>
                    <input type="text" name="judul_novel" value="<?=$row['judul_novel'];?>" class="form-control"
                        placeholder="Judul Novel ea">
                    <label>Masukkan File Cover</label>
                    <input type="file" name="file_cover" value="<?=$row['file_cover'];?>" class="form-control">
                    <label>Masukkan File Novel</label>
                    <input type="file" name="file_novel" value="<?=$row['file_novel'];?>" class="form-control">
                    <label>Masukkan Sinopsis</label>
                    <input type="text" name="sinopsis" value="<?=$row['sinopsis'];?>" class="form-control"
                        placeholder="Sinopsis ea">
                    <label>Masukkan Tanggal Terbit</label>
                    <input type="date" name="tgl_terbit" value="<?=$row['tgl_terbit'];?>" class="form-control">
                    <label>Masukkan user</label>
                    <select name="id_user" class="form-control">
                        <?php
                        while($row_user = mysqli_fetch_assoc($result_user)) {
                        if($row_user['id_user'] == $row['id_user']){
                        $selected = "selected";
                        }else{
                        $selected = "";
                        }
                        $output = '<option value="'.$row_user['id_user'].'" '.$selected.'>'.$row_user['nama_user'].'</option>';
                        echo $output;                   
                        }
                    ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
        </div>
    </div>
</div>