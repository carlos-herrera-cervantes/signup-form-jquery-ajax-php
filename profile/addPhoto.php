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
        
        <div class="container contents">
            <div class="row">
                <div class="col-md-4">
                    <div class="left-area">
                        <?php UserProperties(); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="right-area">
                        <h4>Update photo</h4>
                        <div class="form-group">
                            <?php UpdatePhoto(); ?>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="file" class="form-control profile-input" required />
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update picture" name="picture" class="btn btn-success" />
                            </div>
                        </form>
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
        <script type="text/javascript" src="../assets/js/profile.js"></script>
    </body>
</html>