<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle">Update password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <input type="password" class="form-control profile-input" id="PasswordUser" placeholder="Type your current password here" />
                        <div class="current-password-error error">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control profile-input" id="ConfirmPasswordUser" placeholder="Type your new password here" />
                        <div class="new-password-error error">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="UpdatePassword(this.form.PasswordUser.value, this.form.ConfirmPasswordUser.value);">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>