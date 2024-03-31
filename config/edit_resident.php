<?php
    require 'conn.php';
    session_start();

    if(isset($_POST['editResidentBtn'])){
        
        $resident_id = mysqli_real_escape_string($conn, $_POST['resident_id']);
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

        $updateResidentQuery = "UPDATE `resident_data` SET 
        `houseNumber`='$houseNumber',
        `firstName`='$firstName',
        `middleName`='$middleName',
        `aliasName`='$aliasName',
        `lastName`='$lastName',
        `residentBday`='$residentBday',
        `residentAge`='$residentAge',
        `placeOfBirth`='$placeOfBirth',
        `residentGender`='$residentGender',
        `civilStatus`='$civilStatus',
        `residentPurok`='$residentPurok',
        `voterStatus`='$voterStatus',
        `residentCitizenship`='$residentCitizenship',
        `residentOccupation`='$residentOccupation',
        `residentReligion`='$residentReligion',
        `bloodType`='$bloodType',
        `motherName`='$motherName',
        `fatherName`='$fatherName',
        `sourceOfLiving`='$sourceOfLiving',
        `dependentsNum`='$dependentsNum',
        `region_text`='$region_text',
        `province_text`='$province_text',
        `city_text`='$city_text',
        `barangay_text`='$barangay_text',
        `streetName`='$streetName' WHERE `resident_id` = '$resident_id' ";
        $updateResidentResult = mysqli_query($conn, $updateResidentQuery);
        
        if($updateResidentResult){
            $_SESSION['message'] = "Data Updated  Successfully!";
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
