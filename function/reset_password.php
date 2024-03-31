<?php 
    require '../config/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include '../includes/links.php';
    ?>
    <title>PASSWORD RESET BRMS</title>
</head>
<body>
    <?php 
        include '../includes/navbar.php';
    ?>
    <div class="container container-fluid p-5">
        <div class="row">
            <div class="col-3">
                <!-- filler columns -->
            </div>
            <div class="col">
                <h3 class="text-center text-danger">Reset Your Password Here</h3>
                <div class="border-bottom fw-bold text-success"></div>
                <?php 
                    $verification_code = $_GET['verification_code'];
                    $selectAdminQuery = "SELECT * FROM admin_account WHERE verification_code = '$verification_code' ";
                    $selectAdminResult = mysqli_query($conn, $selectAdminQuery);

                    if($selectAdminResult->num_rows>0){
                        $admin = $selectAdminResult->fetch_assoc();
                ?>
                    <form action="" method="post" class="text-center mt-3 px-5">
                        <label for="" class="form-label fw-bold text-primary">EMAIL</label>
                        <input type="text" class="form-control mb-3 text-center fw-bold" value="<?= $admin['admin_email'] ?>" readonly>
                        <label for="" class="form-label fw-bold text-primary">USERNAME</label>
                        <input type="text" class="form-control mb-3 text-center fw-bold" value="<?= $admin['admin_username'] ?>" readonly>
                        <label for="password1" class="form-label fw-bold text-primary">NEW PASSWORD</label>
                        <input type="password" id="password1" name="password1" class="form-control mb-3 text-center" onkeyup="comparePasswords()" required>
                        <label for="password2" class="form-label fw-bold text-primary">CONFIRM NEW PASSWORD</label>
                        <input type="password" id="password2" name="password2" class="form-control mb-3 text-center" onkeyup="comparePasswords()" required>

                        <!-- error message -->
                        <p id="passwordError" style="color: red; display: none;">Passwords do not match!</p>
                        <button class="btn btn-outline-danger float-end">Reset Password</button>
                    </form>
                <?php 
                    }
                ?>
            </div>
            <div class="col-3">
                <!-- filler columns -->
            </div>
        </div>
    </div>
    <?php 
        include '../includes/scripts.php';
    ?>
    <script>
    function comparePasswords() {
        var password1 = document.getElementById("password1").value;
        var password2 = document.getElementById("password2").value;
        
        var error = document.getElementById("passwordError");
        
        if (password1 === password2) {
            error.style.display = "none";
        } else {
            error.style.display = "block";
        }
    }
</script>
</body>
</html>