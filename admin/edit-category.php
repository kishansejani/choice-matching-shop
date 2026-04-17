<?php
include_once 'header.php';

$id = $_GET['e_id'];
if (isset($_POST['update_category'])) {
    $name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $sequence = mysqli_real_escape_string($conn, $_POST['sequence']);
    mysqli_query($conn, "UPDATE `category` SET `category_name`='$name', `sequence`='$sequence' WHERE `id`='$id'");
    echo "<script>window.location.href='view-category.php?success=1'</script>";
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `category` WHERE `id`='$id'"));
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Category</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="category_name" class="form-control" value="<?php echo $data['category_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Sequence Order</label>
                            <input type="number" name="sequence" class="form-control" value="<?php echo $data['sequence']; ?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update_category" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
