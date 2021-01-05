<?php 
require_once "koneksi.php";
if(defined("GELANG")===false)
{
    die("Anda tidak boleh membuka halaman ini secara langsung!");
}
$id=$_GET['id'];
$sql="SELECT * FROM user WHERE id_user=".$id;
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$sql2="SELECT * FROM `role`";
$result_role=mysqli_query($conn,$sql2)
?>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="?page=simpan_user&id=<?= $row['id_user'];?>" method="post">
                <div class="form-group">
                    <label>Masukkan Nama User</label>
                    <input type="text" name="nama_user" value="<?=$row['nama_user'];?>" class="form-control"
                        placeholder="Nama User ea">
                </div>
                <div class="form-group">
                    <label>Masukkan E-mail</label>
                    <input type="email" name="email" value="<?=$row['email'];?>" class="form-control"
                        placeholder="Email ea">
                </div>
                <div class="form-group">
                    <label>Masukkan Password</label>
                    <input type="password" name="password" value="<?=$row['password'];?>" class="form-control"
                        placeholder="Password ea">
                </div>
                <div class="form-group">
                    <label>Masukkan Role</label>
                    <select name="id_role" class="form-control">
                        <?php 
                        while($row_role=mysqli_fetch_assoc($result_role)){
                            if($row_role['id_role']==$row['id_role']){
                                $selected="selected";
                            }else{
                                $selected="";
                            }
                            $output = '<option value="'.$row_role['id_role'].'" '.$selected.'>'.$row_role['nama_role'].'</option>';
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