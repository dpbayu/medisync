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
<?php require '../partialsAdmin/head.php' ?>
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
            <h1>Data Poly</h1>
        </div>
        <div class="my-3">
            <a href="generatePoly.php" class="btn btn-primary">Add data</a>
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
                                        <th class="fw-semibold">Description</th>
                                        <th class="text-center">
                                            <input type="checkbox" id="select_all" value="">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach($polys as $poly) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $poly['name_poly'] ?></td>
                                        <td><?= $poly['desc_poly'] ?></td>
                                        <td class="text-center">
                                            <input type="checkbox" name="checked[]" class="check"
                                                value="<?= $poly['id_poly'] ?>" <?= $poly['id_poly'] ?>>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                        <div class="float-end border-0">
                            <button class="btn btn-warning" onclick="edit()">Edit</button>
                            <button class="btn btn-danger" onclick="hapus()">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Main End -->
    <!-- JS Start -->
    <script>
        // Function Checkbox
        $(document).ready(function () {
            $("#select_all").on('click', function () {
                if (this.checked) {
                    $('.check').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.check').each(function () {
                        this.checked = false;
                    });
                }
            });
            $('.check').on('click', function () {
                if ($('.check:checked').length == $('.check').length) {
                    $('#select_all').prop('checked', true)
                } else {
                    $('#select_all').prop('checked', false)
                }
            })
        });
        // Function Edit
        function edit() {
            document.process.action = 'editPoly.php';
            document.process.submit();
        }
        // Function Delete
        function hapus() {
            var conf = confirm('Are you sure ?'); {
                if (conf) {
                    document.process.action = 'deletePoly.php';
                    document.process.submit();
                }
            }
        }
        // Data Tables
        $(document).ready(function () {
            $('#poly').DataTable({
                columnDefs: [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 3,
                }],
            });
        });
    </script>
    <!-- JS End -->
    <!-- Footer Start -->
    <?php require '../partialsAdmin/footer.php' ?>
    <!-- Footer End -->
</body>

</html>