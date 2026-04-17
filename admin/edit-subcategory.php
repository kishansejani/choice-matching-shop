<?php
include_once 'header.php';

$id = $_GET['e_id'];
if (isset($_POST['update_subcategory'])) {
    $cat_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['subcategory_name']);
    $sequence = mysqli_real_escape_string($conn, $_POST['sequence']);
    mysqli_query($conn, "UPDATE `subcategory` SET `category_id`='$cat_id', `subcategory_name`='$name', `sequence`='$sequence' WHERE `id`='$id'");
    echo "<script>window.location.href='view-subcategory.php?success=1'</script>";
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `subcategory` WHERE `id`='$id'"));
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Sub-Category</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select name="category_id" class="form-control" required>
                                <?php
                                $cats = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1");
                                while ($c = mysqli_fetch_assoc($cats)) {
                                    $sel = ($c['id'] == $data['category_id']) ? "selected" : "";
                                    echo "<option value='{$c['id']}' $sel>{$c['category_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub-Category Name</label>
                            <input type="text" name="subcategory_name" class="form-control" value="<?php echo $data['subcategory_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Sequence Order</label>
                            <input type="number" name="sequence" class="form-control" value="<?php echo $data['sequence']; ?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="update_subcategory" class="btn btn-primary">Update Sub-Category</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
