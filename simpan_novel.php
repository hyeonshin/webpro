<?php
// filename: simpan_novel.php
if(defined("GELANG") === false)
{
    // tidak punya gelang
    die("Anda tidak boleh membuka halaman ini secara langsung!");
}

$judul_novel = $_POST['judul_novel'];
$sinopsis = $_POST['sinopsis'];
$tgl_terbit = $_POST['tgl_terbit'];
$genre = $_POST['genre'];
$id_user=$_SESSION['id_user'];
// file
$files = $_FILES;

// definisikan tempat upload
$folder = 'upload/';

foreach($files as $field => $data)
{
    $nama_asli = $data['name'];
    $ex_nama_asli = explode('.',$nama_asli);
    $extension = array_pop($ex_nama_asli);
    
    // file_cover_{timestamp}.{ext}
    $nama_file = $field.'_'.time().'.'.$extension;
    
    $ret = move_uploaded_file($data['tmp_name'],$folder.$nama_file);
    
    // $file_cover/$file_novel
    $$field = $folder.$nama_file;
}

if(isset($_GET['id']))
{
    // edit data
    //$id = $_GET['id'];
    //$sql = "UPDATE genre SET nama_genre='$genre' where id_genre='$id'";
}
else
{
    // new data
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO novel (judul_novel,sinopsis,tgl_terbit,file_cover,file_novel,id_user,created_at,updated_at,soft_delete) 
    VALUES ('$judul_novel','$sinopsis','$tgl_terbit','$file_cover','$file_novel','$id_user','$now','$now',0)";
    
    mysqli_query($conn, $sql);
    
    // simpan genre
    $last_id = mysqli_insert_id($conn);
    foreach($genre as $g)
    {
        $sql = "INSERT INTO novel_genre (id_novel,id_genre,created_at,updated_at,soft_delete) 
        VALUES ($last_id,$g,'$now','$now',0)";
        
        mysqli_query($conn,$sql);
    }
}

// redirect ke halaman list
echo "<script>
    window.location.replace('index.php?page=novel');
</script>";