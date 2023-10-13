<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/header.php';
?>


<section>
    <div class="container">
        <div class="toVidList">
            <a href="/studio?path=studio">Сгенерировать превью по видео<ion-icon name="arrow-forward-outline"></ion-icon></a>
            <a href="/upload/video/history">Посмотреть историю</a>
        </div>
        <br>
        <br>
        <div class="toVidList">
            <a href="/profile/upload?path=profile">Сгенерировать фотографию профиля<ion-icon name="arrow-forward-outline"></ion-icon></a>
            <a href="/upload/profile/history">Посмотреть историю</a>
        </div>
        <br>
        <br>
        <div class="toVidList">
            <a href="/banner?path=banner">Сгенерировать банер канала<ion-icon name="arrow-forward-outline"></ion-icon></a>
            <a href="/upload/banner/history">Посмотреть историю</a>
        </div>
    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/footer.php';
?>
