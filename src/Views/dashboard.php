<?php
ob_start();
?>
    <h3 class="mb-5 font-weight-bold">داشبورد</h3>
    <ul class="nav nav-tabs">
        <li><a class="btn btn-outline-info ml-2" data-toggle="tab" href="#likes">پسندیده ها</a></li>
        <?php if (\App\Helpers\Helper::highThanAdmin()) { ?>
            <li><a class="btn btn-outline-info ml-2" data-toggle="tab" href="#posts">مقالات شما</a></li>
            <li><a class="btn btn-outline-info ml-2" data-toggle="tab" href="#new-post">ثبت مقاله</a></li>
        <?php } ?>
        <?php if (\App\Helpers\Helper::isSuperAdmin()) { ?>
            <li><a class="btn btn-outline-info ml-2" data-toggle="tab" href="#users">کاربران</a></li>
        <?php } ?>
    </ul>

    <div class="tab-content mt-4">
        <div id="likes" class="tab-pane fade in active">
            <h3>مقالات مورد پسند شما</h3>
            <?php if (count($likes) > 0) { ;?>
                <?php foreach ($likes as $like) { ?>
                    <div class="rounded box-shadow p-4 mb-4">
                        <h3 class="font-weight-bold"><?= \App\Models\Post::getById($like['post_id'])['title'] ?></h3>
                        <h6 class="my-4 text-secondary">
                            <?= \App\Models\Post::getById($like['post_id'])['category'] ?> /
                            <span dir="ltr"><?= \App\Models\Post::getById($like['post_id'])['created_at'] ?></span> /
                            <?= \App\Models\Post::getLikesCount($like['post_id']) ?> لایک
                        </h6>
                        <h5 class="description"><?= \App\Models\Post::getById($like['post_id'])['description'] ?></h5>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="center-box font-weight-bold h3 text-secondary">تا کنون هیچ مقاله ای را نپسندیده اید.</div>
            <?php } ?>
        </div>
        <?php if (\App\Helpers\Helper::highThanAdmin()) { ?>
            <div id="posts" class="tab-pane fade in active">
                <h3>مقالات نوشته شده‌ شما</h3>
                <?php if (count($posts) > 0) { ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">عنوان</th>
                        <th scope="col">دسته‌بندی</th>
                        <th scope="col">توضیحات</th>
                    </tr>
                    </thead>
                    <tbody>
                <?php foreach ($posts as $post) { ?>
                    <tr>
                        <td><?= $post['title'] ?></td>
                        <td><?= $post['category'] ?></td>
                        <td><?= $post['description'] ?></td>
                    </tr>
                <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    <div class="center-box font-weight-bold h3 text-secondary">تا کنون هیچ مقاله ای را ثبت نکرده اید.</div>
                <?php } ?>
            </div>

            <div id="new-post" class="tab-pane fade in active">
                <h3>مقاله جدید</h3>
                <form method="post" action="/post">
                    <div class="form-group">
                        <label for="titleInput" class="h5 mb-3">عنوان</label>
                        <input type="text" name="title" id="titleInput" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryInput" class="h5 mb-3">دسته بندی</label>
                        <select id="categoryInput" class="form-control" name="category" required>
                            <option value="ورزشی">ورزشی</option>
                            <option value="خبری">خبری</option>
                            <option value="علمی">علمی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descriptionInput" class="h5 mb-3">توضیحات</label>
                        <textarea name="description" id="descriptionInput" class="form-control" required></textarea>
                    </div>
                    <div class="d-flex justify-content-start mt-4">
                        <button type="submit" class="btn btn-success">ثبت</button>
                    </div>
                </form>
            </div>
        <?php } ?>
        <?php if (\App\Helpers\Helper::isSuperAdmin()) { ?>
            <div id="users" class="tab-pane fade in active">
                <h3>کاربران</h3>
                <?php if (count($users) > 0) { ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">نام کاربری</th>
                        <th scope="col">تاریخ عضویت</th>
                    </tr>
                    </thead>
                    <tbody>
                <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <td class="text-right" dir="ltr"><?= $user['created_at'] ?></td>
                        </tr>
                <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    <div class="center-box font-weight-bold h3 text-secondary">هیچ کاربری به جز شما وجود ندارد.</div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

<?php
$content = ob_get_clean();

include 'layout/layout.php';
