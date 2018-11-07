<?php include '../controllers/userController.php'; ?>
<?php if (!isset($_SESSION['userId'])): ?>
    <?php $_SESSION['unutherrized'] = "Please login"; ?>
    <?php header("location:../index.php"); ?>
<?php endif; ?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1 shrink-to-fit=no" />
        
        <title>Profile</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />        
        <link rel="stylesheet" href="../assets/css/style.css" />
        <link rel="stylesheet" href="../assets/css/profile.css" />
        <link rel="icon" href="../assets/images/icono-copia.png" type="image/png" />
    </head>
    <body>
        <!--region snippet_navbar-->
        <?php include "../nav.php"; ?>
        <!--endregion-->
        
        <!--#region snippet_SuccessUpdatePgoto-->
        <?php if (isset($_SESSION['successImage'])): ?>
            <div class="alert alert-success all-msg text-center success-msg">
                <?php echo $_SESSION['successImage']; ?>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['successImage']); ?>
        <!--#endregion-->

        <!--#region snippet_SuccessUpdateBiography-->
        <?php if (isset($_SESSION['biographySuccess'])): ?>
            <div class="alert alert-success all-msg text-center success-msg">
                <?php echo $_SESSION['biographySuccess']; ?>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['biographySuccess']); ?>
        <!--#endregion-->
        
        <!--#region snippet_SuccessUpdateFacebook-->
        <?php if (isset($_SESSION['facebookSuccess'])): ?>
            <div class="alert alert-success all-msg text-center success-msg">
                <?php echo $_SESSION['facebookSuccess']; ?>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['facebookSuccess']); ?>
        <!--#endregion-->
        
        <!--#region snippet_SuccessUpdateLinkedin-->
        <?php if (isset($_SESSION['linkedinSuccess'])): ?>
            <div class="alert alert-success all-msg text-center success-msg">
                <?php echo $_SESSION['linkedinSuccess']; ?>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['linkedinSuccess']); ?>
        <!--#endregion-->
        
        <!--#region snippet_SuccessUpdatePassword-->
        <?php if (isset($_SESSION['passwordSuccess'])): ?>
            <div class="alert alert-success all-msg text-center success-msg">
                <?php echo $_SESSION['passwordSuccess']; ?>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['passwordSuccess']); ?>
        <!--#endregion-->

        <!--#region snippet_SuccessUpdateName-->
        <?php if (isset($_SESSION['nameSuccess'])): ?>
            <div class="alert alert-success all-msg text-center success-msg">
                <?php echo $_SESSION['nameSuccess']; ?>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['nameSuccess']); ?>
        <!--#endregion-->

        <!--#region snippet_SuccessUpdateAddress-->
        <?php if (isset($_SESSION['addressSuccess'])): ?>
            <div class="alert alert-success all-msg text-center success-msg">
                <?php echo $_SESSION['addressSuccess']; ?>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['addressSuccess']); ?>
        <!--#endregion-->
        
        <div class="container contents">
            <div class="row">
                <div class="col-md-4">
                    <div class="left-area">
                        <?php UserProperties(); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="right-area">
                        <div>
                            <div class="col-md-3">
                            <h5>Information</h5>
                            </div>
                            <div class="col-md-9">
                                <?php PercentProfile(); ?>
                            </div>
                        </div>
                        <hr />

                        <?php GetAllInformation(); ?>
                        
                        <!--#region snippet_ModalWIndow-->
                        <?php include 'biography.php'; ?>
                        <?php include 'facebook.php'; ?>
                        <?php include 'linkedin.php'; ?>
                        <?php include 'name.php'; ?>
                        <?php include 'password.php'; ?>
                        <!--#endregion-->
                        
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
        <script type="text/x-javascript" src="../assets/js/profile.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                setTimeout(function() {
                    $(".all-msg").fadeOut("slow");
                }, 2000);
            })
        </script>
    </body>
</html>