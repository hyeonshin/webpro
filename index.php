<?php 
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Novelku - Read Whatever You Want</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
        integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
            // tandai pake gelang
            define("GELANG",1);
            require_once "koneksi.php";
            // cek kalau sudah login, ambil data menu
            if(isset($_SESSION['is_login']))
            {
                // query ke tabel menu
                $sql = "SELECT * FROM menu_role AS a 
                INNER JOIN menus AS b ON a.id_menu=b.id_menu 
                WHERE a.id_role=".$_SESSION['id_role']." ORDER BY b.id_menu DESC";
                $menus = mysqli_query($conn, $sql);
            }
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <a class="navbar-brand" href="index.php">Novelku</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION['is_login'])==false){ ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Subscribe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success sign_in_button" href="?page=login">Sign In</a>
                    </li>
                    <?php } else{
                        while ($row=mysqli_fetch_assoc($menus)) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="?page='.$row['file'].'">'.$row['nama_menu'].'</a>
                        </li>';
                    } 
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" style="cursor: default;">Hai, <?= $_SESSION['nama_user'] ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger sign_in_button" href="?page=logout">Sign Out</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <?php 
    if(isset($_GET['page'])){
        //ada variable page
        $page=$_GET['page'];
        //siapkan file .php yang diinginkan
        $file_php=$page.".php";
        //cek ketersediaan file
        if (file_exists($file_php)) {
            //pengecekan login
            $kecuali=['login','proses_login'];
            if(!in_array($page,$kecuali))
            {
                if (isset($_SESSION['is_login'])==false) {
                echo "<script>
                window.location.replace('index.php?page=login');
                </script>";
                }
            else {
                //tidak ada di perkecualan dan sedang login
                $kecuali_login=['logout','default','simpan_review','review','hapus_review'];
                if(!in_array($page, $kecuali_login)){
                    $cek=cek_akses($page, $conn);
                    if ($cek==false) {
                        die("Anda tidak berhak mengakses fitur ini!");
                    }
                }
            }
        }
            //ada
            require_once $file_php;
        }else{
            //tidak ada
            require_once "404.php";
        }
    }
    else{
        require_once "default.php";
    }
    ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js"
        integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous">
    </script>

    <!-- Buat Rating -->
    <script>
    $('.rating input').change(
        function() {
            if (this.value == 1) {
                $('.choice').text('jelek bgt ☹️');
            } else if (this.value == 2) {
                $('.choice').text('b aja');
            } else if (this.value == 3) {
                $('.choice').text('mayan');
            } else if (this.value == 4) {
                $('.choice').text('bagus');
            } else {
                $('.choice').text('BAGUS BANGETTT ❤️');
            }
            // $('.choice').text(this.value + ' stars');
        }
    );
    </script>

    <!-- Buat Nampilin Review ke Modal -->
    <script>
    $(document).ready(function() {
        $('.review').click(function() {
            var novelid = $(this).data('id');
            $.ajax({
                url: 'review.php',
                type: 'post',
                data: {
                    novelid: novelid
                },
                success: function(response) {
                    $('.modal-body').html(response);
                    $('#review').modal('show');
                }
            });
        });
    });
    </script>
</body>


</html>