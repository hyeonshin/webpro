<?php
if(defined("GELANG") === false)
{
    // tidak punya gelang
    die("Anda tidak boleh membuka halaman ini secara langsung!");
}
$sql="SELECT * FROM novel WHERE soft_delete=0 AND id_novel=".$_GET['id'];
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$_SESSION['novel']=$row['id_novel'];
$novel=$row['id_novel'];
$sql2="SELECT * FROM review 
WHERE soft_delete=0 AND id_user=".$_SESSION['id_user']." AND id_novel=".$_GET['id'];
$rreview=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($rreview);
?>
<link rel="stylesheet" href="assets/css/rating.css">
<div class="container">
    <div class="row">
        <div class="col-8">
            <embed src="<?= $row['file_novel'];?>" width="100%" height="500" alt="pdf" pluginspage="">
        </div>
        <div class="col-4">
            <h3><?= $row['judul_novel']; ?></h3>
            <h5>Sinopsis</h5>
            <div style="height: 300px; overflow-y:auto;">
                <p><?= $row['sinopsis']; ?></p>
            </div>
            <?php if(mysqli_num_rows($rreview)>0) {?>
            Anda sudah memberikan review, ingin mengubah review?
            <br>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editReview">
                Ubah Review
            </button>
            <a href="?page=hapus_review&id=<?=$row2['id_review'];?>" class="btn btn-danger btn-lg">Hapus</a>
            <?php } else{?>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalReview">
                Berikan Review
            </button>
            <?php } ?>
        </div>
    </div>
</div>



<!-- MODAL EDIT REVIEW -->
<div class="modal fade" id="editReview" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100">Ubah Review</h5>
            </div>
            <div class="modal-body" id="edit">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <form action="?page=simpan_review&id=<?=$row2['id_review'];?>" method="post">
                                <div class="form-group">
                                    <label>Review</label>
                                    <textarea name="isi_review" rows="5" maxlength="250"
                                        placeholder="Masukkan isi review"
                                        class="form-control"><?=$row2['isi_review'];?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Rating</label>
                                    <br>
                                    <fieldset class="rating">
                                        <?php 
                                        $mnrtkm=['jelek bgt ☹️','b aja', 'mayan','bagus','BAGUS BANGETTT ❤️'];
                                        $a=5;
                                        while($a>=1){
                                        if($a==$row2['rating']){
                                            $checked="checked";
                                            $uwu=$mnrtkm[$a-1];
                                        }else{
                                            $checked="";
                                        }
                                        ?>
                                        <input type="radio" id="bintang<?=$a;?>" name="rating" value="<?=$a;?>"
                                            <?=$checked;?> />
                                        <label for="bintang<?=$a;?>"><?=$a;?> stars</label>
                                        <?php 
                                    $a--;
                                    } ?>
                                    </fieldset>
                                    <br>
                                    <br>
                                    <div>Menurut kamu novel ini <span class='choice'><?=$uwu?></span></div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL REVIEW-->
<div class="modal fade" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title w-100">Tulis Review</h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <form action="?page=simpan_review" method="post">
                                <div class="form-group">
                                    <label>Review</label>
                                    <textarea name="isi_review" rows="5" maxlength="250"
                                        placeholder="Masukkan isi review" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Rating</label>
                                    <br>
                                    <fieldset class="rating" required="true">
                                        <?php 
                                        $a=5;
                                        while($a>=1){
                                        ?>
                                        <input type="radio" id="star<?=$a;?>" name="rating" value="<?=$a;?>" checked />
                                        <label for="star<?=$a;?>"><?=$a;?> stars</label>
                                        <?php 
                                    $a--;
                                    } ?>
                                    </fieldset>
                                    <br>
                                    <br>
                                    <div>Menurut kamu novel ini <span class="choice">jelek bgt ☹️</span></div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="Simpan" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>