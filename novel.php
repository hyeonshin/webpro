<?php 
require_once "koneksi.php";
if (defined("GELANG")===false) {
    die("Anda tidak boleh membuka halaman ini secara langsung!");
} 
$sql="SELECT novel.id_novel, novel.judul_novel, novel.file_cover,novel.file_novel, novel.sinopsis, novel.tgl_terbit, user.nama_user, IFNULL(ROUND(AVG(review.rating),1),0) as rating, IFNULL(COUNT(review.id_review),0) as jml_review
FROM novel
JOIN user ON novel.id_user=user.id_user
LEFT JOIN review ON novel.id_novel=review.id_novel
WHERE novel.soft_delete=0
GROUP BY novel.id_novel";
$result=mysqli_query($conn, $sql);
//Nampilin Bintang
function Bintang($rating){
	$html='';
	for( $x = 0; $x < 5; $x++ )
    {
        if( floor($rating)-$x >= 1 )
        {$html.= '<i class="fa fa-star" style="color:#ffc107;"></i>'; }
        elseif( $rating-$x > 0 )
        {$html.= '<i class="fas fa-star-half-alt" style="color:#ffc107;"></i>'; }
        else
        {$html.= '<i class="far fa-star"></i>'; }
    }
		return $html;
}?>

<div class="container">
    <br>
    <a href="?page=form_novel" class="btn btn-primary">Tambah baru</a>
    <br>
    <br>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-responsive-md table-borderless table-hover text-center">
                    <tr>
                        <th>No. </th>
                        <th>Judul Novel</th>
                        <th>File Cover</th>
                        <th>Sinopsis</th>                               
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                    <?php 
        if(mysqli_num_rows($result)>0){
            $no=0;
            while($row=mysqli_fetch_assoc($result))
            {
                $no++;
                $bintang=bintang($row['rating']);
                echo "<tr>
                <td>".$no."</td>
                <td>".$row['judul_novel']."</td>
                <td align='center'><img src='".$row['file_cover']."' class='img-thumbnail' width='1000px' height='500px'></td>
                <td>".$row['sinopsis']."</td>
                
                <td style='width:125px;'><p style='font-size:15px;'>".bintang($row['rating'])." (".$row['rating'].")</p>
                ";
                $sql="SELECT * FROM review WHERE id_novel=".$row['id_novel'];
                $rreview=mysqli_query($conn,$sql);
                if(mysqli_num_rows($rreview)>0){
                echo"<a data-id='".$row['id_novel']."' class='review' style='cursor: pointer;'><span class='fa fa-eye'></span></a>";
                }
                echo "<td>
                    <a class='btn btn-primary' href='?page=baca_novel&id=".$row['id_novel']."'><span class='fa fa-book-open'></span></a>
                    <a class='btn btn-success' href='?page=form_edit_novel&id=".$row['id_novel']."'><span class='fa fa-pen'></span></a>
                    <a class='btn btn-danger' href='?page=hapus_novel&id=".$row['id_novel']."'><span class='fa fa-trash'></span></a>
                </td>
                </tr>
                ";
                }
                } ?>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="review" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
            </div>
            <div class="modal-footer" style="border-width:5px;">
                <button type="button" style="width:100%;" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>