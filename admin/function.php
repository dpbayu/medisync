<?php
require '../function.php';
require '../assets/libs/vendor/autoload.php';

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDepedencyException;

// Add & Edit Patient Start
if (isset($_POST['addPatient'])) {
    $uuid = Uuid::uuid4()->toString();
    $nik_patient = trim(mysqli_real_escape_string($db, $_POST['nik_patient']));
    $name_patient = trim(mysqli_real_escape_string($db, $_POST['name_patient']));
    $email_patient = trim(mysqli_real_escape_string($db, $_POST['email_patient']));
    $password_patient = trim(mysqli_real_escape_string($db, $_POST['password_patient']));
    $gender_patient = trim(mysqli_real_escape_string($db, $_POST['gender_patient']));
    $address_patient = trim(mysqli_real_escape_string($db, $_POST['address_patient']));
    $phone_patient = trim(mysqli_real_escape_string($db, $_POST['phone_patient']));
    $birth_place = trim(mysqli_real_escape_string($db, $_POST['birth_place']));
    $birth_date = trim(mysqli_real_escape_string($db, $_POST['birth_date']));
    $religion_patient = trim(mysqli_real_escape_string($db, $_POST['religion_patient']));
    $blood_patient = trim(mysqli_real_escape_string($db, $_POST['blood_patient']));
    $marriage_patient = trim(mysqli_real_escape_string($db, $_POST['marriage_patient']));
    $sql_check = mysqli_query($db, "SELECT * FROM tbl_patient WHERE nik_patient = '$nik_patient'");
    if (mysqli_num_rows($sql_check) > 0) {
        echo "<script>window.location='dataPatient.php?failed=NIK already exist! Try again';</script>";
    } else {
        $password_patient = password_hash($password_patient, PASSWORD_DEFAULT);
        mysqli_query($db, "INSERT INTO tbl_user (id_user, email, role) VALUES ('$uuid', '$email_patient', 'Patient')");
        mysqli_query($db, "INSERT INTO tbl_patient (id_patient, nik_patient, name_patient, email_patient, password_patient, gender_patient, address_patient, phone_patient, birth_place, birth_date, religion_patient, blood_patient, marriage_patient) VALUES ('$uuid', '$nik_patient', '$name_patient', '$email_patient', '$password_patient', '$gender_patient', '$address_patient', '$phone_patient', '$birth_place', '$birth_date', '$religion_patient', '$blood_patient', '$marriage_patient')");
        echo "<script>window.location='dataPatient.php?success=Data successfully added!';</script>";
    }
} else if (isset($_POST['editPatient'])) {
    $id = $_POST['id'];
    $nik_patient = trim(mysqli_real_escape_string($db, $_POST['nik_patient']));
    $name_patient = trim(mysqli_real_escape_string($db, $_POST['name_patient']));
    $email_patient = trim(mysqli_real_escape_string($db, $_POST['email_patient']));
    $old_email = trim(mysqli_real_escape_string($db, $_POST['old_email']));
    $password_patient = trim(mysqli_real_escape_string($db, $_POST['password_patient']));
    $gender_patient = trim(mysqli_real_escape_string($db, $_POST['gender_patient']));
    $address_patient = trim(mysqli_real_escape_string($db, $_POST['address_patient']));
    $phone_patient = trim(mysqli_real_escape_string($db, $_POST['phone_patient']));
    $birth_place = trim(mysqli_real_escape_string($db, $_POST['birth_place']));
    $birth_date = trim(mysqli_real_escape_string($db, $_POST['birth_date']));
    $religion_patient = trim(mysqli_real_escape_string($db, $_POST['religion_patient']));
    $blood_patient = trim(mysqli_real_escape_string($db, $_POST['blood_patient']));
    $marriage_patient = trim(mysqli_real_escape_string($db, $_POST['marriage_patient']));
    mysqli_query($db, "SELECT tbl_patient.id_patient FROM tbl_patient INNER JOIN tbl_user ON tbl_patient.email_patient = tbl_user.email WHERE tbl_user.email = '$email_patient'");
    $sql_check = mysqli_query($db, "SELECT * FROM tbl_patient WHERE nik_patient = '$nik_patient'");
    if (empty($password_patient)) {
            mysqli_query($db, "UPDATE tbl_user SET email = '$email_patient' WHERE email = '$old_email'");
            mysqli_query($db, "UPDATE tbl_patient SET nik_patient = '$nik_patient', name_patient = '$name_patient', email_patient = '$email_patient', gender_patient = '$gender_patient', address_patient = '$address_patient', phone_patient = '$phone_patient', birth_place = '$birth_place', birth_date = '$birth_date', religion_patient = '$religion_patient', blood_patient = '$blood_patient', marriage_patient = '$marriage_patient' WHERE id_patient = '$id'");
            echo "<script>window.location='dataPatient.php?success=Data successfuly updated!';</script>";
        } else {
            $hash = password_hash($password_patient, PASSWORD_DEFAULT);
            mysqli_query($db, "UPDATE tbl_user SET email = '$email_patient' WHERE email = '$old_email'");
            mysqli_query($db, "UPDATE tbl_patient SET nik_patient = '$nik_patient', name_patient = '$name_patient', email_patient = '$email_patient', password_patient = '$hash', gender_patient = '$gender_patient', address_patient = '$address_patient', phone_patient = '$phone_patient', birth_place = '$birth_place', birth_date = '$birth_date', religion_patient = '$religion_patient', blood_patient = '$blood_patient', marriage_patient = '$marriage_patient' WHERE id_patient = '$id'");
            echo "<script>window.location='dataPatient.php?success=Data successfuly updated!';</script>";
    }
}
// Add & Edit Patient End

