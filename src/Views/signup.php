<?php
ob_start();
?>

    <div class="center-box border box-shadow rounded">
        <h4 class="mb-5 font-weight-bold">ثبت نام</h4>
        <form method="post" action="/signup">
            <div class="form-group">
                <label for="usernameInput" class="h5 mb-3">نام کاربری</label>
                <input type="text" name="username" id="usernameInput" class="form-control" required dir="ltr">
            </div>
            <div class="form-group">
                <label for="passwordInput" class="h5 mb-3">رمز عبور</label>
                <input type="password" name="password" id="passwordInput" class="form-control" required dir="ltr">
            </div>
            <div class="d-flex justify-content-start mt-4">
                <button type="submit" class="btn btn-primary">ثبت نام</button>
                <a href="/login" class="btn btn-success mr-2">ورود</a>
            </div>
        </form>
    </div>

<?php
$content = ob_get_clean();

include 'layout/layout.php';

