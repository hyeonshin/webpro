<?php
require_once "koneksi.php";
if (defined("GELANG")===false)
{
    die("Anda tidak boleh membuka halaman ini secara langsung!");
}
$novel=$_SESSION['novel'];
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="DELETE FROM review WHERE id_review='$id'";
    mysqli_query($conn,$sql);
}
mysqli_query($conn,$sql);
echo "<script>
window.location.replace('index.php?page=baca_novel&id=$novel');
</script>";
?>