// Add & Edit Doctor Start
if (isset($_POST['addDoctor'])) {
    $uuid = Uuid::uuid4()->toString();
    $name_doctor = trim(mysqli_real_escape_string($db, $_POST['name_doctor']));
    $email_doctor = trim(mysqli_real_escape_string($db, $_POST['email_doctor']));
    $password_doctor = trim(mysqli_real_escape_string($db, $_POST['password_doctor']));
    $id_specialist = trim(mysqli_real_escape_string($db, $_POST['id_specialist']));
    $address_doctor = trim(mysqli_real_escape_string($db, $_POST['address_doctor']));
    $phone_doctor = trim(mysqli_real_escape_string($db, $_POST['phone_doctor']));
    $sql_check = mysqli_query($db, "SELECT * FROM tbl_doctor WHERE email_doctor = '$email_doctor'");
    if (mysqli_num_rows($sql_check) > 0) {
        echo "<script>window.location='dataDoctor.php?failed=Email already exist! Try again';</script>";
    } else {
        $password_doctor = password_hash($password_doctor, PASSWORD_DEFAULT);
        mysqli_query($db, "INSERT INTO tbl_user (id_user, email, role) VALUES ('$uuid', '$email_doctor', 'Doctor')");
        mysqli_query($db, "INSERT INTO tbl_doctor (id_doctor, name_doctor, email_doctor, password_doctor, id_specialist, address_doctor, phone_doctor) VALUES ('$uuid', '$name_doctor', '$email_doctor', '$password_doctor', '$id_specialist', '$address_doctor', '$phone_doctor')");
        echo "<script>window.location='dataDoctor.php?success=Data successfuly added!';</script>";
    }
} else if (isset($_POST['editDoctor'])) {
    $id = $_POST['id'];
    $name_doctor = trim(mysqli_real_escape_string($db, $_POST['name_doctor']));
    $email_doctor = trim(mysqli_real_escape_string($db, $_POST['email_doctor']));
    $old_email = trim(mysqli_real_escape_string($db, $_POST['old_email']));
    $password_doctor = trim(mysqli_real_escape_string($db, $_POST['password_doctor']));
    $id_specialist = trim(mysqli_real_escape_string($db, $_POST['id_specialist']));
    $address_doctor = trim(mysqli_real_escape_string($db, $_POST['address_doctor']));
    $phone_doctor = trim(mysqli_real_escape_string($db, $_POST['phone_doctor']));
    mysqli_query($db, "SELECT tbl_doctor.id_doctor FROM tbl_doctor INNER JOIN tbl_user ON tbl_doctor.email_doctor = tbl_user.email WHERE tbl_user.email = '$email_doctor'");
        if (empty($password_doctor)) {
            mysqli_query($db, "UPDATE tbl_user SET email = '$email_doctor' WHERE email = '$old_email'");
            mysqli_query($db, "UPDATE tbl_doctor SET name_doctor = '$name_doctor', email_doctor = '$email_doctor', id_specialist = '$id_specialist', address_doctor = '$address_doctor', phone_doctor = '$phone_doctor' WHERE id_doctor = '$id'");
            echo "<script>window.location='dataDoctor.php?success=Data successfuly updated!';</script>";
        } else {
            $hash = password_hash($password_doctor, PASSWORD_DEFAULT);
            mysqli_query($db, "UPDATE tbl_user SET email = '$email_doctor' WHERE email = '$old_email'");
            mysqli_query($db, "UPDATE tbl_doctor SET name_doctor = '$name_doctor', email_doctor = '$email_doctor', password_doctor = '$hash', id_specialist = '$id_specialist', address_doctor = '$address_doctor', phone_doctor = '$phone_doctor' WHERE id_doctor = '$id'");
            echo "<script>window.location='dataDoctor.php?success=Data successfuly updated!';</script>";
    }
}
// Add & Edit Doctor End

