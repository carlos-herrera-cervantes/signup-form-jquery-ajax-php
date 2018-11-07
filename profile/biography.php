<?php 
    $userId = $_SESSION['userId'];
    $query = $pdo->prepare("SELECT Biography FROM users WHERE Id = ?");
    $query->execute(array($userId));
    $r = $query->fetch(PDO::FETCH_OBJ);

    $biography = $r->Biography;
?>

<div class="modal fade" id="biography" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle">Add biography</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="bio-error error">
                    </div>
                </div>
                <form action="">
                    <div class="form-group">
                        <textarea class="form-control profile-input" id="bio" cols="30" rows="10" placeholder="Type here">
                            <?php if(isset($biography)): echo $biography;
                            endif; ?>
                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="add_bio(this.form.bio.value);">Add/Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>