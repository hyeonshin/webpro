<?php 
require_once "koneksi.php";
if (defined("GELANG")===false){
    die("anda tidak dapat membuka halaman ini secara langsung!");
} 
?>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="?page=proses_login" method="post">
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>