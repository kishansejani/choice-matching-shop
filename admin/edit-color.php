<?php
include_once 'header.php';

$id = $_GET['e_id'];
if (isset($_POST['update_color'])) {
    $name = mysqli_real_escape_string($conn, $_POST['color_name']);
    $sequence = mysqli_real_escape_string($conn, $_POST['sequence']);
    mysqli_query($conn, "UPDATE `color` SET `color_name`='$name', `sequence`='$sequence' WHERE `id`='$id'");
    echo "<script>window.location.href='view-color.php?success=1'</script>";
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `color` WHERE `id`='$id'"));
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Color</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Color Name</label>
                            <input type="text" name="color_name" class="form-control" value="<?php echo $data['color_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Sequence Order</label>
                            <input type="number" name="sequence" class="form-control" value="<?php echo $data['sequence']; ?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update_color" class="btn btn-primary">Update Color</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
