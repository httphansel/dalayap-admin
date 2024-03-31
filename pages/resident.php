
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google api -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
    include '../includes/links.php';
    ?>
    <title>RESIDENT DATA</title>
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
        overflow: hidden;
    }

    .nav-link.active {
        border-bottom: 2px solid #000;
        /* Example border color */
    }

    table {
        max-height: 100vh;
        overflow-y: auto;
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
            <div class="shadow-lg p-2">
                <div class="container">
                    <div class="card p-3">
                        <h2>RESIDENTS</h2>
                        <a href="../crud/add_resident_page.php" class="text-end ms-auto mb-2 btn btn-outline-primary mt-0">
                            <i class="fa-solid fa-user-plus"></i>
                            Add Resident
                        </a>

                        <table class="table table-light table-hover" id="myTable">
                            <thead class="bg-danger mt-3">
                                <tr>
                                    <th scope="col">Resident ID</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Civil Status</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Voter Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <?php
                            $residentQuery = "SELECT * FROM resident_data WHERE archive_data = 'No'";
                            $residentQueryResult = mysqli_query($conn, $residentQuery);

                            if ($residentQueryResult->num_rows > 0) {
                                while ($resident = $residentQueryResult->fetch_assoc()) {
                                    $fullName = $resident['lastName'] . ", " . $resident['firstName'];
                                    $address = $resident['streetName'] . ", " . $resident['barangay_text'] . ", " . $resident['city_text'] . ", " . $resident['province_text'];
                            ?>
                                    <tbody class="pt-3 fw-bold">
                                        <tr>
                                            <td><?= $resident['resident_id'] ?></td>
                                            <td><?= $fullName ?></td>
                                            <td><?= $resident['residentAge'] ?></td>
                                            <td><?= $resident['civilStatus'] ?></td>
                                            <td><?= $resident['residentGender'] ?></td>
                                            <td><?= $resident['voterStatus'] ?></td>
                                            <td>
                                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#viewDataModal<?= $resident['id'] ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <!-- view data modal -->
                                                <div class="modal fade" id="viewDataModal<?= $resident['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body">

                                                                <div class="shadow-lg p-3 mt-2">
                                                                    <div class="row px-4">

                                                                        <div class="row text-start">
                                                                            <h5 class="">NAME: <br><?= $fullName ?></h5>
                                                                            <p class="strong">Resident ID: <?= $resident['resident_id'] ?></p>
                                                                            <div class="border-bottom"></div>
                                                                        </div>

                                                                        <div class="col mt-2">
                                                                            <p class="fw-bold">HOUSE NUMBER: <br><?= $resident['houseNumber'] ?></p>
                                                                            <p class="fw-bold">PLACE OF BIRTH: <br><?= $resident['placeOfBirth'] ?></p>
                                                                            <p class="fw-bold">CITIZENSHIP: <br><?= $resident['residentCitizenship'] ?></p>
                                                                            <p class="fw-bold">RELIGION: <br><?= $resident['residentReligion'] ?></p>
                                                                            <p class="fw-bold">MOTHER: <br><?= $resident['motherName'] ?></p>
                                                                            <p class="fw-bold">SOURCE OF LIVING: <br><?= $resident['sourceOfLiving'] ?></p>
                                                                            <p class="fw-bold">ADDRESS: <br><?= $address ?></p>
                                                                        </div>

                                                                        <div class="col mt-2">
                                                                            <p class="fw-bold">BIRTHDAY: <br><?= $resident['residentBday'] ?></p>
                                                                            <p class="fw-bold">PUROK: <br><?= $resident['residentPurok'] ?></p>
                                                                            <p class="fw-bold">OCCUPATION: <br><?= $resident['residentOccupation'] ?></p>
                                                                            <p class="fw-bold">BLOOD TYPE: <br><?= $resident['bloodType'] ?></p>
                                                                            <p class="fw-bold">FATHER: <br><?= $resident['fatherName'] ?></p>
                                                                            <p class="fw-bold">NUMBER OF DEPENDENTS: <br><?= $resident['dependentsNum'] ?></p>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- view data modal end -->

                                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editModal<?= $resident['id'] ?>">
                                                <i class="fa-solid fa-square-pen"></i>
                                                </button>

                                                <!-- modal for editing -->
                                                <div class="modal fade" id="editModal<?= $resident['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <i class="fa-solid fa-pen-to-square" style="font-size: 35px; color: blue;"></i>
                                                                <p class="h5 mt-3">Are you sure you want to edit this data?</p>
                                                                <div class="row mt-3 float-end me-4">
                                                                    <div class="col">
                                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <a href="../crud/edit_resident_page.php?id=<?= $resident['id'] ?>" class="btn btn-success">Edit</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $resident['id'] ?>">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>

                                                <!-- modal for deleting -->
                                                <div class="modal fade" id="deleteModal<?= $resident['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <i class="fa-solid fa-triangle-exclamation" style="font-size: 35px; color: red;"></i>
                                                                <p class="h5 mt-3">Are you sure you want to delete this data?</p>
                                                                <div class="row mt-3 float-end me-4">
                                                                    <div class="col">
                                                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <a href="../code/delete_resident.php?id=<?= $resident['id'] ?>" class="btn btn-danger">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    </tbody>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>

                </div>
            </div>
            <!-- closing div #content -->
        </div>
        <!-- closing div #wrapper -->
    </div>
    <!-- address api script -->
    <script src="ph-address-selector.js"></script>
    <script>
        function changeButtonText(selectedItem) {
            var dropdownButton = document.getElementById('dropdownMenuButton');
            dropdownButton.innerText = selectedItem.innerText;
        }
    </script>
    <?php
    include '../includes/scripts.php';
    ?>
</body>

</html>