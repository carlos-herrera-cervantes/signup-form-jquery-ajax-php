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

                <?php 
                    $userId = $_SESSION['userId'];
                    $query = $pdo->prepare("SELECT Address FROM users WHERE Id = ?");
                    $query->execute(array($userId));
                    $r = $query->fetch(PDO::FETCH_OBJ);
                    
                    $address = $r->Address;
                ?>

                <div class="col-md-8">
                    <div class="right-area">
                        <h4>Address</h4>
                        <div class="form-group">

                        </div>
                        <form>
                            <div class="form-group">
                                <input id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" type="text" class="form-control profile-input"
                                value="<?php if(isset($address)) : echo $address; endif; ?>"></input>
                                <div class="address-error error">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" name="picture" class="btn btn-success" onclick="UpdateAddress(this.form.autocomplete.value);">Save</button>
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
        <script type="text/x-javascript" src="../assets/js/profile.js"></script>
        <script>
            // This example displays an address form, using the autocomplete feature
            // of the Google Places API to help users fill in the information.

            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

            var placeSearch, autocomplete;
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
            };

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                    {types: ['geocode']});

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();

                for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
                for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
                }
            }

            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
                }
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initAutocomplete"
                async defer></script>
    </body>
</html>