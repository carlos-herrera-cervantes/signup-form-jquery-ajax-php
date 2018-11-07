//#region snippet_UpdateBiography
function add_bio(bio) {
    var bio = $.trim(bio);

    if (bio.length == "") {
        $(".bio-error").html("Biography is required");
    }
    else {
        $.ajax({
            type: 'POST',
            url: '../controllers/userController.php?bio=true',
            data: {'bio': bio},
            dataType: 'JSON',
            success: function(feedback) {
                if (feedback['error'] == 'success') {
                    location = 'index.php';
                }
                else {
                    console.log("Error");
                }
            }
        });
    }
}
//#endregion

//#region snippet_UpdateFacebookAccount
function add_facebook_account(facebook) {
    var facebook = $.trim(facebook);
    var facebookURL = /^(http|https)\:(\/\/)(www)\.facebook\.com(\/)[a-zA-Z0-9]+$/;
    if (facebook.length == "") {
        $(".facebook-error").html("Facebook is required");
    }
    else if (facebookURL.test(facebook)) {
        $.ajax({
            type: 'POST',
            url: '../controllers/userController.php?add_facebook=true',
            data: {'facebook': facebook},
            dataType: 'JSON',
            success: function(feedback) {
                if (feedback['error'] == 'success') {
                    location = 'index.php';
                }
            }
        });
    }
    else {
        $(".facebook-error").html("Facebook is invalid");
    }
}
//#endregion

//#region snippet_UpdateFacebookAccount
function UpdateLinkedin(linkedin) {
    var linkedin = $.trim(linkedin);
    var linkedinURL = /^(http|https)\:(\/\/)(www)\.linkedin\.com(\/)[a-zA-Z0-9]+$/;
    if (linkedin.length == "") {
        $(".linkedin-error").html("Linkedin is required");
    }
    else if (linkedinURL.test(linkedin)) {
        $.ajax({
            type: 'POST',
            url: '../controllers/userController.php?add_linkedin=true',
            data: {'linkedin': linkedin},
            dataType: 'JSON',
            success: function(feedback) {
                if (feedback['error'] == 'success') {
                    location = 'index.php';
                }
            }
        });
    }
    else {
        $(".linkedin-error").html("Linkedin is invalid");
    }
}
//#endregion

//#region snippet_UpdatePassword
function UpdatePassword(currentPassword, newPassword) {
    var currentPassword = $.trim(currentPassword);
    var newPassword = $.trim(newPassword);
    
    if (currentPassword.length == "") {
        $(".current-password-error").html("The current password is required");
    }
    else {
        $(".current-password-error").html("");
    }
    
    if (newPassword.length == "") {
        $(".new-password-error").html("The new password is required");
    }
    else {
        $(".new-password-error").html("");
    }
    
    if (currentPassword.length != "" && newPassword.length != "") {
        $.ajax({
            type: 'POST',
            url: '../controllers/userController.php?password=true',
            data: {
                'currentPassword': currentPassword,
                'newPassword': newPassword
            },
            dataType: 'JSON',
            success: function(feedback) {
                if (feedback['error'] == 'success') {
                    location = 'index.php';
                }
                else if (feedback['error'] == 'pattren') {
                   $(".new-password-error").html(feedback['message']);
                }
                else if (feedback['error'] == 'currentPasswordWrong') {
                    $(".new-password-error").html(feedback['message']);
                }
            }
        });
    }
}
//#endregion

//#region snippet_UpdateName
function UpdateName(name) {
    var name = $.trim(name);

    if (name.length == "") {
        $(".name-error").html("Name is required");
    }
    else {
        $(".name-error").html("");
    }
    if (name.length != "") {
        $.ajax({
            type: 'POST',
            url: '../controllers/userController.php?name=true',
            data: { 'name': name },
            dataType: 'JSON',
            success: function(feedback) {
                if (feedback['error'] == 'success') {
                    location = 'index.php';
                }
                else if (feedback['error'] == 'pattren') {
                   $(".name-error").html(feedback['message']);
                }
            }
        });
    }
}
//#endregion

//#region snippet_UpdateAddress
function UpdateAddress(address) {
    var address = $.trim(address);

    if (address.length == "") {
        $(".address-error").html("Address is required");
    }
    else {
        $.ajax({
            type: 'POST',
            url: '../controllers/userController.php?address=true',
            data: { 'address': address },
            dataType: 'JSON',
            success: function(feedback) {
                if (feedback['error'] == 'success') {
                    location = 'index.php';
                }
                else if (feedback['error' == 'error']) {
                    $(".address-error").html(feedback['message']);
                }
            }
        });
    }
}
//#endregion