<?php
require '../config/conn.php';

/* update official here */  
if(isset($_POST['updateBtn'])){

    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $captain_name = mysqli_real_escape_string($conn, $_POST['captain_name']);
    $kagawad1 = mysqli_real_escape_string($conn, $_POST['kagawad1']);
    $kagawad2 = mysqli_real_escape_string($conn, $_POST['kagawad2']);
    $kagawad3 = mysqli_real_escape_string($conn, $_POST['kagawad3']);
    $kagawad4 = mysqli_real_escape_string($conn, $_POST['kagawad4']);
    $kagawad5 = mysqli_real_escape_string($conn, $_POST['kagawad5']);
    $kagawad6 = mysqli_real_escape_string($conn, $_POST['kagawad6']);
    $kagawad7 = mysqli_real_escape_string($conn, $_POST['kagawad7']);
    $sk_captain = mysqli_real_escape_string($conn, $_POST['sk_captain']);
    $sk_kagawad1 = mysqli_real_escape_string($conn, $_POST['sk_kagawad1']);
    $sk_kagawad2 = mysqli_real_escape_string($conn, $_POST['sk_kagawad2']);
    $sk_kagawad3 = mysqli_real_escape_string($conn, $_POST['sk_kagawad3']);
    $sk_kagawad4 = mysqli_real_escape_string($conn, $_POST['sk_kagawad4']);
    $sk_kagawad5 = mysqli_real_escape_string($conn, $_POST['sk_kagawad5']);
    $sk_kagawad6 = mysqli_real_escape_string($conn, $_POST['sk_kagawad6']);
    $sk_kagawad7 = mysqli_real_escape_string($conn, $_POST['sk_kagawad7']);

    $updateOfficial = "UPDATE brgy_officials
        SET `captain_name`='$captain_name',
        `kagawad1`='$kagawad1',
        `kagawad2`='$kagawad2',
        `kagawad3`='$kagawad3',
        `kagawad4`='$kagawad4',
        `kagawad5`='$kagawad5',
        `kagawad6`='$kagawad6',
        `kagawad7`='$kagawad7',
        `sk_captain`='$sk_captain',
        `sk_kagawad1`='$sk_kagawad1',
        `sk_kagawad2`='$sk_kagawad2',
        `sk_kagawad3`='$sk_kagawad3',
        `sk_kagawad4`='$sk_kagawad4',
        `sk_kagawad5`='$sk_kagawad5',
        `sk_kagawad6`='$sk_kagawad6',
        `sk_kagawad7`='$sk_kagawad7' WHERE id = '$id' ";
    $updateOfficialResult = mysqli_query($conn, $updateOfficial);

    if($updateOfficialResult){
        echo "    <script>
                    swal({
                    title: 'Official Updated Successfully',
                    icon: 'success',
                    button: 'OKAY',
                    });
            </script>";
            header('Location: official.php');
            exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include '../includes/links.php';
    ?>
    <title>OFFICIAL DATA</title>
</head>
<style>
    body,
    html {
        overflow: hidden;
        /* disable scrolling */
        height: 100dvh;
    }

    #wrapper {
        display: flex;
        height: 100dvh;
    }

    #sidepanel {
        width: 250px;
        background-color: #FFF1D0;
        overflow: hidden;
        border-right: 1px solid #ddd;
    }

    #content {
        flex: 1;
        padding: 20px;
        overflow: auto;
    }

    .nav-link.active {
        border: 2px solid #000;
        /* Example border color */
        border-radius: 5px;
        /* Rounded corners */
    }
</style>

