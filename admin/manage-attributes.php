<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'header.php';

// Handle Success/Error Messages
$msg = "";
if (isset($_GET['success'])) $msg = "<div class='alert alert-success'>Action performed successfully!</div>";
if (isset($_GET['error'])) $msg = "<div class='alert alert-danger'>Something went wrong!</div>";

// Handle Form Submissions
if (isset($_POST['add_category'])) {
    $name = mysqli_real_escape_string($conn, $_POST['category_name']);
    mysqli_query($conn, "INSERT INTO `category` (`category_name`) VALUES ('$name')");
    echo "<script>window.location.href='manage-attributes.php?success=1'</script>";
}

if (isset($_POST['add_subcategory'])) {
    $cat_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['subcategory_name']);
    mysqli_query($conn, "INSERT INTO `subcategory` (`category_id`, `subcategory_name`) VALUES ('$cat_id', '$name')");
    echo "<script>window.location.href='manage-attributes.php?success=1#subcategory'</script>";
}

if (isset($_POST['add_size'])) {
    $name = mysqli_real_escape_string($conn, $_POST['size_name']);
    mysqli_query($conn, "INSERT INTO `size` (`size_name`) VALUES ('$name')");
    echo "<script>window.location.href='manage-attributes.php?success=1#size'</script>";
}

if (isset($_POST['add_color'])) {
    $name = mysqli_real_escape_string($conn, $_POST['color_name']);
    mysqli_query($conn, "INSERT INTO `color` (`color_name`) VALUES ('$name')");
    echo "<script>window.location.href='manage-attributes.php?success=1#color'</script>";
}

// Handle Status Toggles
if (isset($_GET['toggle_status']) && isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    $status = $_GET['status'] == 1 ? 0 : 1;
    $table = "";
    if ($type == 'cat') $table = "category";
    if ($type == 'sub') $table = "subcategory";
    if ($type == 'size') $table = "size";
    if ($type == 'color') $table = "color";
    
    if ($table != "") {
        mysqli_query($conn, "UPDATE `$table` SET `status`='$status' WHERE `id`='$id'");
        echo "<script>window.location.href='manage-attributes.php?success=1#$type'</script>";
    }
}

// Handle Deletions
if (isset($_GET['delete']) && isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    $table = "";
    if ($type == 'cat') $table = "category";
    if ($type == 'sub') $table = "subcategory";
    if ($type == 'size') $table = "size";
    if ($type == 'color') $table = "color";
    
    if ($table != "") {
        mysqli_query($conn, "DELETE FROM `$table` WHERE `id`='$id'");
        echo "<script>window.location.href='manage-attributes.php?success=1#$type'</script>";
    }
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="heading-premium">Manage Product Attributes</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php echo $msg; ?>
            
            <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="cat-tab" data-toggle="tab" href="#category" role="tab">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sub-tab" data-toggle="tab" href="#subcategory" role="tab">Sub-Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="size-tab" data-toggle="tab" href="#size" role="tab">Sizes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="color-tab" data-toggle="tab" href="#color" role="tab">Colors</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Category Tab -->
                        <div class="tab-pane fade show active" id="category" role="tabpanel">
                            <form method="post" class="row mb-4">
                                <div class="col-md-9">
                                    <input type="text" name="category_name" class="form-control" placeholder="New Category Name" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="add_category" class="btn btn-primary btn-block">Add Category</button>
                                </div>
                            </form>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = mysqli_query($conn, "SELECT * FROM `category` ORDER BY id DESC");
                                    if ($res) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                            $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                            echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['category_name']}</td>
                                                <td><a href='?toggle_status=1&type=cat&id={$row['id']}&status={$row['status']}' class='btn btn-xs $status_btn'>$status_text</a></td>
                                                <td>
                                                    <a href='?delete=1&type=cat&id={$row['id']}' class='btn btn-danger btn-xs' onclick='return confirm(\"Are you sure?\")'><i class='fas fa-trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Subcategory Tab -->
                        <div class="tab-pane fade" id="subcategory" role="tabpanel">
                            <form method="post" class="row mb-4">
                                <div class="col-md-4">
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <?php
                                        $cats = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1");
                                        while ($c = mysqli_fetch_assoc($cats)) echo "<option value='{$c['id']}'>{$c['category_name']}</option>";
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="subcategory_name" class="form-control" placeholder="New Sub-Category Name" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="add_subcategory" class="btn btn-primary btn-block">Add Sub-Category</button>
                                </div>
                            </form>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Parent Category</th>
                                        <th>Sub-Category Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = mysqli_query($conn, "SELECT s.*, c.category_name FROM `subcategory` s JOIN `category` c ON s.category_id = c.id ORDER BY s.id DESC");
                                    if ($res) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                            $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                            echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['category_name']}</td>
                                                <td>{$row['subcategory_name']}</td>
                                                <td><a href='?toggle_status=1&type=sub&id={$row['id']}&status={$row['status']}' class='btn btn-xs $status_btn'>$status_text</a></td>
                                                <td>
                                                    <a href='?delete=1&type=sub&id={$row['id']}' class='btn btn-danger btn-xs' onclick='return confirm(\"Are you sure?\")'><i class='fas fa-trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Size Tab -->
                        <div class="tab-pane fade" id="size" role="tabpanel">
                             <form method="post" class="row mb-4">
                                <div class="col-md-9">
                                    <input type="text" name="size_name" class="form-control" placeholder="New Size (e.g. XL, XXL, 32, 40)" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="add_size" class="btn btn-primary btn-block">Add Size</button>
                                </div>
                            </form>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Size Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = mysqli_query($conn, "SELECT * FROM `size` ORDER BY id DESC");
                                    if ($res) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                            $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                            echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['size_name']}</td>
                                                <td><a href='?toggle_status=1&type=size&id={$row['id']}&status={$row['status']}' class='btn btn-xs $status_btn'>$status_text</a></td>
                                                <td>
                                                    <a href='?delete=1&type=size&id={$row['id']}' class='btn btn-danger btn-xs' onclick='return confirm(\"Are you sure?\")'><i class='fas fa-trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Color Tab -->
                        <div class="tab-pane fade" id="color" role="tabpanel">
                             <form method="post" class="row mb-4">
                                <div class="col-md-9">
                                    <input type="text" name="color_name" class="form-control" placeholder="New Color Name" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="add_color" class="btn btn-primary btn-block">Add Color</button>
                                </div>
                            </form>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Color Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $res = mysqli_query($conn, "SELECT * FROM `color` ORDER BY id DESC");
                                    if ($res) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $status_btn = $row['status'] == 1 ? "btn-success" : "btn-secondary";
                                            $status_text = $row['status'] == 1 ? "Active" : "Deactive";
                                            echo "<tr>
                                                <td>{$row['id']}</td>
                                                <td>{$row['color_name']}</td>
                                                <td><a href='?toggle_status=1&type=color&id={$row['id']}&status={$row['status']}' class='btn btn-xs $status_btn'>$status_text</a></td>
                                                <td>
                                                    <a href='?delete=1&type=color&id={$row['id']}' class='btn btn-danger btn-xs' onclick='return confirm(\"Are you sure?\")'><i class='fas fa-trash'></i></a>
                                                </td>
                                            </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>

<script>
// Handle Active Tab on Page Reload
$(document).ready(function(){
    var hash = window.location.hash;
    if(hash){
        $('.nav-tabs a[href="' + hash + '"]').tab('show');
    }
    
    // Update hash on tab click
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    });
});
</script>
