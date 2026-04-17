<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'header.php';

// Handle Form Submission
if (isset($_POST['update_contact'])) {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $map = mysqli_real_escape_string($conn, $_POST['map_link']);
    
    mysqli_query($conn, "UPDATE `contact_info` SET `address`='$address', `mobile`='$mobile', `email`='$email', `map_link`='$map' WHERE `id`=1");
    echo "<script>window.location.href='manage-contact.php?success=1'</script>";
}

$query = mysqli_query($conn, "SELECT * FROM `contact_info` WHERE `id`=1");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    // Re-insert if missing
    mysqli_query($conn, "INSERT INTO `contact_info` (`id`, `address`, `mobile`, `email`, `map_link`) VALUES (1, '', '', '', '')");
    $data = ['address' => '', 'mobile' => '', 'email' => '', 'map_link' => ''];
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="heading-premium">Manage Store Contact Info</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_GET['success'])) echo "<div class='alert alert-success'>Contact info updated successfully!</div>"; ?>
            
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Store Details</h3>
                </div>
                <form method="post" class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Store Address</label>
                            <textarea name="address" class="form-control" rows="3" required><?php echo $data['address']; ?></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Google Map Link (Embed/URL)</label>
                            <textarea name="map_link" class="form-control" rows="3" required><?php echo $data['map_link']; ?></textarea>
                            <small class="text-muted">Paste the Google Maps 'Embed a map' HTML or direct link.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Contact Mobile</label>
                            <input type="text" name="mobile" class="form-control" value="<?php echo $data['mobile']; ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Contact Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" name="update_contact" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Current Map Preview</h3>
                </div>
                <div class="card-body text-center p-0">
                    <div style="width: 100%; height: 400px; background: #eee; overflow: hidden;">
                        <?php 
                        if (strpos($data['map_link'], '<iframe') !== false) {
                            echo $data['map_link'];
                        } else {
                            echo "<iframe src='{$data['map_link']}' width='100%' height='400' frameborder='0' style='border:0;' allowfullscreen='' aria-hidden='false' tabindex='0'></iframe>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>
<style>
    iframe { width: 100% !important; height: 100% !important; border:0 !important; }
</style>
