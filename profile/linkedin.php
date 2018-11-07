<?php 
    $userId = $_SESSION['userId'];
    $query = $pdo->prepare("SELECT LinkedIn FROM users WHERE Id = ?");
    $query->execute(array($userId));
    $r = $query->fetch(PDO::FETCH_OBJ);
    
    $linkedIn = $r->LinkedIn;
?>

<div class="modal fade" id="linkedin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle">Add linkedin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <input type="text" class="form-control profile-input" id="LinkedinUser" placeholder="Type your linkedin account" value="<?php if(isset($linkedIn)): echo $linkedIn; endif; ?>" />
                        <div class="linkedin-error error">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="UpdateLinkedin(this.form.LinkedinUser.value);">Add/Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>