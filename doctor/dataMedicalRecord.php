<!-- PHP -->
<?php
require '../function.php';
require '../assets/libs/vendor/autoload.php';
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}
$page = 'medical_record';
?>
<!-- PHP -->
<!DOCTYPE html>
<html lang="en">

<!-- Head Start -->
<?php require '../partialsDoctor/head.php' ?>
<!-- Head End -->

<body>
    <!-- Header Start -->
    <?php require '../partialsDoctor/header.php' ?>
    <!-- Header End -->
    <!-- Sidebar Start -->
    <?php require '../partialsDoctor/sidebar.php' ?>
    <!-- Sidebar End-->
    <!-- Main Start -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Medical Record</h1>
        </div>
        <div class="my-3">
            <a href="addMedicalRecord.php" class="btn btn-primary">Add data</a>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_GET['success'])) {
                        $msg = $_GET['success'];
                        echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>' . $msg . '</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if (isset($_GET['failed'])) {
                        $msg = $_GET['failed'];
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>' . $msg . '</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    ?>
                    <div class="table">
                        <form action="function.php" method="POST">
                            <table class="table table-bordered table-hover" id="medical_record">
                                <thead>
                                    <tr>
                                        <th class="fw-semibold text-center">No</th>
                                        <th class="fw-semibold text-center">Date</th>
                                        <th class="fw-semibold text-center">Patient</th>
                                        <th class="fw-semibold text-center">Doctor</th>
                                        <th class="fw-semibold text-center">Medicine</th>
                                        <th class="fw-semibold text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $grand_total = 0;
                                    $query_data = "SELECT * FROM tbl_medical_record 
                                    INNER JOIN tbl_patient ON tbl_medical_record.id_patient = tbl_patient.id_patient
                                    INNER JOIN tbl_doctor ON tbl_medical_record.id_doctor = tbl_doctor.id_doctor
                                    WHERE tbl_medical_record.id_doctor = '".$_SESSION['id_doctor']."'
                                    ORDER BY id_hospital DESC";
                                    $run_data = mysqli_query($db, $query_data);
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($run_data)) {
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= date("j / m / Y", strtotime($data['check_up'])) ?></td>
                                        <td><?= $data['name_patient'] ?></td>
                                        <td><?= $data['name_doctor'] ?></td>
                                        <?php
                                            $sql_medicine = "SELECT * FROM tbl_hospital_medicine JOIN tbl_medicine 
                                            ON tbl_hospital_medicine.id_medicine = tbl_medicine.id_medicine 
                                            WHERE id_hospital = '$data[id_hospital]'";
                                            $run_medicine = mysqli_query($db, $sql_medicine);
                                            if (mysqli_num_rows($run_medicine) > 0) {
                                                $list_medicine = '';
                                                while ($data_medicine = mysqli_fetch_array($run_medicine)) {
                                                    $list_medicine .= $data_medicine['name_medicine'].' : '.$data_medicine['qty_medicine'].' packs '.'<br>';
                                                }
                                                echo "<td>{$list_medicine}</td>";
                                            } else {
                                                echo '<td class="text-center"><a class="btn btn-success" href="addMedicine.php?id='.$data['id_hospital'].'">Medicine</a></td>';
                                            }
                                            ?>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal<?= $data['id_hospital'] ?>">
                                                View
                                            </button>
                                            <?php
                                                    $sql_medicine = "SELECT * FROM tbl_pharmacist WHERE id_hospital = '$data[id_hospital]'";
                                                    $run_medicine = mysqli_query($db, $sql_medicine);
                                                    if (mysqli_num_rows($run_medicine) > 0) {
                                                        echo '<a class="btn btn-warning d-none" href="receipt.php?id='.$data['id_hospital'].'">Receipt</a>';
                                                    } else {
                                                        echo '<a class="btn btn-warning" href="receipt.php?id='.$data['id_hospital'].'">Receipt</a>';
                                                    }
                                                ?>
                                        </td>
                                    </tr>
                                    <!-- Modal View Start -->
                                    <div class="modal fade" id="modal<?= $data['id_hospital'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Medical Record
                                                        <span class="fw-bold"><?= $data['name_patient'] ?></span>
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">NIK</label>
                                                        <p class="mx-3">:</p>
                                                        <p><?= $data['nik_patient'] ?></p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">Name</label>
                                                        <p class="mx-3">:</p>
                                                        <p><?= $data['name_patient'] ?></p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">Place, date birth</label>
                                                        <p class="mx-3">:</p>
                                                        <p><?= $data['birth_place'] ?>,
                                                            <?= date("j F Y", strtotime($data['birth_date'])) ?>
                                                        </p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">Gender</label>
                                                        <p class="mx-3">:</p>
                                                        <p><?= $data['gender_patient'] ?></p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">Blood type</label>
                                                        <p class="mx-3">:</p>
                                                        <p><?= $data['blood_patient'] ?></p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">Diagnosis</label>
                                                        <p class="mx-3">:</p>
                                                        <p><?= $data['diagnosis'] ?></p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">Illness</label>
                                                        <p class="mx-3">:</p>
                                                        <p><?= $data['illness'] ?></p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">Medicine</label>
                                                        <p class="mx-3">:</p>
                                                        <p>
                                                            <?php
                                                                $sql_medicine = "SELECT * FROM tbl_hospital_medicine JOIN tbl_medicine 
                                                                ON tbl_hospital_medicine.id_medicine = tbl_medicine.id_medicine 
                                                                WHERE id_hospital = '$data[id_hospital]'";
                                                                $run_medicine = mysqli_query($db, $sql_medicine);
                                                                if (mysqli_num_rows($run_medicine) > 0) {
                                                                    while ($data_medicine = mysqli_fetch_array($run_medicine)) {
                                                                        echo $data_medicine['name_medicine'] . ' : ' . $data_medicine['qty_medicine'] . ' packs ' . '<br>';
                                                                    }
                                                                } else {
                                                                    echo '<p>-</p>';
                                                                }
                                                                ?>
                                                        </p>
                                                    </div>
                                                    <hr>
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Doctor</h1>
                                                    <div class="d-flex">
                                                        <label style="width: 125px;">Name</label>
                                                        <p class="mx-3">:</p>
                                                        <p><?= $data['name_doctor'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal View End -->
                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Main End -->
    <!-- JS Start -->
    <script>
        $(document).ready(function () {
            $('#medical_record').DataTable({
                columnDefs: [{
                    "searchable": false,
                    "orderable": false,
                    "targets": [4, 5],
                }]
            });
        });
    </script>
    <!-- JS End -->
    <!-- Footer Start -->
    <?php require '../partialsDoctor/footer.php' ?>
    <!-- Footer End -->
</body>

</html>