<body>
    <?php
    include '../includes/navbar.php';
    ?>
    <div id="wrapper">
        <aside id="sidepanel">
            <?php
            include '../includes/sidebar.php';
            ?>
        </aside>

        <div id="content">

            <div class="container p-5">
                <h2 class="text-center">Barangay Officials</h2>
                <div class="row px-3">
                    <?php 
                        $officialQuery = "SELECT  * FROM brgy_officials";
                        $officialResult = mysqli_query($conn, $officialQuery);

                        if($officialResult->num_rows>0){
                            while($official=$officialResult->fetch_assoc()){
                    ?>
                    <div class="col mt-3">
                            <h2 class="mb-4">Barangay Captain: <?= $official['captain_name'] ?></h2>
                            <h3 class="mb-4">Kagawad: <?= $official['kagawad1'] ?></h3>
                            <h3 class="mb-4">Kagawad: <?= $official['kagawad2'] ?></h3>
                            <h3 class="mb-4">Kagawad: <?= $official['kagawad3'] ?></h3>
                            <h3 class="mb-4">Kagawad: <?= $official['kagawad4'] ?></h3>
                            <h3 class="mb-4">Kagawad: <?= $official['kagawad5'] ?></h3>
                            <h3 class="mb-4">Kagawad: <?= $official['kagawad6'] ?></h3>
                            <h3 class="mb-4">Kagawad: <?= $official['kagawad7'] ?></h3>
                    </div>
                    <div class="col mt-3">
                            <h2 class="mb-4">SK Captain: <?= $official['sk_captain'] ?></h2>
                            <h3 class="mb-4">SK Kagawad: <?= $official['sk_kagawad1'] ?></h3>
                            <h3 class="mb-4">SK Kagawad: <?= $official['sk_kagawad2'] ?></h3>
                            <h3 class="mb-4">SK Kagawad: <?= $official['sk_kagawad3'] ?></h3>
                            <h3 class="mb-4">SK Kagawad: <?= $official['sk_kagawad4'] ?></h3>
                            <h3 class="mb-4">SK Kagawad: <?= $official['sk_kagawad5'] ?></h3>
                            <h3 class="mb-4">SK Kagawad: <?= $official['sk_kagawad6'] ?></h3>
                            <h3 class="mb-4">SK Kagawad: <?= $official['sk_kagawad7'] ?></h3>
                    </div>
                    <button class="btn btn-outline-primary float-end me-3 mt-3" data-bs-toggle="modal" data-bs-target="#updateOfficial<?= $official['id'] ?>">Update Official</button>

                    <!-- update official modal here -->
                    <div class="modal fade" id="updateOfficial<?= $official['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <h2 class="text-center">Update Officials</h2>
                                        <div class="border-bottom mb-3"></div>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control mb-2" name="id" value="<?= $official['id'] ?>" hidden>
                                                    <label for="captain_name" class="form-label fw-bold">Brgy Captain:</label>
                                                    <input type="text" class="form-control mb-2" name="captain_name" value="<?= $official['captain_name'] ?>" required>
                                                    <label for="kagawad1" class="form-label fw-bold">Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="kagawad1" value="<?= $official['kagawad1'] ?>" required>
                                                    <label for="kagawad2" class="form-label fw-bold">Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="kagawad2" value="<?= $official['kagawad2'] ?>" required>
                                                    <label for="kagawad3" class="form-label fw-bold">Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="kagawad3" value="<?= $official['kagawad3'] ?>" required>
                                                    <label for="kagawad4" class="form-label fw-bold">Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="kagawad4" value="<?= $official['kagawad4'] ?>" required>
                                                    <label for="kagawad5" class="form-label fw-bold">Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="kagawad5" value="<?= $official['kagawad5'] ?>" required>
                                                    <label for="kagawad6" class="form-label fw-bold">Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="kagawad6" value="<?= $official['kagawad6'] ?>" required>
                                                    <label for="kagawad7" class="form-label fw-bold">Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="kagawad7" value="<?= $official['kagawad7'] ?>" required>
                                                </div>
                                                <div class="col">
                                                    <label for="sk_captain" class="form-label fw-bold">SK Captain:</label>
                                                    <input type="text" class="form-control mb-2" name="sk_captain" value="<?= $official['sk_captain'] ?>" required>
                                                    <label for="sk_kagawad1" class="form-label fw-bold">SK Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="sk_kagawad1" value="<?= $official['sk_kagawad1'] ?>" required>
                                                    <label for="sk_kagawad2" class="form-label fw-bold">SK Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="sk_kagawad2" value="<?= $official['sk_kagawad2'] ?>" required>
                                                    <label for="sk_kagawad3" class="form-label fw-bold">SK Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="sk_kagawad3" value="<?= $official['sk_kagawad3'] ?>" required>
                                                    <label for="sk_kagawad4" class="form-label fw-bold">SK Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="sk_kagawad4" value="<?= $official['sk_kagawad4'] ?>" required>
                                                    <label for="sk_kagawad5" class="form-label fw-bold">SK Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="sk_kagawad5" value="<?= $official['sk_kagawad5'] ?>" required>
                                                    <label for="sk_kagawad6" class="form-label fw-bold">SK Kagawad:</label>
                                                    <input type="text" class="form-control mb-2" name="sk_kagawad6" value="<?= $official['sk_kagawad6'] ?>" required>
                                                    <label for="sk_kagawad7" class="form-label fw-bold">SK Kagawad:</label>
                                                    <input type="text" class="form-control mb-3" name="sk_kagawad7" value="<?= $official['sk_kagawad7'] ?>" required>

                                                    <button class="btn btn-secondary float-end ms-2" data-bs-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-outline-success float-end" name="updateBtn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                            }
                        }
                    ?>
                </div>

                <!-- closing div #content -->
            </div>
            <!-- closing div #wrapper -->
        </div>

        <?php
        include '../includes/scripts.php';
        ?>
</body>

</html>
