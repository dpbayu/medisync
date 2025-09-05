<!-- PHP -->
<?php
require '../function.php';
require '../assets/libs/vendor/autoload.php';
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}
$page = 'invoice';
?>
<!-- PHP -->
<!DOCTYPE html>
<html lang="en">

<!-- Head Start -->
<?php require '../partialsPatient/head.php' ?>
<style>
    .table>:not(:first-child) {
        border-top: 0;
    }
</style>
<!-- Head End -->

<body>
    <!-- Header Start -->
    <?php require '../partialsPatient/header.php' ?>
    <!-- Header End -->
    <!-- Sidebar Start -->
    <?php require '../partialsPatient/sidebar.php' ?>
    <!-- Sidebar End-->
    <!-- Main Start -->
    <main id="main" class="main">
        <?php
        $sql = mysqli_query($db, "SELECT * FROM tbl_medical_record 
        INNER JOIN tbl_patient ON tbl_medical_record.id_patient = tbl_patient.id_patient
        INNER JOIN tbl_doctor ON tbl_medical_record.id_doctor = tbl_doctor.id_doctor
        INNER JOIN tbl_poly ON tbl_medical_record.id_poly = tbl_poly.id_poly");
        $data = mysqli_fetch_array($sql);
        ?>
        <section class="section dashboard">
            <form action="function.php" method="POST">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 border border-2">
                        <div class="d-flex justify-content-center p-3">
                            <img class="text-center" src="../assets/img/logo.png" alt="logo">
                        </div>
                        <hr>
                        <h2 class="text-center">Receipt</h2>
                        <hr>
                        <div class="d-flex">
                            <div class="col-md-4">
                                <div class="d-flex">
                                    <label style="width: 125px;">Doctor</label>
                                    <p class="mx-3">:</p>
                                    <p><?= $data['name_doctor'] ?></p>
                                </div>
                                <div class="d-flex">
                                    <label style="width: 125px;">Date</label>
                                    <p class="mx-3">:</p>
                                    <p><?= date("j / m / Y", strtotime($data['check_up'])) ?></p>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="fw-semibold">No</th>
                                    <th class="fw-semibold">Medicine</th>
                                    <th class="fw-semibold">Quantity</th>
                                    <th class="fw-semibold">Price</th>
                                    <th class="fw-semibold">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = @$_GET['id'];
                                $grand_total = 0;
                                $medicine_item[] = '';
                                $query_medicine = "SELECT * FROM tbl_hospital_medicine
                                INNER JOIN tbl_medicine ON tbl_hospital_medicine.id_medicine = tbl_medicine.id_medicine WHERE id_hospital = '$id'";
                                $run_medicine = mysqli_query($db, $query_medicine);
                                $i = 1;
                                while ($medicine = mysqli_fetch_array($run_medicine)) {
                                    $medicine_item[] = $medicine['name_medicine'] .' ('.$medicine['qty_medicine'].' x Rp '.number_format($medicine['price_medicine'], 0, ',', '.').' ) <br> ';
                                    $total_medicine = implode($medicine_item);
                                    $grand_total += ($medicine['qty_medicine'] * $medicine['price_medicine']);
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $medicine['name_medicine'] ?></td>
                                        <td><?= $medicine['qty_medicine'] ?></td>
                                        <td><?= 'Rp ' . number_format($medicine['price_medicine'], 0, ',', '.') ?></td>
                                        <td>
                                            <div class="d-none">
                                                <span>Rp <?= $sub_total = ($medicine['price_medicine'] * $medicine['qty_medicine']); ?>/-</span>
                                            </div>
                                            <span>Rp <?= number_format($sub_total, 0, ',', '.') ?></span>
                                        </td>
                                    </tr>
                                <?php
                                    $grand_total + $sub_total;
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <p>Total : <span>Rp <?= number_format($grand_total, 0, ',', '.'); ?></span></p>
                        <a href="invoice.php" class="btn btn-secondary my-3">Back</a>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <!-- Main End -->
    <!-- Footer Start -->
    <?php require '../partialsPatient/footer.php' ?>
    <!-- Footer End -->
</body>

</html>