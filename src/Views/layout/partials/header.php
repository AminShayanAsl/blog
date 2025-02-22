<div class="fixed-top bg-light mb-4 border-bottom border-secondary box-shadow">
    <nav class="container navbar navbar-expand-lg navbar-light">
        <div class="navbar-brand text-info font-weight-bold">Blog</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-right font-weight-bold" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">خانه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">حساب کاربری</a>
                </li>
                <?php
                if (isset($_SESSION['user_id'])) {
                ?>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="/logout">خروج</a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</div>
