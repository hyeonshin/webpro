<?php 
require_once "koneksi.php";
if (defined("GELANG")===false) {
    die("anda tidak dapat membuka halaman ini secara langsung!");
}
$sql="SELECT * FROM `role`";
$result_role=mysqli_query($conn,$sql);
?>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="?page=simpan_user" method="post">
                <div class="form-group">
                    <label>Masukkan Nama User</label>
                    <input type="text" name="nama_user" class="form-control" placeholder="Nama User ea">
                </div>
                <div class="form-group">
                    <label>Masukkan E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="Email ea">
                </div>
                <div class="form-group">
                    <label>Masukkan Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password ea">
                </div>
                <div class="form-group">
                    <label>Masukkan Role</label>
                    <select name="id_role" class="form-control">
                        <?php
                        while($row=mysqli_fetch_assoc($result_role)){
                        echo"<option value='".$row['id_role'],"'>".$row['nama_role']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
        </div>
    </div>
</div>