<?php 
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh sửa Hồ sơ</h5>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">Tên người dùng</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Địa chỉ Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="image">Tải ảnh lên</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" onchange="previewImage(this);">
                        </div>
                        <div class="form-group">
                            <?php if(!empty($user['image_url'])): ?>
                                <img src="uploads/<?= $user['image_url'] ?>" id="preview" class="img mt-2" alt="Ảnh Người dùng">
                            <?php else: ?>
                                <img src="placeholder_image.jpg" id="preview" class="img mt-2" alt="Ảnh Người dùng">
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu Thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#image').change(function(event) {
            var img = $('#preview');
            img.attr('src', URL.createObjectURL(event.target.files[0]));
        });
    });

</script>
