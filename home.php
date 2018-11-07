<?php session_start(); ?>
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
        <!--#region snippet_Navbar-->
        <?php include "nav.php"; ?>
        <!--#endregion-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="success-area">
                        <?php if (isset($_SESSION['userName'])): ?>
                            <?php echo "<i class='fa fa-check-circle'></i>Welcome ". $_SESSION['userName']. 
                            " Now login <a href='index.php'>Login</a>";
                            ?>
                        <?php endif; ?>
                        <?php unset($_SESSION['userName']); ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/x-javascript">
            $(document).ready(function() {
                $(".success-area").fadeOut();
                $(".success-area").fadeIn(5000);
            })
        </script>
    </body>
</html>