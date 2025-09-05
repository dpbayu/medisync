<!-- PHP -->
<?php
require '../function.php';
require '../assets/libs/vendor/autoload.php';
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}
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
        <div class="d-flex justify-content-end gap-1 mb-3">
            <a href="dataPoly.php" class="btn btn-info">Data</a>
            <a href="generatePoly.php" class="btn btn-primary">Add More</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="function.php" method="POST">
                    <input type="hidden" name="total" value="<?= @$_POST['count_add'] ?>">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Name Poly</th>
                            <th>Description</th>
                        </tr>
                        <?php
                        for ($i = 1; $i <= $_POST['count_add']; $i++) { 
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><input class="form-control" type="text" name="name_poly-<?= $i ?>" placeholder="Input poly" required></td>
                            <td><input class="form-control" type="text" name="desc_poly-<?= $i ?>" placeholder="Input description" required></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="form-group d-flex justify-content-end">
                        <input type="submit" name="addPoly" value="Save All" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- Main End -->
    <!-- Footer Start -->
    <?php require '../partialsAdmin/footer.php' ?>
    <!-- Footer End -->
</body>

</html>