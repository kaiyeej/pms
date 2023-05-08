<?php

session_start();
if (isset($_SESSION["pms_status"])) {
    header("location:homepage");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Juancoder IT Solutions</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">

    <script src="assets/modules/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="assets/img/logo.png" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" id="frm_login" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Username</label>
                                        <input id="username" type="text" class="form-control" name="input[username]" tabindex="1" required="" autofocus="">
                                        <div class="invalid-feedback">
                                            Please fill in your username
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control" name="input[password]" tabindex="2" required="">
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" id="btn_submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright © Juancoder IT Solutions <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        $("#frm_login").submit(function(e) {
            e.preventDefault();
            var url = "./controllers/sql.php?c=Users&q=login";
            var data = $("#frm_login").serialize();
            $("#btn_submit").prop('disabled', true);
            $("#btn_submit").html("<span class='fa fa-spinner fa-spin'></span> Verifying ...");
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    var json = JSON.parse(data);

                    if (json.data != 0) {
                        swal("Success!", "All is cool! Signed in successfully", "success");
                        window.location = "homepage";
                    } else {
                        swal("Login Failed!", 'Your username or password is incorrect. Please try again.', "warning");
                    }

                    console.log(json.data);
                    $("#btn_submit").html("Save");
                    $("#btn_submit").prop('disabled', false);
                }
            });


        });
    </script>

    <!-- General JS Scripts -->
    <script src="assets/modules/popper.js"></script>
    <script src="assets/modules/tooltip.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/modules/moment.min.js"></script>
    <script src="assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="assets/modules/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>