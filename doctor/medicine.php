<!-- PHP -->
<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../loginDoctor.php");
    exit;
}
require "function.php";
$page = "patient";
$medicines = query("SELECT * FROM medicine ORDER BY id DESC");
?>
<!-- PHP -->
<!DOCTYPE html>
<html lang="en">

<!-- Head Start -->
<?php require "partials/head.php" ?>
<!-- Head End -->

<body>
    <!-- Header Start -->
    <?php require "partials/header.php" ?>
    <!-- Header End -->
    <!-- Sidebar Start -->
    <?php require "partials/sidebar.php" ?>
    <!-- Sidebar End -->
    <!-- Content Start -->
    <main id="main" class="main">
        <!-- Title Start -->
        <div class="pagetitle">
            <h1 class="text-center">Data Medical Record Patient</h1>
        </div>
        <!-- Title End -->
        <section class="section dashboard my-5">
            <div class="row">
                <!-- Alert Success Start -->
                <?php
                    if (isset($_GET['success'])) {
                        $msg = $_GET['success'];
                        echo '
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        '.$msg.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                ?>
                <!-- Alert Success Start -->
                <!-- Alert Failed Start -->
                <?php
                    if (isset($_GET['failed'])) {
                        $msg = $_GET['failed'];
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        '.$msg.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                ?>
                <!-- Alert Failed Start -->
                <table id="example" class="cell-border" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>KTP</th>
                            <th>Name</th>
                            <th>Birth</th>
                            <th>Gender</th>
                            <th>City</th>
                            <th style="width: 300px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach($users as $user) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $user["ktp"] ?></td>
                            <td><?= $user["fullname"] ?></td>
                            <td><?= date("j F Y", strtotime($user['birth_date'])) ?></td>
                            <td><?= $user["gender"] ?></td>
                            <td><?= $user["city"] ?></td>
                            <td class="d-flex justify-content-evenly">
                                <a class="btn btn-info" href="detailPatient.php?id=<?= $user["id"]; ?>"><i
                                        class="bi bi-eye"></i> Detail </a>
                                <a class="btn btn-warning" href="editPatient.php?id=<?= $user["id"]; ?>"><i
                                        class="bi bi-pencil"></i> Edit </a>
                                <a class="btn btn-danger" href="deletePatient.php?id=<?= $user["id"]; ?>"
                                    onclick="return confirm('Are you sure? ');"><i class="bi bi-trash"></i> Delete </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>KTP</th>
                            <th>Name</th>
                            <th>Birthd</th>
                            <th>Gender</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </main>
    <!-- Content End -->
    <!-- Footer Start -->
    <?php require "partials/footer.php" ?>
    <!-- Footer End -->
</body>

</html>