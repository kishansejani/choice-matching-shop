<?php
include_once 'header.php';

if (isset($_POST['add_size'])) {
    $name = mysqli_real_escape_string($conn, $_POST['size_name']);
    $sequence = mysqli_real_escape_string($conn, $_POST['sequence']);
    mysqli_query($conn, "INSERT INTO `size` (`size_name`, `sequence`) VALUES ('$name', '$sequence')");
    echo "<script>window.location.href='view-size.php?success=1'</script>";
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Add New Size</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Size Name</label>
                            <input type="text" name="size_name" class="form-control" placeholder="Enter Size (e.g. S, M, L)" required>
                        </div>
                        <div class="form-group">
                            <label>Sequence Order</label>
                            <input type="number" name="sequence" class="form-control" placeholder="Enter Sequence" value="0">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="add_size" class="btn btn-primary">Add Size</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
