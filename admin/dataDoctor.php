<!-- PHP -->
<?php
require '../function.php';
require '../assets/libs/vendor/autoload.php';
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}
$page = 'doctor';
?>
<!-- PHP -->
<!DOCTYPE html>
<html lang="en">

<!-- Head Start -->
<?php require '../partialsAdmin/head.php' ?>
<style>
    img {
        object-fit: cover;
    }
</style>
<!-- Head End -->

<body>
    <!-- Header Start -->
    <?php require '../partialsAdmin/header.php' ?>
    <!-- Header End -->
    <!-- Sidebar Start -->
    <?php require '../partialsAdmin/sidebar.php' ?>
    <!-- Sidebar End-->
    <!-- Main Start -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Doctor</h1>
        </div>
        <div class="my-3">
            <a href="addDoctor.php" class="btn btn-primary">Add data</a>
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
                        <form action="" method="POST" name="process">
                            <table class="table table-bordered table-hover" id="doctor">
                                <thead>
                                    <tr>
                                        <th class="fw-semibold">No</th>
                                        <th class="fw-semibold">Name Doctor</th>
                                        <th class="fw-semibold">Specialist</th>
                                        <th class="fw-semibold">Address</th>
                                        <th class="text-center fw-semibold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = @$_GET['id_doctor'];
                                    $query_doctor = "SELECT * FROM tbl_doctor 
                                        INNER JOIN tbl_specialist ON tbl_doctor.id_specialist = tbl_specialist.id_specialist ORDER BY name_doctor ASC";
                                    $run_doctor = mysqli_query($db, $query_doctor);
                                    $i = 1;
                                    while ($doctor = mysqli_fetch_array($run_doctor)) {
                                    ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $doctor['name_doctor'] ?></td>
                                            <td><?= $doctor['name_specialist'] ?></td>
                                            <td><?= $doctor['address_doctor'] ?></td>
                                            <td class="text-center">
                                                <a href="editDoctor.php?id=<?= $doctor['id_doctor'] ?>" class="btn btn-warning m-1">Edit</a>
                                                <button type="button" class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#modal<?= $doctor['id_doctor'] ?>">
                                                    View
                                                </button>
                                                <a onclick="return confirm('Are you sure delete this data ?')" href="deleteDoctor.php?id=<?= $doctor['id_doctor'] ?>" class="btn btn-danger m-1">
                                                    Delete</a>
                                            </td>
                                        </tr>
                                        <!-- Modal Start -->
                                        <div class="modal fade" id="modal<?= $doctor['id_doctor'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Doctor <span class="fw-bold"><?= $doctor['name_doctor'] ?></span></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center mb-3">
                                                            <?php
                                                            if (empty($doctor['profile_doctor'])) {
                                                                echo "<img width='200' height='200' src='../assets/img/User.png' />";
                                                            } else {
                                                                echo "<img src='../doctor/img/" . $doctor['profile_doctor'] . "'
                                                                width='200' height='200' class='rounded-circle'
                                                                alt='Image Doctor'>";
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="d-flex">
                                                            <label style="width: 150px;">Name</label>
                                                            <p class="mx-3">:</p>
                                                            <p><?= $doctor['name_doctor'] ?></p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <label style="width: 150px;">Specialist</label>
                                                            <p class="mx-3">:</p>
                                                            <p><?= $doctor['name_specialist'] ?></p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <label style="width: 150px;">Phone</label>
                                                            <p class="mx-3">:</p>
                                                            <p><?= $doctor['phone_doctor'] ?></p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <label style="width: 150px;">Email</label>
                                                            <p class="mx-3">:</p>
                                                            <p><?= $doctor['email_doctor'] ?></p>
                                                        </div>
                                                        <div class="d-flex">
                                                            <label style="width: 150px;">Address</label>
                                                            <p class="mx-3">:</p>
                                                            <p><?= $doctor['address_doctor'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal End -->
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
        // Data Tables
        $(document).ready(function() {
            $('#doctor').DataTable({
                columnDefs: [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 4,
                }]
            });
        });
    </script>
    <!-- JS End -->
    <!-- Footer Start -->
    <?php require '../partialsAdmin/footer.php' ?>
    <!-- Footer End -->
</body>

</html>