<?php 
    include 'config/login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>BRMS</title>
</head>
<style>
    /* css for background image and card */
    body{
        background-image: url(assets/images/bg.png);
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
            width: 100%;
    }
    @media (max-width: 768px) {
    body {
        background-size: cover;
        background-attachment: fixed;
    }
}
</style>
<body>
    <div class="container p-lg-5 m-md-5 text-center align-items-center justify-content-center">
        <div class="row justify-content-center mt-5 pt-2">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <img src="assets/images/logo.png" alt="logo" class="" style="width: 150px;">
                    <!--  <h5 class="card-title fs-1 mb-5 pt-5">LOG IN</h5> -->
                        <form action="config/login.php" method="post" class="text-start px-md-5 px-sm-3 pt-5">
                            <label for="adminUsername" class="form-label fw-bold">USERNAME:</label>
                            <input type="text" class="form-control mb-3" name="adminUsername" autocomplete="off" required>
                            <label for="adminPassword" class="form-label fw-bold">PASSWORD:</label>
                            <input type="password" class="form-control" name="adminPassword" autocomplete="off" required>
                            <a href="" class="nav-link text-end pe-0 my-2 text-primary">Forgot your password?</a>
                            <button class="btn btn-danger mb-3 float-end" name="loginBtn">LOG IN</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert.js"></script>
    <?php
    if(isset($_SESSION['message']) && $_SESSION['icon'] != ''){
    ?>
    <script>
        swal({
            title: '<?php echo $_SESSION['message']?>',
            icon: '<?php echo $_SESSION['icon']?>',
            button: "OKAY",
        });
    </script>
    <?php
        unset($_SESSION['message']);
        }
    ?>
</body>

</html>