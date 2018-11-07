<?php
    include '../models/connection.php';
    
    //#region snippet_IsExists
    function IsExists() {
        GLOBAL $pdo;

        if (isset($_POST['checkEmail'])) {
            $email = $_POST['checkEmail'];
            $query = $pdo->prepare("SELECT email FROM users WHERE email = ?");
            $query->execute(array($email));
            
            if ($query->rowCount() == 0) {
                echo json_encode(array('error' => 'emailSuccess'));
            }
            else {
                echo json_encode(array('error' => 'emailFail', 'message' => 'This email already exists'));
            }
        }
    }

    IsExists();
    //#endregion

    //#region snippet_Create
    function Create() {
        GLOBAL $pdo;

        if (isset($_GET['signup']) && $_GET['signup'] == 'true') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            $query = $pdo->prepare("INSERT INTO users (Name, email, Password) VALUES (?, ?, ?)");
            $query->execute([$name, $email, $password]);
            
            if ($query) {
                $_SESSION['userName'] = $name;
                echo json_encode(['error' => 'success', 'message' => 'home.php']);
            }
        }
    }

    Create();
    //#endregion

    //#region snippet_Login
    function Login() {
        GLOBAL $pdo;

        if (isset($_GET['loginForm']) && $_GET['loginForm'] == 'true') {
            $email = $_POST['loginEmail'];
            $password = $_POST['loginPassword'];
            
            $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $query->execute(array($email));
            
            if ($query->rowCount() != 0) {
                $r = $query->fetch(PDO::FETCH_OBJ);
                $passwordDB = $r->Password;
                
                if (password_verify($password, $passwordDB)) {
                    $id = $r->Id;
                    $_SESSION['userId'] = $id;
                    echo json_encode(['error' => 'success', 'message' => 'profile/index.php']);
                }
                else {
                    echo json_encode(['error' => 'noPassword', 'message' => 'The password is incorrect']);
                }
            }
            else {
                echo json_encode(['error' => 'noEmail', 'message' => 'The email doesnt exists']);
            }
        }
    }

    Login();
    //#endregion

    //#region snippet_UserProperties
    function UserProperties()
    {
        GLOBAL $pdo;
        
        $id = $_SESSION['userId'];
        
        $query = $pdo->prepare("SELECT * FROM users WHERE Id = ?");
        $query->execute(array($id));
        $r = $query->fetch(PDO::FETCH_OBJ);
        
        if (empty($r->Image)) {
            $image = "<img src='images/noImage.png' class='user_img'>";
            $photo = "<a href='addPhoto.php'>Add photo <i class='fa fa-plus-circle'></i></a>";
        }
        else
        {
            $image = "<img src='images/$r->Image' class='user_img'>";
            $photo = "<a href='addPhoto.php'>Update photo <i class='fa fa-pencil'></i></a>";
        }
        if(empty($r->Biography)) {
            $biography = "<a href='#' data-target='#biography' data-toggle='modal'>Add biography <i class='fa fa-plus-circle'></i></a>";
        }
        else
        {
            $biography = "<a href='#' data-target='#biography' data-toggle='modal'>Update biography <i class='fa fa-pencil'></i></a>";
        }

        if(empty($r->Address)) {
            $address = "<a href='address.php'>Add address <i class='fa fa-plus-circle'></i></a>";
        }
        else
        {
            $address = "<a href='address.php'>Update address <i class='fa fa-pencil'></i></a>";
        }

        if (empty($r->Facebook)) {
            $facebook = "<a href='#' data-target='#facebook' data-toggle='modal'>Add facebook <i class='fa fa-plus-circle'></i></a>";
        }
        else {
            $facebook = "<a href='#' data-target='#facebook' data-toggle='modal'>Update facebook <i class='fa fa-pencil'></i></a>";
        }
        if (empty($r->LinkedIn)) {
            $linkedin = "<a href='#' data-target='#linkedin' data-toggle='modal'>Add Linkedin <i class='fa fa-plus-circle'></i></a>";
        }
        else {
            $linkedin = "<a href='#' data-target='#linkedin' data-toggle='modal'>Update Linkedin <i class='fa fa-pencil'></i></a>";
        }
        
        echo "<ul class='list-group'>
                $image
                <li class='list-group-item first-child'>$photo</li>
                <li class='list-group-item'>$biography</li>
                <li class='list-group-item'>$address</li>
                <li class='list-group-item'>$facebook</li>
                <li class='list-group-item'>$linkedin</li>
                <li class='list-group-item'><a href='#' data-target='#updatePassword' data-toggle='modal'>Update password <i class='fa fa-pencil'></i></a></li>
                <li class='list-group-item'><a href='#' data-target='#updateName' data-toggle='modal'>Update name <i class='fa fa-pencil'></i></a></li>
             </ul>";
    }
    //#endregion

    //#region snippet_UpdatePhoto
    function UpdatePhoto() {
        GLOBAL $pdo;

        $id = $_SESSION['userId'];
        if (isset($_POST['picture'])) {
            $image = $_FILES['file']['name'];
            //$tempImage = $_FILES['file']['image'];
            $store = "images/";
            $extensions = array('png', 'PNG', 'jpg', 'jpeg');
            $split = explode(".", $image);
            $imgExtension = $split[1];
            
            if (in_array($imgExtension, $extensions)) {
                move_uploaded_file($image, "$store/$image");
                $query = $pdo->prepare("UPDATE users SET Image = ? WHERE Id = ?");
                $query->execute(array($image, $id));
                if ($query) {
                    $_SESSION['successImage'] = "<i class='fa fa-check-circle'></i> Your photo is update";
                    header("location:index.php");
                }
                else {
                    echo "Sorry, something is wrong";
                }
            }
            else {
                echo "<div class='text-danger'>Invalid image extension</div>";
            }
        }
    }
    //#endregion

    //#region snippet_UpdateBiography
    function UpdateBiography() {
        GLOBAL $pdo;

        if (isset($_GET['bio']) && $_GET['bio'] == 'true') {
            $biography = $_POST['bio'];
            $userId = $_SESSION['userId'];
            $query = $pdo->prepare("UPDATE users SET Biography = ? WHERE Id = ?");
            $query->execute(array($biography, $userId));
            
            if ($query) {
                $_SESSION['biographySuccess'] = "<i class='fa fa-check-circle'></i> Your biography was update successfully";
                echo json_encode(array('error' => 'success'));
            }
            else {
                echo json_encode(array('error' => 'error'));
            }
        }
    }

    UpdateBiography();
    //#endregion

    //#region snippet_UpdateFacebook
    function UpdateFacebookAccount() {
        GLOBAL $pdo;

        if (isset($_GET['add_facebook']) && $_GET['add_facebook'] == 'true') {
            $facebook = $_POST['facebook'];
            $userId = $_SESSION['userId'];
            
            $insert = $pdo->prepare("UPDATE users SET Facebook = ? WHERE Id = ?");
            $insert->execute(array($facebook, $userId));

            if ($insert) {
                $_SESSION['facebookSuccess'] = "<i class='fa fa-check-circle'></i> Your facebook account is successfully added";
                echo json_encode(array('error' => 'success'));
            }
            else {
                echo json_encode(array('error' => 'error'));
            }
        }
    }

    UpdateFacebookAccount();
    //#endregion

    //#region snippet_UpdateFacebook
    function UpdateLinkedinAccount() {
        GLOBAL $pdo;

        if (isset($_GET['add_linkedin']) && $_GET['add_linkedin'] == 'true') {
            $linkedin = $_POST['linkedin'];
            $userId = $_SESSION['userId'];
            
            $insert = $pdo->prepare("UPDATE users SET LinkedIn = ? WHERE Id = ?");
            $insert->execute(array($linkedin, $userId));

            if ($insert) {
                $_SESSION['linkedinSuccess'] = "<i class='fa fa-check-circle'></i> Your linkedin account is successfully added";
                echo json_encode(array('error' => 'success'));
            }
            else {
                echo json_encode(array('error' => 'error'));
            }
        }
    }

    UpdateLinkedinAccount();
    //#endregion

    //#region snippet_UpdatePassword
    function UpdatePassword() {
        GLOBAL $pdo;

        if (isset($_GET['password']) && $_GET['password'] == 'true') {
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            
            $userId = $_SESSION['userId'];
            $query = $pdo->prepare("SELECT Password FROM users WHERE Id = ?");
            
            $query->execute(array($userId));
            $r = $query->fetch(PDO::FETCH_OBJ);
            $passwordDB = $r->Password;
            
            if (password_verify($currentPassword, $passwordDB)) {
                $passwordToValidate = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/";
                
                if (preg_match($passwordToValidate, $newPassword)) {
                    $newPasswordDB = password_hash($newPassword, PASSWORD_DEFAULT);
                    $update = $pdo->prepare("UPDATE users SET Password = ? WHERE Id = ?");
                    $update->execute(array($newPasswordDB, $userId));
                    
                    if ($update) {
                        $_SESSION['passwordSuccess'] = "<i class='fa fa-check-circle'></i> Your password is successfully update";
                        echo json_encode(array('error' => 'success'));
                    }
                }
                else {
                    echo json_encode(array('error' => 'pattren', 'message' => '8 charactrs or longer. Combine upper and lowercase letters and numbers'));
                }
            }
            else {
                echo json_encode(array('error' => 'currentPasswordWrong', 'message' => 'The current password is wrong'));
            }
        }
    }

    UpdatePassword();
    //#endregion

    //#region snippet_UpdateName
    function UpdateName() {
        GLOBAL $pdo;

        if (isset($_GET['name']) && $_GET['name'] == 'true') {
            $name = $_POST['name'];
            $nameToValidate = "/^[a-z ]+$/i";
            $userId = $_SESSION['userId'];
            if (preg_match($nameToValidate, $name)) {
                $query = $pdo->prepare("UPDATE users SET Name = ? WHERE Id = ?");
                $query->execute(array($name, $userId));
                if ($query) {
                    $_SESSION['nameSuccess'] = "<i class='fa fa-check-circle'></i> Your name is successfully update";
                    echo json_encode(array('error' => 'success'));
                }
            }
            else {
                echo json_encode(array('error' => 'pattren', 'message' => 'Name is invalid'));
            }
        }
    }

    UpdateName();
    //#endregion

    //#region snippet_UpdateAddress
    function UpdateAddress() {
        GLOBAL $pdo;

        if (isset($_GET['address']) && $_GET['address']) {
            $address = $_POST['address'];
            $userId = $_SESSION['userId'];

            $query = $pdo->prepare("SELECT Address FROM users WHERE Id = ?");
            $query->execute(array($userId));

            $r = $query->fetch(PDO::FETCH_OBJ);
            $addressDB = $r->Address;

            if (empty($addressDB)) {
                $update = $pdo->prepare("UPDATE users SET Address = ? WHERE Id = ?");
                $update->execute(array($address, $userId));

                if ($update) {
                    $_SESSION['addressSuccess'] = "<i class='fa fa-check-circle'></i> Your address is successfully updated";
                    echo json_encode(array('error' => 'success'));
                }
                else {
                    echo json_encode(array('error' => 'error', 'message' => 'Something went wrong'));
                }
            }
        }
    }

    UpdateAddress();
    //#endregion

    //#region snippet_GetAllInformation
    function GetAllInformation() {
        GLOBAL $pdo;

        $userId = $_SESSION['userId'];
        $query = $pdo->prepare("SELECT * FROM users WHERE Id = ?");
        $query->execute(array($userId));
        $r = $query->fetch(PDO::FETCH_OBJ);
        $name = ucwords($r->Name);

        if (empty($r->Address)) {
            $address = "<a href='address.php'>Add address</a>";
        }
        else {
            $address = $r->Address;
        }

        if(empty($r->Biography)) {
            $biography = "<a href='#' data-target='#biography' data-toggle='modal'>Add biography <i class='fa fa-plus-circle'></i></a>";
        }
        else {
            $biography = $r->Biography;
        }

        if (empty($r->Facebook)) {
            $facebook = "<a href='#' data-target='#facebook' data-toggle='modal'>Add facebook <i class='fa fa-plus-circle'></i></a>";
        }
        else {
            $facebook = "<a href='$r->Facebook' target='_blank'><i class='fa fa-facebook'></i> Connected</a>";
        }

        if (empty($r->LinkedIn)) {
            $linkedin = "<a href='#' data-target='#linkedin' data-toggle='modal'>Add Linkedin <i class='fa fa-plus-circle'></i></a>";
        }
        else {
            $linkedin = "<a href='$r->LinkedIn' target='_blank'><i class='fa fa-linkedin'></i> Connected</a>";
        }

        echo "<div class='row user-info'>
                <div class='col-md-3'>
                    <span>Name</span>
                </div>
                <div class='col-md-9'>
                    $name
                </div>
             </div>
             <div class='row user-info'>
                <div class='col-md-3'>
                    <span>Address</span>
                </div>
                <div class='col-md-9'>
                    $address
                </div>
             </div>
             <div class='row user-info'>
                <div class='col-md-3'>
                    <span>Biography</span>
                </div>
                <div class='col-md-9'>
                    $biography
                </div>
             </div>
             <div class='row user-info'>
                <div class='col-md-3'>
                    <span>Facebook</span>
                </div>
                <div class='col-md-9'>
                    $facebook
                </div>
             </div>
             <div class='row user-info'>
                <div class='col-md-3'>
                    <span>Linkedin</span>
                </div>
                <div class='col-md-9'>
                    $linkedin
                </div>
             </div>
             ";
    }
    //#endregion

    //#region snippet_PorcenteProfile
    function PercentProfile() {
        GLOBAL $pdo;

        $userId = $_SESSION['userId'];
        $query = $pdo->prepare("SELECT * FROM users WHERE Id = ?");
        $query->execute(array($userId));
        $r = $query->fetch(PDO::FETCH_OBJ);
        $_SESSION['onlineUser'] = $r->Name;

        if (!empty($r->Name)) {
            $name = 12.5;
        }
        else {
            $name = 0;
        }

        if (!empty($r->email)) {
            $email = 12.5;
        }
        else {
            $email = 0;
        }

        if (!empty($r->Password)) {
            $password = 12.5;
        }
        else {
            $password = 0;
        }

        if (!empty($r->Image)) {
            $image = 12.5;
        }
        else {
            $image = 0;
        }

        if (!empty($r->Biography)) {
            $biography = 12.5;
        }
        else {
            $biography = 0;
        }

        if (!empty($r->Facebook)) {
            $facebook = 12.5;
        }
        else {
            $facebook = 0;
        }

        if (!empty($r->LinkedIn)) {
            $linkedin = 12.5;
        }
        else {
            $linkedin = 0;
        }

        if (!empty($r->Address)) {
            $address = 12.5;
        }
        else {
            $address = 0;
        }

        if (!empty($name) && !empty($email) && !empty($password) && !empty($image) && !empty($biography) && !empty($facebook) && !empty($linkedin) && !empty($address)) {
            echo $percent = "<div class='green-per'><i class='fa fa-check-circle'></i> 100%</div>";
        }
        else {
            $percent = $name + $email + $password + $image + $biography + $facebook + $linkedin + $address;

            $split = explode(".", $percent);
            echo "<div class='orange-per'>$split[0]%</div>";
        }
    }
    //#endregion
?>