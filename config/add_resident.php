<?php
    require 'conn.php';
    session_start();

    /* resident id  function */
    function generateResidentID() {
        $prefix = 'DLYP';
        $numbers = '0123456789';
    
        $randomString = $prefix;
    
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $numbers[rand(0, strlen($numbers) - 1)];
        }
    
        return $randomString;
    }
    if(isset($_POST['addResidentBtn'])){
        
        $resident_id = generateResidentID();
        $houseNumber = mysqli_real_escape_string($conn, $_POST['houseNumber']);
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $middleName = mysqli_real_escape_string($conn, $_POST['middleName']);
        $aliasName = mysqli_real_escape_string($conn, $_POST['aliasName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $residentBday = mysqli_real_escape_string($conn, $_POST['residentBday']);
        $residentAge = mysqli_real_escape_string($conn, $_POST['residentAge']);
        $placeOfBirth = mysqli_real_escape_string($conn, $_POST['placeOfBirth']);
        $residentGender = mysqli_real_escape_string($conn, $_POST['residentGender']);
        $civilStatus = mysqli_real_escape_string($conn, $_POST['civilStatus']);
        $residentPurok = mysqli_real_escape_string($conn, $_POST['residentPurok']);
        $voterStatus = mysqli_real_escape_string($conn, $_POST['voterStatus']);
        $residentCitizenship = mysqli_real_escape_string($conn, $_POST['residentCitizenship']);
        $residentOccupation = mysqli_real_escape_string($conn, $_POST['residentOccupation']);
        $residentReligion = mysqli_real_escape_string($conn, $_POST['residentReligion']);
        $bloodType = mysqli_real_escape_string($conn, $_POST['bloodType']);
        $motherName = mysqli_real_escape_string($conn, $_POST['motherName']);
        $fatherName = mysqli_real_escape_string($conn, $_POST['fatherName']);
        $sourceOfLiving = mysqli_real_escape_string($conn, $_POST['sourceOfLiving']);
        $dependentsNum = mysqli_real_escape_string($conn, $_POST['dependentsNum']);
        $region_text = mysqli_real_escape_string($conn, $_POST['region_text']);
        $province_text = mysqli_real_escape_string($conn, $_POST['province_text']);
        $city_text = mysqli_real_escape_string($conn, $_POST['city_text']);
        $barangay_text = mysqli_real_escape_string($conn, $_POST['barangay_text']);
        $streetName = mysqli_real_escape_string($conn, $_POST['streetName']);

        $addResidentQuery = "INSERT INTO `resident_data`(`resident_id`, `houseNumber`, `firstName`, `middleName`, `aliasName`, `lastName`, `residentBday`, `residentAge`, `placeOfBirth`, `residentGender`, `civilStatus`, `residentPurok`, `voterStatus`, `residentCitizenship`, `residentOccupation`, `residentReligion`, `bloodType`, `motherName`, `fatherName`, `sourceOfLiving`, `dependentsNum`, `region_text`, `province_text`, `city_text`, `barangay_text`, `streetName`)
        VALUES ('$resident_id', '$houseNumber', '$firstName', '$middleName', '$aliasName', '$lastName', '$residentBday', '$residentAge', '$placeOfBirth', '$residentGender', '$civilStatus', '$residentPurok', '$voterStatus', '$residentCitizenship', '$residentOccupation', '$residentReligion', '$bloodType', '$motherName', '$fatherName', '$sourceOfLiving', '$dependentsNum', '$region_text', '$province_text', '$city_text', '$barangay_text', '$streetName')";
        $addResidentResult = mysqli_query($conn, $addResidentQuery);
        
        if($addResidentResult){
            $_SESSION['message'] = "Data Added  Successfully!";
            $_SESSION['icon'] = "success";
            header('Location: ../pages/resident.php');
            exit();
        }else{
            echo "error";
            header('Location: ../pages/resident.php');
            exit();
        }
    }

?>