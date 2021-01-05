<?php
require_once "koneksi.php";
if (defined("GELANG")===false)
{
    die("Anda tidak boleh membuka halaman ini secara langsung!");
}
$sql="select * from genres where soft_delete=0";
$result=mysqli_query($conn,$sql);

//Apakah punya kewenangan
$cek_hapus=cek_akses("hapus_genre",$conn);
$cek_edit=cek_akses("form_edit_genre",$conn);
$cek_simpan=cek_akses("simpan_genre",$conn);

?>
<div class="container">
    <br>
    <?php
    $tambah=[];
    if($cek_simpan){
    $tambah[]="<a href='?page=form_genre' class='btn btn-primary'>Tambah Baru</a>";
    }
    echo implode("",$tambah);
    ?>
    <br>
    <br>
    <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <tr>
                    <th>No. </th>
                    <th>Nama Genre</th>
                    <?php
                    if($cek_edit || $cek_hapus){
                    echo "<th>Aksi</th>";
                    }
                    ?>
                </tr>
                <?php
            if(mysqli_num_rows($result)>0)
            {

                $no=0;
                while($row=mysqli_fetch_assoc($result))
                {
                    $no++;
                    echo "<tr>
                    <td>".$no."</td>
                    <td>".$row['nama_genre']."</td>";
                    if($cek_edit||$cek_hapus){
                    echo "<td>";
                    $btn=[];
                    if($cek_edit){
                    $btn[]="<a href='?page=form_edit_genre&id=".$row['id_genre']."'>Edit</a>";
                    }
                    if($cek_hapus){
                    $btn[]="<a style='color:red;' href='?page=hapus_genre&id=".$row['id_genre']."'>Hapus</a>";
                    }
                    echo implode(" | ", $btn);
                    echo"</td>
                    </tr>";
                    }
                }
            }
            ?>
            </table>
        </div>
    </div>
</div>