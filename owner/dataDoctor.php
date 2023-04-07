<!-- PHP -->
<?php
require '../function.php';
require '../assets/libs/vendor/autoload.php';
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}
$doctors = query("SELECT * FROM tbl_doctor 
INNER JOIN tbl_specialist ON tbl_doctor.id_specialist = tbl_specialist.id_specialist ORDER BY name_doctor ASC");
$page = 'doctor';
?>
<!-- PHP -->
<!DOCTYPE html>
<html lang="en">

<!-- Head Start -->
<?php require '../partialsOwner/head.php' ?>
<!-- Head End -->

<body>
    <!-- Header Start -->
    <?php require '../partialsOwner/header.php' ?>
    <!-- Header End -->
    <!-- Sidebar Start -->
    <?php require '../partialsOwner/sidebar.php' ?>
    <!-- Sidebar End-->
    <!-- Main Start -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Doctor</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_GET['success'])) {
                        $msg = $_GET['success'];
                        echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>'.$msg.'</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if (isset($_GET['failed'])) {
                        $msg = $_GET['failed'];
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>'.$msg.'</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    ?>
                    <div class="table">
                        <form action="" method="POST" name="process">
                            <table class="table table-bordered table-hover" id="doctor">
                                <thead>
                                    <tr>
                                        <th class="fw-semibold">No</th>
                                        <th class="fw-semibold">Name Doctor</th>
                                        <th class="fw-semibold">Specialist</th>
                                        <th class="fw-semibold">Address</th>
                                        <th class="fw-semibold">Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach($doctors as $doctor) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $doctor['name_doctor'] ?></td>
                                        <td><?= $doctor['name_specialist'] ?></td>
                                        <td><?= $doctor['address_doctor'] ?></td>
                                        <td><?= $doctor['phone_doctor'] ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
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
        // Data Tables
        $(document).ready(function () {
            $('#doctor').DataTable({
                columnDefs: [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 4
                }]
            });
        });
    </script>
    <!-- JS End -->
    <!-- Footer Start -->
    <?php require '../partialsOwner/footer.php' ?>
    <!-- Footer End -->
</body>

</html>