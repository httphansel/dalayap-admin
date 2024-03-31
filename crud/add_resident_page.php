
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include '../includes/links.php';
    ?>
    <title>Add Resident Data</title>
</head>
<style>
        /* Hide the increment/decrement arrows */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
    }
</style>
<body>
    <?php
    include '../includes/navbar.php';
    ?>
    <div class="container">

        <form action="../config/add_resident.php" method="post">

            <div class="row">
                <div class="col p-5">
                    <label for="houseNumber" class="form-label fw-bold">House Number:</label>
                    <input type="number" class="form-control mb-3" name="houseNumber" autocomplete="off" required>
                    <label for="firstName" class="form-label fw-bold">First Name:</label>
                    <input type="text" class="form-control mb-3" name="firstName" autocomplete="off" required>
                    <label for="middleName" class="form-label fw-bold">Middle Name:</label>
                    <input type="text" class="form-control mb-3" name="middleName" autocomplete="off" required>
                    <label for="aliasName" class="form-label fw-bold">Alias / Nickame:</label>
                    <input type="text" class="form-control mb-3" name="aliasName" autocomplete="off" required>
                    <label for="lastName" class="form-label fw-bold">Last Name:</label>
                    <input type="text" class="form-control mb-3" name="lastName" autocomplete="off" required>
                    <div class="row">
                        <div class="col-8">
                            <label for="residentBday" class="form-label fw-bold">Birthday:</label>
                            <input type="date" class="form-control mb-3" name="residentBday" autocomplete="off" required>
                        </div>
                        <div class="col">
                            <label for="residentAge" class="form-label fw-bold">Age:</label>
                            <input type="number" class="form-control mb-3" name="residentAge" autocomplete="off" required>
                        </div>
                    </div>
                    <label for="placeOfBirth" class="form-label fw-bold">Place of Birth:</label>
                    <input type="text" class="form-control mb-3" name="placeOfBirth" autocomplete="off" required>
                </div>

                <div class="col p-5">

                    <div class="row">
                        <div class="col">
                            <label for="residentGender" class="form-label fw-bold">Gender:</label>
                            <select class="form-select mb-3" name="residentGender">
                                <option selected value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col">
                        <label for="civilStatus" class="form-label fw-bold">Civil Status:</label>
                            <select class="form-select mb-3" name="civilStatus">
                                <option selected value=""></option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="residentPurok" class="form-label fw-bold">Purok:</label>
                            <select class="form-select mb-3" name="residentPurok">
                                <option selected value=""></option>
                                <option value="Purok 1">Purok 1</option>
                                <option value="Non-Voter">Purok 2</option>
                                <!-- add na lang kayo -->
                            </select>
                        </div>
                        <div class="col">
                            <label for="voterStatus" class="form-label fw-bold">Voter Status:</label>
                            <select class="form-select mb-3" name="voterStatus">
                                <option selected value=""></option>
                                <option value="Registered">Registered</option>
                                <option value="Not Registered">Not Registered</option>
                                <option value="Non-Voter">Non-Voter</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="residentCitizenship" class="form-label fw-bold">Citizenship:</label>
                            <input type="text" class="form-control mb-3" name="residentCitizenship" autocomplete="off" required>
                        </div>
                        <div class="col">
                            <label for="residentOccupation" class="form-label fw-bold">Occupation:</label>
                            <input type="text" class="form-control mb-3" name="residentOccupation" autocomplete="off" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <label for="residentReligion" class="form-label fw-bold">Religion:</label>
                            <input type="text" class="form-control mb-3" name="residentReligion" autocomplete="off" required>
                        </div>
                        <div class="col">
                            <label for="bloodType" class="form-label fw-bold">Blood Type:</label>
                            <select class="form-select mb-3" name="bloodType">
                                <option selected value=""></option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>

                    <label for="motherName" class="form-label fw-bold">Mother Name:</label>
                    <input type="text" class="form-control mb-3" name="motherName" autocomplete="off" required>
                    <label for="fatherName" class="form-label fw-bold">Father Name:</label>
                    <input type="text" class="form-control mb-3" name="fatherName" autocomplete="off" required>
                    <label for="sourceOfLiving" class="form-label fw-bold">Source of Living / Income:</label>
                    <input type="text" class="form-control mb-3" name="sourceOfLiving" autocomplete="off" required>
                </div>
                <div class="col p-5">
                    <label for="dependentsNum" class="form-label fw-bold">Number of Dependents:</label>
                    <input type="number" class="form-control mb-3" name="dependentsNum" autocomplete="off" required>
                    <label class="form-label fw-bold">Region <span class="text-danger">*</span></label>
                    <select name="region" class="form-control form-control-md mb-3" id="region"></select>
                    <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
                    <label class="form-label fw-bold">Province <span class="text-danger">*</span></label>
                    <select name="province" class="form-control form-control-md mb-3" id="province"></select>
                    <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
                    <label class="form-label fw-bold">City / Municipality <span class="text-danger">*</span></label>
                    <select name="city" class="form-control form-control-md mb-3" id="city"></select>
                    <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                    <label class="form-label fw-bold">Barangay <span class="text-danger">*</span></label>
                    <select name="barangay" class="form-control form-control-md mb-3" id="barangay"></select>
                    <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
                    <label for="streetName" class="form-label fw-bold">Street (n/a if none):</label>
                    <input type="text" class="form-control mb-3" name="streetName" autocomplete="off" required>
                    <button type="submit" class="btn btn-outline-primary float-end" name="addResidentBtn">Add Data</button>
                    <a href="../pages/resident.php" class="btn btn-secondary me-2 float-end">Back</a>
                </div>
            </div>
            
        </form>

    </div>
    <?php
    include '../includes/scripts.php';
    ?>
    <script src="ph-address-selector.js"></script>
</body>

</html>