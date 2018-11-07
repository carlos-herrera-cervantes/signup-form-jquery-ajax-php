<?php include 'models/connection.php' ?>
<?php
    if (isset($_SESSION['userId'])) {
        header("location:profile/index.php");
    }
 ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1 shrink-to-fit=no" />
        
        <title>My Transformation</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />        
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="icon" href="assets/images/icono-copia.png" type="image/png" /> 
        
    </head>
    <body>
        <video autoplay muted loop id="myvideo">
            <source src="assets/images/video.mp4" type="video/mp4" />
        </video>
        <!--region snippet_navbar-->
        <?php include "nav.php"; ?>
        <!--endregion-->
        
        <?php if (isset($_SESSION['unutherrized'])): ?>
            <div class="alert alert-danger text-center all-msg">
                <strong><?php echo $_SESSION['unutherrized']; ?></strong>
            </div>
        <?php  endif ?>
        <?php unset($_SESSION['unutherrized']); ?>
        
        <!--region snippet_Body-->
        <div class="showcase">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 content">
                        <?php if (isset($_SESSION['onlineUser'])): ?>
                            <h4>Goodbye <span class="online"><?php echo $_SESSION['onlineUser']; ?></span></h4>
                            <p><i class="fa fa-thumbs-o-up"></i></p>
                        <?php else: ?>
                            <h1>Welcome</h1>
                            <hr />
                            <p>This is a test site.</p>
                        <?php endif; ?>
                        <?php unset($_SESSION['onlineUser']); ?>
                    </div>
                    <div class="col-md-4 content">
                        <!--region snippet_Signup-->
                        <div class="signup-cover">
                            <div class="card">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <form id="signupUser">
                                        <div class="form-group show-progress">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" />
                                            <div class="name-error error"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" />
                                            <div class="email-error error"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" />
                                            <div class="password-error error"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password" />
                                            <div class="confirm-error error"></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="submit" class="btn btn-block form-btn">Create account</button>
                                        </div>
                                        <div class="form-group">
                                            <a href="#" id="login">Already have an account?</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="form-icon">
                                    <div class="label-heading">
                                        <h5>Create new account</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--endregion-->
                        <!--region snippet_Login-->
                        <div class="login-cover">
                            <div class="card">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <form id="formLogin">
                                        <div class="form-group">
                                            <div class="loginError error">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="loginEmail" id="loginEmail" class="form-control" placeholder="Enter email" />
                                            <div class="loginEmail-error error"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="loginPassword" id="loginPassword" class="form-control" placeholder="Enter password" />
                                            <div class="loginPassword-error error"></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="loginSubmit" class="btn btn-block form-btn">Login</button>
                                        </div>
                                        <div class="form-group">
                                            <a href="#" id="signup">Create a new account</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="form-icon">
                                    <div class="label-heading">
                                        <h5>User login</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--enregion-->
                    </div>
                </div>
            </div>
        </div>
        <!--endregion-->
        
        <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/simple.js"></script>
        <script type="text/javascript" src="assets/js/signup.js"></script>
        <script type="text/x-javascript" src="assets/js/login.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                setTimeout(function() {
                    $(".all-msg").fadeOut("slow");
                }, 2000);
            })
        </script>
    </body>
</html>