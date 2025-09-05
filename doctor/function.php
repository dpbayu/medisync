<?php
require '../function.php';

// Send to Pharmacist Start
if (isset($_POST['sendPharmacist'])) {
    $id_hospital = $_POST['id_hospital'];
    $id_patient = $_POST['id_patient'];
    $id_doctor = $_POST['id_doctor'];
    $birth_date = $_POST['birth_date'];
    $check_up = $_POST['check_up'];
    $total_medicine = $_POST['total_medicine'];
    $total_price = $_POST['total_price'];
    $sql_insert = "INSERT INTO tbl_pharmacist (id, id_hospital, id_patient, id_doctor, birth_date, check_up, total_medicine, total_price) VALUES ('', '$id_hospital', '$id_patient', '$id_doctor', '$birth_date', '$check_up', '$total_medicine', '$total_price')";
    $query_insert = mysqli_query($db, $sql_insert);
    echo "<script>window.location='dataMedicalRecord.php?success=Data successfuly added to pharmachist!';</script>";
}
// Send to Pharmacist End

// Add Medical Record Start
if (isset($_POST['addMedicalRecord'])) {
    $id_patient = trim(mysqli_real_escape_string($db, $_POST['id_patient']));
    $illness = trim(mysqli_real_escape_string($db, $_POST['illness']));
    $id_doctor = trim(mysqli_real_escape_string($db, $_POST['id_doctor']));
    $diagnosis = trim(mysqli_real_escape_string($db, $_POST['diagnosis']));
    $check_up = trim(mysqli_real_escape_string($db, $_POST['check_up']));
    mysqli_query($db, "INSERT INTO tbl_medical_record (id_hospital, id_patient, illness, id_doctor, diagnosis, check_up) VALUES ('', '$id_patient', '$illness', '$id_doctor', '$diagnosis', '$check_up')");
    echo "<script>window.location='dataMedicalRecord.php?success=Data successfuly added!';</script>";
}
// Add Medical Record End

// Add Medicine Start
if (isset($_POST['addMedicine'])) {
    $id_hospital = $_POST['id_hospital'];
    $id_medicine = $_POST['id_medicine'];
    $qty_medicine = $_POST['qty_medicine'];
    $price_medicine = $_POST['price_medicine'];
    $total = count($id_medicine);
    for ($i = 0; $i < $total; $i++) {
        $selSto = mysqli_query($db, "SELECT * FROM tbl_medicine WHERE id_medicine = '" . $id_medicine[$i] . "'");
        $sto = mysqli_fetch_array($selSto);
        if (!$sto) {
            die("Medicine not found for id: " . $id_medicine[$i]);
        }
        $stok = $sto['stock_medicine'];
        $sisa = $stok - $qty_medicine[$i];
        if ($stok < $qty_medicine[$i]) {
            echo "<script>window.location='dataMedicalRecord.php?failed=Stock medicine too low!';</script>";
            } else {
            $insert = mysqli_query($db, "INSERT INTO tbl_hospital_medicine SET id_hospital = '$id_hospital', id_medicine = '" . $id_medicine[$i] . "', qty_medicine = '" . $qty_medicine[$i] . "', price_medicine = '" . $price_medicine[$i] . "'");
            if ($insert) {
                $upstok = mysqli_query($db, "UPDATE tbl_medicine SET stock_medicine = '$sisa' WHERE id_medicine = '" . $id_medicine[$i] . "'");
                echo "<script>window.location='dataMedicalRecord.php?success=Medicine successfuly added!';</script>";
            } else {
                echo "<div><b>Oops!</b> 404 Error Server.</div>";
            }
        }
    }
}
// Add Medicine End

// Update Profile Start
if (isset($_POST['update'])) {
    global $db;
    $name_doctor = trim(mysqli_real_escape_string($db, $_POST['name_doctor']));
    $email_doctor = trim(mysqli_real_escape_string($db, $_POST['email_doctor']));
    $password_doctor = trim(mysqli_real_escape_string($db, $_POST['password_doctor']));
    $old_profile = $_POST['old_profile'];
    $profile_doctor = $_FILES['profile_doctor']['name'];
    $imgtemp = $_FILES['profile_doctor']['tmp_name'];
    if ($imgtemp=='') {
        $id = $_SESSION['id_doctor'];
        $q = "SELECT * FROM tbl_doctor WHERE id_doctor = '$id'";
        $r = mysqli_query($db,$q);
        $d = mysqli_fetch_array($r);
        $profile_doctor = $d['profile_doctor'];
    }
    move_uploaded_file($imgtemp,"img/$profile_doctor");
    unlink('img/'.$old_profile);
    if (empty($email_doctor) OR empty($name_doctor)) {
        echo "Field still empty";
    } else {
            if (empty($password_doctor)) {
                $id = $_SESSION['id_doctor'];
                $sql = "UPDATE tbl_doctor SET name_doctor = '$name_doctor', email_doctor = '$email_doctor', profile_doctor = '$profile_doctor' WHERE id_doctor = '$id'";
                mysqli_query($db, "UPDATE tbl_user SET email = '$email_doctor' WHERE id_user = '$id'");
                if (mysqli_query($db, $sql)) {
                    $_SESSION['name_doctor'] = $name_doctor;
                    $_SESSION['email_doctor'] = $email_doctor;
                    $_SESSION['profile_doctor'] = $profile_doctor;
                    echo "<script>document.location.href = 'profile.php?success=Succesfully updated!';</script>";
                } else {
                    echo "Error";
                }
            } else {
                $hash = password_hash($password_doctor, PASSWORD_DEFAULT);
                $id = $_SESSION['id_doctor'];
                $sql2 = "UPDATE tbl_doctor SET name_doctor = '$name_doctor', email_doctor = '$email_doctor', profile_doctor = '$profile_doctor', password_doctor = '$hash' WHERE id_doctor = '$id'";
                mysqli_query($db, "UPDATE tbl_user SET email = '$email_doctor' WHERE id_user = '$id'");
                if (mysqli_query($db, $sql2)) {
                    session_unset();
                    session_destroy();
                    echo "<script>alert('Password success changed, please login again');
                    document.location.href = '../index.php';
                    </script>";
                } else {
                echo "error";
            }
        }
    }
}
// Update Profile End
?>