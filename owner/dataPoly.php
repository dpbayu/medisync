<!-- PHP -->
<?php
require '../function.php';
require '../assets/libs/vendor/autoload.php';
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}
$polys = query("SELECT * FROM tbl_poly ORDER BY name_poly ASC");
$page = 'poly';
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
            <h1>Data Poly</h1>
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
                            <table id="poly" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="fw-semibold">No</th>
                                        <th class="fw-semibold">Name Poly</th>
                                        <th class="fw-semibold">Floor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach($polys as $poly) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $poly['name_poly'] ?></td>
                                        <td>Floor <?= $poly['desc_poly'] ?></td>
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
            $('#poly').DataTable({
                columnDefs: [{
                    "targets": '_all', visible: true
                }],
            });
        });
    </script>
    <!-- JS End -->
    <!-- Footer Start -->
    <?php require '../partialsOwner/footer.php' ?>
    <!-- Footer End -->
</body>

</html>