// Add & Edit Medicine Start
if (isset($_POST['addMedicine'])) {
    $total = $_POST['total'];
    for ($i = 1; $i <= $total ; $i++) { 
        $uuid = Uuid::uuid4()->toString();
        $name_medicine = trim(mysqli_real_escape_string($db, $_POST['name_medicine-'.$i]));
        $description_medicine = trim(mysqli_real_escape_string($db, $_POST['description_medicine-'.$i]));        
        $stock_medicine = trim(mysqli_real_escape_string($db, $_POST['stock_medicine-'.$i]));        
        $price_medicine = trim(mysqli_real_escape_string($db, $_POST['price_medicine-'.$i]));        
        $sql = mysqli_query($db, "INSERT INTO tbl_medicine (id_medicine, name_medicine, description_medicine, stock_medicine, price_medicine) VALUES ('$uuid', '$name_medicine', '$description_medicine', '$stock_medicine', '$price_medicine')");
    }
    if ($sql) {
        echo "<script>window.location='dataMedicine.php?success=".$total." Data successfully added!';</script>";
    } else {
        echo "<script>window.location='generate.php?failed=Data failed added! Try again';</script>";
    }
} else if (isset($_POST['editMedicine'])) {
    for ($i = 0; $i < count($_POST['id']); $i++) { 
        $id = $_POST['id'][$i];
        $name_medicine = trim(mysqli_real_escape_string($db, $_POST['name_medicine'][$i]));
        $description_medicine = trim(mysqli_real_escape_string($db, $_POST['description_medicine'][$i]));        
        $stock_medicine = trim(mysqli_real_escape_string($db, $_POST['stock_medicine'][$i]));        
        $price_medicine = trim(mysqli_real_escape_string($db, $_POST['price_medicine'][$i]));;        
        mysqli_query($db, "UPDATE tbl_medicine SET name_medicine = '$name_medicine', description_medicine = '$description_medicine', stock_medicine = '$stock_medicine', price_medicine = '$price_medicine' WHERE id_medicine = '$id'");
    }
    echo "<script>window.location='dataMedicine.php?success=Data successfuly updated!';</script>";
}
// Add & Edit Medicine End

