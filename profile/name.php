<?php 
    $userId = $_SESSION['userId'];
    $query = $pdo->prepare("SELECT Name FROM users WHERE Id = ?");
    $query->execute(array($userId));
    $r = $query->fetch(PDO::FETCH_OBJ);
    
    $name = $r->Name;
?>

<div class="modal fade" id="updateName" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle">Update name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <input type="text" class="form-control profile-input" id="NameUser" placeholder="Type your new name here" value="<?php 
                        if (isset($name)) : echo $name; endif; ?>" />
                        <div class="name-error error">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="UpdateName(this.form.NameUser.value);">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>