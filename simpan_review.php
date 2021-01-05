<?php 
require_once "koneksi.php";
if (defined("GELANG")===false)
{
    die("Anda tidak boleh membuka halaman ini secara langsung!");
}
if(isset($_POST['rating'])){
    $rating=$_POST['rating'];
}else{
    $rating=0;
}

$isi_review=$_POST['isi_review'];
$user=$_SESSION['id_user'];
$novel=$_SESSION['novel'];
if(isset($_GET['id']))
{
    $now=date("Y-m-d H:i:s");
    $id=$_GET['id'];
    $sql="UPDATE review SET isi_review='$isi_review',rating='$rating',updated_at='$now' WHERE id_review='$id'";
    mysqli_query($conn,$sql);
}else
{
    $now=date("Y-m-d H:i:s");
    $sql="INSERT INTO review (isi_review,rating,id_user,id_novel,created_at,updated_at,soft_delete) 
    VALUES ('$isi_review','$rating','$user','$novel','$now','$now',0)";
    mysqli_query($conn,$sql);
}
echo "<script>
window.location.replace('index.php?page=novel');
</script>";
?>