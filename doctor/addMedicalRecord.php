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
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.2/tinymce.min.js" integrity="sha512-AHsE0IVoihNpGako20z2Tsgg77r5h9VS20XIKa+ZZ8WzzXxdbiUszgVUmXqpUE8GVUEQ88BKQqtlB/xKIY3tUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>tinymce.init({ selector:'textarea'});</script>
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
        <section class="section dashboard">
            <div class="row">
                <div class="col-md-12">
                    <form action="function.php" method="POST">
                        <div class="form-group mb-3">
                            <label class="form-label" for="check_up_date">Check Up Date</label>
                            <input class="form-control" type="date" id="check_up_date" name="check_up" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="doctor">Doctor</label>
                            <input class="form-control" type="text" id="name" name="id_doctor" value="<?php echo $_SESSION['id_doctor'] ?>">
                        </div>
                        <div class="d-flex gap-5">
                            <div class="form-group mb-3 col">
                                <label class="form-label" for="patient">Patient</label>
                                <select class="form-control" name="id_patient" id="patient">
                                    <option value="">- Choose Patient -</option>
                                    <?php
                                    $sql_pasien = mysqli_query($db, "SELECT * FROM tbl_patient");
                                    while ($data_pasien = mysqli_fetch_array($sql_pasien)) {
                                        echo '<option value="' . $data_pasien['id_patient'] . '">' . $data_pasien['name_patient'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex gap-5">
                            <div class="form-group mb-3 col">
                                <label class="form-label" for="diagnosis">Diagnosis</label>
                                <textarea class="form-control" name="diagnosis" placeholder="Input diagnosis"></textarea>
                            </div>
                            <div class="form-group mb-3 col">
                                <label class="form-label" for="illness">Illness</label>
                                <textarea class="form-control" name="illness" placeholder="Input illness"></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-success" type="submit" name="addMedicalRecord">Add</button>
                            <button class="btn btn-danger" type="reset" name="reset" value="Reset">Reset</button>
                            <a href="dataMedicalRecord.php" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- Main End -->
    <!-- JS -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#medicine').select2({
                placeholder: "Choose Medicine",
                allowClear: true,
                language: "id"
            });
        });
        tinymce.init({
            selector: 'textarea#default'
        });
    </script>
    <!-- JS -->
    <!-- Footer Start -->
    <?php require '../partialsDoctor/footer.php' ?>
    <!-- Footer End -->
</body>

</html>