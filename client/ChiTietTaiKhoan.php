<?php
$userData = $_SESSION['user'];

function generateInputField($key, $value) {
    if ($key !== 'id' && $key !== 'password' && $key !== 'role' && $key !== 'image_url') {
        return "<div class='form-group'>
                    <label for='$key'>" . ucfirst($key) . "</label>
                    <input type='text' class='form-control' id='$key' value='$value'>
                </div>";
    }
}

if (isset($userData) && !empty($userData)) {
?>
    <div class='container profile-container'>
        <div class='row'>
            <div class='col-md-12 text-center'>
                <img src='<?= $userData['image_url'] ?>' alt='Profile Image' class='img-fluid rounded-circle profile-image'>
                <h2><?= $userData['username'] ?></h2>
                <p>Email: <?= $userData['email'] ?></p>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-12'>
                <h3>Sửa đổi thông tin</h3>
                <form>

<?php
    foreach ($userData as $key => $value) {
        echo generateInputField($key, $value);
    }
?>

                    <button type='submit' class='btn btn-primary'>Lưu</button>
                </form>
            </div>
        </div>
    </div>
<?php
} else {
    echo "Người dùng không tồn tại.";
}
?>
