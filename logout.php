<?php 
if (defined("GELANG")===false) {
    die("anda tidak boleh membuka halaman ini secara langsung!");
}

//remove all session variables
session_unset();
//destroy the session
session_destroy();

echo "<script>
window.location.replace('index.php?page=login');
</script>";
?>