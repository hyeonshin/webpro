<?php
function Bintang($rating){
	$html='';
	for( $x = 0; $x < 5; $x++ )
    {
        if( floor($rating)-$x >= 1 )
        {$html.= '<i class="fa fa-star" style="color:#ffc107"></i>'; }
        elseif( $rating-$x > 0 )
        {$html.= '<i class="fas fa-star-half-alt" style="color:#ffc107"></i>'; }
        else
        {$html.= '<i class="far fa-star"></i>'; }
    }
		return $html;
}
require_once "koneksi.php";
$no=0;
$novelid = 0;
if(isset($_POST['novelid'])){
    $novelid = mysqli_real_escape_string($conn,$_POST['novelid']);
}
$sql = "SELECT  review.updated_at as wktu,review.id_review, user.nama_user,review.rating,review.isi_review,novel.judul_novel,review.soft_delete
FROM review
JOIN user ON review.id_user=user.id_user
JOIN novel ON review.id_novel=novel.id_novel
WHERE review.soft_delete=0 AND review.id_novel=".$novelid;
$result = mysqli_query($conn,$sql);
$judul=mysqli_query($conn,$sql);
$response="";

if(mysqli_num_rows($result)>0){
$row=mysqli_fetch_assoc($judul);
$response .= "<h3 class='text-center'>Review Novel
                ".ucwords($row['judul_novel'])."
            </h3>
            <div style='border-bottom: solid; margin-bottom: 5px;'></div>
            <div class=' table-responsive'>
            <table class='table table-bordered' width='100%'>
                <tr class='text-center'>
                    <th>No.</th>
                    <th>User</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Waktu</th>
                </tr>";
}
while( $row = mysqli_fetch_assoc($result) ){
    $no++;
    $user = $row['nama_user'];
    $review = $row['isi_review'];
    $rating = $row['rating'];
    $waktu=$row['wktu'];
    $response .="<tr>
                    <td style='width:100px;'>".$no."</td>
                    <td>".$user."</td>
                    <td>".$review."</td>
                    <td style='width:125px;'>".bintang($rating)."</td>
                    <td style='width:200px;'>".$waktu."</td>
                </tr>";
}
$response .= "</table>
            </div>";
echo $response;
exit;
?>
<script>
window.location.replace('index.php?page=genre');
</script>