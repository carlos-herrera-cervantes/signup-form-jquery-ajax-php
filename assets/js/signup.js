//region snippet_DocumentReady
$(document).ready(function() {
    
    //region snippet_Variables
    var name            = "";
    var email           = "";
    var password        = "";
    var confirmPassword = "";
    //endregion
    
    //region snippet_NameValidation
    $("#name").focusout(function() {
        
        var store = $.trim($("#name").val());
        var nameToValidate = /^[a-z ]+$/i;
        
        if (store.length == "") {
            $(".name-error").html("Name is required");
            $("#name").addClass("border-red");
            $("#name").removeClass("border-purple");
            name = "";
        }
        else if (nameToValidate.test(store)) {
            $(".name-error").html("");
            $("#name").addClass("border-purple");
            $("#name").removeClass("border-red");
            name = store;
        }
        else {
            $(".name-error").html("Integer is not allowed");
            $("#name").addClass("border-red");
            $("#name").removeClass("border-purple");
            name = "";
        }
    })
    //endregion
    
    //region snippet_EmailValidation
    $("#email").focusout(function() {
        
        var store = $.trim($("#email").val());
        var emailToValidate = /^[a-z]+[0-9a-zA-Z_\.]*@[a-z_]+\.[a-z]+$/;
        
        if (store.length == "") {
            $(".email-error").html("Email is required");
            $("#email").addClass("border-red");
            $("#email").removeClass("border-purple");
            email = "";
        }
        else if (emailToValidate.test(store)) {
            $.ajax({
                type: 'POST',
                url: 'controllers/userController.php',
                dataType: 'JSON',
                beforeSend: function() {
                    $(".email-error").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>')
                },
                data: {'checkEmail': store},
                success: function(feedback) {
                    setTimeout(function() {
                        if (feedback['error'] == 'emailSuccess') {
                        $(".email-error").html("<div class='text-success'><i class='fa fa-check-circle'></i>The email is available</div>");
                        $("#email").addClass("border-purple");
                        $("#email").removeClass("border-red");
                        email = store;
                        }
                        else if (feedback['error'] == 'emailFail') {
                            $(".email-error").html("This email already exists");
                            $("#email").addClass("border-red");
                            $("#email").removeClass("border-purple");
                            email = "";
                        }
                    }, 3000);
                }
            });
        }
        else {
            $(".email-error").html("Email is invalid");
            $("#email").addClass("border-red");
            $("#email").removeClass("border-purple");
            email = "";
        }
    })
    //endregion
    
    //region snippet_PasswordValidation
    $("#password").focusout(function() {
        
        var store = $.trim($("#password").val());
        var passwordToValidate = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/;
        
        if(store.length == "") {
            $(".password-error").html("The password is required");
            $("#password").addClass("border-red");
            $("#password").removeClass("border-purple");
            password = "";
        }
        else if (passwordToValidate.test(store)) {
            $(".password-error").html("<div class='text-success'><i class='fa fa-check-circle'></i>OK</div>");
            $("#password").addClass("border-purple");
            $("#password").removeClass("border-red");
            password = store;
        }
        else {
            $(".password-error").html("8 charactrs or longer. Combine upper and lowercase letters and numbers");
            $("#password").addClass("border-red");
            $("#password").removeClass("border-purple");
            password = "";
        }
    })
    //endregion
    
    //region snoppet_PasswordConfirm
    $("#confirmPassword").focusout(function() {
        
        var store =$.trim($("#confirmPassword").val());
        
        if (store.length == "") {
            $(".confirm-error").html("Confirm password is required");
            $("#confirmPassword").addClass("border-red");
            $("#confirmPassword").removeClass("border-purple");
            confirmPassword = "";
        }
        else if (store != password) {
            $(".confirm-error").html("Password is not matched");
            $("#confirmPassword").addClass("border-red");
            $("#confirmPassword").removeClass("border-purple");
            confirmPassword = "";
        }
        else {
            $(".confirm-error").html("<div class='text-success'><i class='fa fa-check-circle'></i>OK</div>");
            $("#confirmPassword").addClass("border-purple");
            $("#confirmPassword").removeClass("border-red");
            confirmPassword = store;
        }
    })
    //endregion
    
    //region snippet_EventCreateAccount
    $("#submit").click(function() {
        if (name.length == "" ) {
            $(".name-error").html("Name is required");
            $("#name").addClass("border-red");
            $("#name").removeClass("border-purple");
            name = "";
        }
        
        if (email.length == "") {
            $(".email-error").html("Email is required");
            $("#email").addClass("border-red");
            $("#email").removeClass("border-purple");
            email = "";
        }
        
        if (password.length == "") {
            $(".password-error").html("The password is required");
            $("#password").addClass("border-red");
            $("#password").removeClass("border-purple");
            password = "";
        }
        
        if (confirmPassword.length == "") {
            $(".confirm-error").html("Confirm password is required");
            $("#confirmPassword").addClass("border-red");
            $("#confirmPassword").removeClass("border-purple");
            confirmPassword = "";
        }
        
        if (name.length != "" && email.length != "" && password.length != "" && confirmPassword.length != "") {
            $.ajax({
                type: 'POST',
                url: 'controllers/userController.php?signup=true',
                data: $("#signupUser").serialize(),
                dataType: 'JSON',
                beforeSend: function() {
                    $(".show-progress").addClass('progress')
                },
                success: function(feedback) {
                    setTimeout(function() {
                        if (feedback['error'] == 'success') {
                            location = feedback.message;
                        }
                    }, 3000);
                }
            });
        }
    })
    //endregion
})
//endregion