$(document).ready(function() {
    
    var email = "";
    var password = "";
    
    //#region snippet_ValidateEmail
    $("#loginEmail").focusout(function() {
        
        var store = $.trim($("#loginEmail").val());
        
        if (store.length == "") {
            $("#loginEmail").addClass("border-red");
            $("#loginEmail").removeClass("border-purple");
            $(".loginEmail-error").html("Email is required");
            email = "";
        }
        else {
            $("#loginEmail").addClass("border-purple");
            $("#loginEmail").removeClass("border-red");
            $(".loginEmail-error").html("");
            email = store;
        }
    })
    //#endregion
    
    //#region snippet_ValidatePassword
    $("#loginPassword").focusout(function() {
        
        var store = $.trim($("#loginPassword").val());
        
        if (store.length == "") {
            $("#loginPasswors").addClass("border-red");
            $("#loginPassword").removeClass("border-purple");
            $(".loginPassword-error").html("Password is required");
            password = "";
        }
        else {
            $("#loginPassword").addClass("border-purple");
            $("#loginPassword").removeClass("border-red");
            $(".loginPassword-error").html("");
            password = store;
        }
    })
    //#endregion
    
    //#region snippet_EventtLogin
    $("#loginSubmit").click(function() {
        if (email.length == "") {
            $("#loginEmail").addClass("border-red");
            $("#loginEmail").removeClass("border-purple");
            $(".loginEmail-error").html("Email is required");
            email = "";
        }
        
        if (password.length == "") {
            $("#loginPasswors").addClass("border-red");
            $("#loginPassword").removeClass("border-purple");
            $(".loginPassword-error").html("Password is required");
            password = "";
        }
        
        if (email.length != "" && password.length != "") {
            $.ajax({
                type: 'POST',
                url: 'controllers/userController.php?loginForm=true',
                data: $("#formLogin").serialize(),
                dataType: 'JSON',
                success: function(feedback) {
                    if (feedback['error'] == 'success') {
                        $("#loginPassword").addClass("border-purple");
                        $("#loginPassword").removeClass("border-red");
                        
                        $("#loginEmail").addClass("border-purple");
                        $("#loginEmail").removeClass("border-red");
                        
                        $(".loginError").addClass("progressLogin");
                        setTimeout(function() {
                            location = feedback['message'];
                        }, 2000);
                    }
                    else if (feedback['error'] == 'noPassword') {
                        $("#loginPassword").addClass("border-red");
                        $("#loginPassword").removeClass("border-purple");
                        
                        $(".loginError").html(feedback['message']);
                    }
                    else if (feedback['error'] == 'noEmail') {
                        $("#loginEmail").addClass("border-red");
                        $("#loginEmail").removeClass("border-purple");
                        
                        $(".loginError").html(feedback['message']);
                    }
                }
            }); 
        }
    })
    //#endregion
})