// Add & Edit Poly Start
if (isset($_POST['addPoly'])) {
    $total = $_POST['total'];
    for ($i = 1; $i <= $total ; $i++) { 
        $uuid = Uuid::uuid4()->toString();
        $name_poly = trim(mysqli_real_escape_string($db, $_POST['name_poly-'.$i]));
        $desc_poly = trim(mysqli_real_escape_string($db, $_POST['desc_poly-'.$i]));        
        $sql = mysqli_query($db, "INSERT INTO tbl_poly (id_poly, name_poly, desc_poly) VALUES ('$uuid', '$name_poly', '$desc_poly')");
    }
    if ($sql) {
        echo "<script>window.location='dataPoly.php?success=".$total." Data successfully added!';</script>";
    } else {
        echo "<script>window.location='generatePoly.php?failed=Data failed added! Try again';</script>";
    }
} else if (isset($_POST['editPoly'])) {
    for ($i = 0; $i < count($_POST['id']); $i++) { 
        $id = $_POST['id'][$i];
        $name_poly = $_POST['name_poly'][$i];
        $desc_poly = $_POST['desc_poly'][$i];        
        mysqli_query($db, "UPDATE tbl_poly SET name_poly = '$name_poly', desc_poly = '$desc_poly' WHERE id_poly = '$id'");
    }
    echo "<script>window.location='dataPoly.php?success=Data successfuly updated!';</script>";
}
// Add & Edit Poly End

// Add & Edit Specialist Start
if (isset($_POST['addSpecialist'])) {
    $total = $_POST['total'];
    for ($i = 1; $i <= $total ; $i++) { 
        $uuid = Uuid::uuid4()->toString();
        $name_specialist = trim(mysqli_real_escape_string($db, $_POST['name_specialist-'.$i]));
        $sql = mysqli_query($db, "INSERT INTO tbl_specialist (id_specialist, name_specialist) VALUES ('$uuid', '$name_specialist')");
    }
    if ($sql) {
        echo "<script>window.location='dataSpecialist.php?success=".$total." Data successfully added!';</script>";
    } else {
        echo "<script>window.location='generateSpecialist.php?failed=Data failed added! Try again';</script>";
    }
} else if (isset($_POST['editSpecialist'])) {
    for ($i = 0; $i < count($_POST['id']); $i++) { 
        $id = $_POST['id'][$i];
        $name_specialist = $_POST['name_specialist'][$i];
        mysqli_query($db, "UPDATE tbl_specialist SET name_specialist = '$name_specialist' WHERE id_specialist = '$id'");
    }
    echo "<script>window.location='dataSpecialist.php?success=Data successfuly updated!';</script>";
}
// Add & Edit Specialist End

// Update Profile Start
if (isset($_POST['update'])) {
    global $db;
    $name_admin = mysqli_real_escape_string($db, $_POST['name_admin']);
    $email_admin = mysqli_real_escape_string($db, $_POST['email_admin']);
    $password_admin = mysqli_real_escape_string($db, $_POST['password_admin']);
    $old_profile = $_POST['old_profile'];
    $profile_admin = $_FILES['profile_admin']['name'];
    $imgtemp = $_FILES['profile_admin']['tmp_name'];
    if ($imgtemp=='') {
        $id = $_SESSION['id_user'];
        $q = "SELECT * FROM tbl_admin WHERE id_user = '$id'";
        $r = mysqli_query($db,$q);
        $d = mysqli_fetch_array($r);
        $profile_admin = $d['profile_admin'];
    }
    unlink('img/'.$old_profile);
    move_uploaded_file($imgtemp,"img/$profile_admin");
    if (empty($email_admin) OR empty($name_admin)) {
        echo "Field still empty";
    } else {
            if (empty($password_admin)) {
                $id = $_SESSION['id_user'];
                $sql = "UPDATE tbl_admin SET name_admin = '$name_admin', email_admin = '$email_admin', profile_admin = '$profile_admin' WHERE id_user = '$id'";
                if (mysqli_query($db, $sql)) {
                    $_SESSION['name_admin'] = $name_admin;
                    $_SESSION['email_admin'] = $email_admin;
                    $_SESSION['profile_admin'] = $profile_admin;
                    echo "<script>document.location.href = 'profile.php?success=Succesfully updated!';</script>";
                } else {
                    echo "Error";
                }
            } else {
                $hash = password_hash($password_admin, PASSWORD_DEFAULT);
                $id = $_SESSION['id_user'];
                $sql2 = "UPDATE tbl_admin SET name_admin = '$name_admin', email_admin = '$email_admin', profile_admin = '$profile_admin', password_admin = '$hash' WHERE id_user = '$id'";
                mysqli_query($db, "UPDATE tbl_user SET email = '$email_admin' WHERE id_user = '$id'");
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