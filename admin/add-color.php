<?php
include_once 'header.php';

if (isset($_POST['add_color'])) {
    $name = mysqli_real_escape_string($conn, $_POST['color_name']);
    $sequence = mysqli_real_escape_string($conn, $_POST['sequence']);
    mysqli_query($conn, "INSERT INTO `color` (`color_name`, `sequence`) VALUES ('$name', '$sequence')");
    echo "<script>window.location.href='view-color.php?success=1'</script>";
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Add New Color</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Color Name</label>
                            <input type="text" name="color_name" class="form-control" placeholder="Enter Color Name" required>
                        </div>
                        <div class="form-group">
                            <label>Sequence Order</label>
                            <input type="number" name="sequence" class="form-control" placeholder="Enter Sequence" value="0">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="add_color" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
