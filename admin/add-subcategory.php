<?php
include_once 'header.php';

if (isset($_POST['add_subcategory'])) {
    $cat_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['subcategory_name']);
    $sequence = mysqli_real_escape_string($conn, $_POST['sequence']);
    mysqli_query($conn, "INSERT INTO `subcategory` (`category_id`, `subcategory_name`, `sequence`) VALUES ('$cat_id', '$name', '$sequence')");
    echo "<script>window.location.href='view-subcategory.php?success=1'</script>";
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Add New Sub-Category</h1>
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
                                <option value="">Select Category</option>
                                <?php
                                $cats = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1");
                                while ($c = mysqli_fetch_assoc($cats)) echo "<option value='{$c['id']}'>{$c['category_name']}</option>";
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub-Category Name</label>
                            <input type="text" name="subcategory_name" class="form-control" placeholder="Enter Sub-Category Name" required>
                        </div>
                        <div class="form-group">
                            <label>Sequence Order</label>
                            <input type="number" name="sequence" class="form-control" placeholder="Enter Sequence" value="0">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="add_subcategory" class="btn btn-primary">Add Sub-Category</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
