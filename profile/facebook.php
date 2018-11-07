<?php 
    $userId = $_SESSION['userId'];
    $query = $pdo->prepare("SELECT Facebook FROM users WHERE Id = ?");
    $query->execute(array($userId));
    $r = $query->fetch(PDO::FETCH_OBJ);
    
    $facebook = $r->Facebook;
?>

<div class="modal fade" id="facebook" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle">Add facebook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <input type="text" class="form-control profile-input" id="add_facebook" placeholder="Type your facebook account" value="<?php if(isset($facebook)): echo $facebook; endif; ?>" />
                        <div class="facebook-error error">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="add_facebook_account(this.form.add_facebook.value);">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>