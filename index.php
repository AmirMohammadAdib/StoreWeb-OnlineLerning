<?php

include "database/db.php";


// $email = $_SESSION['email'];
// $gt = $conn->prepare('SELECT * FROM users WHERE Email=?');

// $gt->bindValue(1, $email);
// $gt->execute();

// $gt = $gt->fetch(PDO::FETCH_ASSOC);


$menus = $conn->prepare('SELECT * FROM menus ORDER BY Sort');
$menus->execute();
$menus = $menus->fetchAll(PDO::FETCH_ASSOC);


$courses = $conn->prepare('SELECT * FROM course ORDER BY date DESC');
$courses->execute();
$courses = $courses->fetchAll(PDO::FETCH_ASSOC);


if (isset($_SESSION['login'])) {

    $user = $conn->prepare('SELECT * FROM users WHERE Id=?');
    $user->bindValue(1, $_SESSION['id']);
    $user->execute();
    $user = $user->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>

<body>
    <div class="background-image">

        <!-- header -->
        <br>
        <header style="display: contents;">
            <div class="header">
                <div class="container" style="
                display: flex;
                align-items: center;
                flex-direction: row-reverse;
                justify-content: space-between;">


                    <div class="row-right-header">
                        <div class="logo">
                            <!-- <img src="image/logo.svg" class="img-header"> -->
                            <p class="logo-txt">TopLearn</p>
                        </div>
                        <div class="window" onclick="sum()">
                            <div class="a"></div>
                            <div class="b"></div>
                            <div class="c"></div>

                        </div>
                        <div class="culomn-header">
                            <ul class="nav-item dropdown ul-header">
                                <?php foreach ($menus as $menu) {
                                    if ($menu['Z'] == 0) { ?>
                                        <li class="nav-item dropdown">
                                            <a href="<?php echo $menu['Src'] ?>" class="nav-link <?php foreach ($menus as $z) {
                                                                                                        if ($menu['Id'] == $z['Z']) {  ?> dropdown-toggle <?php }
                                                                                                                                                    }; ?> " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                <?php echo $menu['Title']; ?>
                                            </a>
                                            <?php foreach ($menus as $li) {
                                                if ($menu['Id'] == $li['Z']) { ?>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <?php foreach ($menus as $li) {
                                                            if ($menu['Id'] == $li['Z']) { ?>
                                                                <a class="dropdown-item" href="<?php echo $li['Src'] ?>">
                                                                    <?php echo $li['Title'] ?>
                                                                </a>
                                                        <?php };
                                                        }; ?>

                                                    </div>
                                            <?php }
                                            } ?>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['login'])) {
                    ?>

                        <?php if ($_SESSION['level'] == 2 or $_SESSION['level'] == 3 or $_SESSION['level'] == 4) { ?>
                            <div class="row-left-header" style="display: flex; align-items: center;">
                                <div class="profile">
                                    <img src="image/profile-img/<?php echo rand(1, 3) . '.png'; ?>">
                                    <p>
                                        <?php echo $_SESSION['username'] ?>
                                    </p><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16" id="icon-username">
                                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                                        </svg></span>
                                    <div class="box-profile">
                                        <div class="profile-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                            </svg>
                                            <h6>مشاهده حساب کاربری</h6>
                                        </div>
                                        <div class="profile-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                            </svg>
                                            <h6>ویرایش حساب کاربری</h6>
                                        </div>
                                        <div class="profile-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                            </svg>
                                            <a href="basket-store/basket.php">
                                                <h6>سبد خرید</h6>
                                            </a>
                                        </div>
                                        <div class="profile-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                                <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                                            </svg>
                                            <h6>کیف پول من</h6>
                                        </div>
                                        <div class="profile-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                            </svg>
                                            <h6>
                                                <a href="page/loginAdmin.php" style="color: #ffffff; text-decoration: none;"><?php if ($_SESSION['level'] == 2) {
                                                                                                                                    echo "پنل نویسندگان";
                                                                                                                                } elseif ($_SESSION['level'] == 3) {
                                                                                                                                    echo "پنل مدرسین";
                                                                                                                                } elseif ($_SESSION['level'] == 4) {
                                                                                                                                    echo "پنل مدیریت";
                                                                                                                                } ?></a>
                                            </h6>
                                        </div>

                                        <div class="profile-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                            </svg>
                                            <a href="page/logout.php">
                                                <h6>
                                                    <?php echo "خروج از حساب کاربری" ?>
                                                </h6>
                                            </a>
                                        </div>
                                    <?php } else { ?>

                                        <div class="row-left-header">
                                            <div class="profile">

                                                <?php foreach ($user as $u) { ?> <img src="image/profile-img/<?php echo $u['image'] . '.png'; ?>"><?php } ?>
                                                <p>
                                                    <?php echo $_SESSION['username'] ?>
                                                </p><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-down-square" viewBox="0 0 16 16" id="icon-username">
                                                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 2.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                                                    </svg></span>
                                                <div class="box-profile">
                                                    <div class="profile-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                                        </svg>
                                                        <h6>مشاهده حساب کاربری</h6>
                                                    </div>
                                                    <div class="profile-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                        </svg>
                                                        <h6>ویرایش حساب کاربری</h6>
                                                    </div>
                                                    <div class="profile-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <a href="basket-store/basket.php">
                                                            <h6>سبد خرید</h6>
                                                        </a>
                                                    </div>
                                                    <div class="profile-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                                                        </svg>
                                                        <h6>کیف پول من</h6>
                                                    </div>
                                                    <div class="profile-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                                                            <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                                                            <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <h6>فاکتور های من</h6>
                                                    </div>
                                                    <div class="profile-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                                            <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                                                        </svg>
                                                        <h6>
                                                            <a style="color: #ffffff; text-decoration: none;" href="page/my-course.php">ویدئو های من</a>
                                                        </h6>
                                                    </div>

                                                    <div class="profile-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                                        </svg>
                                                        <a href="page/logout.php">
                                                            <h6>
                                                                <?php echo "خروج از حساب کاربری" ?>
                                                            </h6>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php }; ?>

                                            </div>



                                        </div>

                                    <?php } else { ?>

                                        <div class="row-left-header">
                                            <span>
                                                <span><a href="page/register.php" style="color: #ffffff; text-decoration: none; font-size: 20px;">ثبت نام</a></span><span style="color: #ffffff;
                    flex-direction: row-reverse;
                    /* font-weight: 300; */
                    font-family: hekaiyat;
                    font-size: 14px;
                "> / </span><span><a href="page/login.php" style="color: #ffffff; text-decoration: none; font-size: 20px;">ورود</a></span>
                                            </span>

                                            <span><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person icon-user-header" viewBox="0 0 16 16">
                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                                </svg></span>


                                        </div>

                                    <?php } ?>
                                    </div>
                                </div>




                                <div class="back-side ">

                                </div>
        </header><br><br>
        <div class="titre ">
            <h1 class="titre-header ">
                خودآموزی ، کسب تجربه ، ورود به بازار کار با تاپ لرن<br> با کمترینــــ هزینه خودت حرفه ایــــ یاد بگیـر
            </h1>
        </div><br><br>

        <div class="searche-box ">
            <form method="POST ">
                <div>
                    <div class="inp ">
                        <img src="image/search.svg " class="searche-icon-center ">
                        <input type="text " name="search " class="form-control search-box-inp " style="padding: 25px; border-radius: 50px; " placeholder="چی میخوای یاد بگیری ">
                    </div>
                </div>
            </form>
        </div><br><br>

        <div class="introformation ">

            <div class="teacher-video ">
                <img src="image/stat-time.svg " alt="teacher-video ">
                <p>279,564 <br> دقیقه آموزش</p>
            </div>
            <div class="teacher-video ">
                <img src="image/stat-teacher.svg " alt="teacher-video ">
                <p>128 <br> مدرس مجرب</p>

            </div>
            <div class="teacher-video ">
                <img src="image/stat-student.svg " alt="teacher-video ">
                <p>277,531 <br> نفر دانشجو</p>

            </div>
        </div><br>
    </div><br>
    <!-- header -->

    <!-- content -->

    <div class="container">
        <div class="img-poster">
            <img src="image/4057b38e-da55-41c7-b858-ce6d54ca1c06بنرتاپلرن 2.png" style="border-radius: 10px; width: 100%;"><br><br>
        </div>
    </div>








    <div class="container ">
        <div class="cursor ">
            <div class="title ">
                <h1>آخرین دوره های تاپ لرن</h1>
            </div>
            <div class="product" style="flex-wrap: wrap;">
                <?php foreach ($courses as $course) { ?>
                    <div class="to-product ">
                        <div class="image-product ">
                            <a href="page/video.php?id=<?php echo $course['id']; ?>&course=<?php echo $course['slug']; ?>"><img src="uploader/uploads/<?php echo $course['image']; ?>" class="image-product "> </a>
                        </div>
                        <div class="titre-product">
                            <a href="page/video.php?id=<?php echo $course['id']; ?>" style="text-decoration: none;">
                                <h1 style="font-size: 0.8rem; line-height: 23px; margin-top: 10px;">
                                    <?php echo $course['title']; ?>
                                </h1>
                            </a>
                        </div>
                        <div class="teacher-product">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg " width="16 " height="16 " fill="currentColor " class="bi bi-person-fill " viewBox="0 0 16 16 ">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z " />
                                </svg>
                            </span>
                            <p>امیرمحمد ادیب</p>
                        </div>
                        <hr style="margin-top: -5px; ">
                        <div class="down-box-product ">
                            <div class="time-product ">
                                <span><svg xmlns="http://www.w3.org/2000/svg " width="16 " height="16 " fill="currentColor " class="bi bi-stopwatch " viewBox="0 0 16 16 ">
                                        <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z " />
                                        <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7
                                7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z " />
                                    </svg></span>
                                <p>55 : 21 : 12</p>
                            </div>
                            <div class="Price ">
                                <?php if ($course['value'] == 0) { ?>
                                    <p style="font-size: 20px;">رایگان</p>
                                <?php } else { ?>
                                    <p><span><?php echo $course['value'] ?></span> تومان</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div><br>
        <div class="all-blog">
            <a href="#">
                <p>تمامی دوره ها</p>
            </a>
            <div class="row-down">
                <div class="to-row"></div>
            </div>
        </div>
    </div><br class="br1"><br class="br1"><br class="br1">
    <!-- content -->


    <!-- slider -->

    <div class="slider-down ">
        <div class="img-background ">
            <div class="container ">
                <div class="row ">

                    <div style="display: flex; align-items: center; ">
                        <div class="slider-center ">
                            <div id="carouselExampleIndicators " class="carousel slide " data-ride="carousel ">
                                <ol class="carousel-indicators ">
                                    <li data-target="#carouselExampleIndicators " data-slide-to="0 " class="active "></li>
                                    <li data-target="#carouselExampleIndicators " data-slide-to="1 "></li>
                                    <li data-target="#carouselExampleIndicators " data-slide-to="2 "></li>
                                </ol>
                                <div class="carousel-inner ">
                                    <div class="carousel-item active ">
                                        <img class="d-block w-100 " style="border-radius: 10px; border: 2px solid rgba(79, 140, 225, 0.609); " src="image/4902a7e5-c795-444d-809e-3b94c4adcdd9Blender_آموزش_پروژه-محور(1).png " alt="First slide ">
                                    </div>
                                    <div class="carousel-item ">
                                        <img class="d-block w-100 " style="border-radius: 10px; border: 2px solid rgba(79, 140, 225, 0.609); " src="image/00de28ec-93d1-47ca-a1c3-8cfce8af70ceCQRS_به_همراه_الگوی_DDD_آموزش_معماری_مبتنی_بر.png " alt="Second
                                slide ">
                                    </div>
                                    <div class="carousel-item ">
                                        <img class="d-block w-100 " style="border-radius: 10px; border: 2px solid rgba(79, 140, 225, 0.609); " src="image/8ef6e06d-81bb-4396-8103-d8b5aac15f1fآموزش_فلاتر_پلاس.png " alt="Third slide ">
                                    </div>
                                </div>
                                <a class="carousel-control-prev " href="#carouselExampleIndicators " role="button " data-slide="prev ">
                                    <span class="carousel-control-prev-icon " aria-hidden="true "></span>
                                    <span class="sr-only ">Previous</span>
                                </a>
                                <a class="carousel-control-next " href="#carouselExampleIndicators " role="button " data-slide="next ">
                                    <span class="carousel-control-next-icon " aria-hidden="true "></span>
                                    <span class="sr-only ">Next</span>
                                </a>
                            </div>
                        </div>

                        <div class="text-slider-center ">
                            <h1>
                                استیو جابز : من فکر می‌کنم وقتی شما کاری انجام می‌دهید و نتیجه‌ی خوبی حاصل می‌شود نباید بیش از حد بر روام کاری شگفت‌انگیز بروید. فقط مرحله‌ی بعدی را پیدا کنید. رو به جلو حرکت کنید و هرگز دست از پیشرفت و ترقی برندارید
                            </h1>
                        </div>

                    </div>


                </div>
            </div>
        </div><br>
        <div class="titre-blog">
            <h1>اخرین بلاگ ها</h1>
        </div>
    </div><br>

    <!-- slider -->

    <!-- blog -->

    <div class="back-blog ">
        <div class="container ">
            <div class="row ">
                <div class="titre-blog2">
                    <h1>اخرین بلاگ ها</h1>
                </div>
                <div class="content-blog">
                    <div class="box-blog ">
                        <div class="img-box-blog">
                            <a href="#" class="up-img-blog-box" style="text-decoration: none;">
                                <button> ادامه
                                    <span></span>
                                </button>
                                <style>
                                    button {
                                        border: none;
                                        display: block;
                                        position: relative;
                                        padding: 0.7em 2.4em;
                                        font-size: 18px;
                                        background: transparent;
                                        cursor: pointer;
                                        user-select: none;
                                        overflow: hidden;
                                        color: #ffffff;
                                        z-index: 1;
                                        margin: 0 auto;
                                        font-family: sogand;
                                    }

                                    button span {
                                        position: absolute;
                                        left: 0;
                                        top: 0;
                                        width: 100%;
                                        height: 100%;
                                        background: transparent;
                                        z-index: -1;
                                        border: 2px solid #ffffff;
                                        border-radius: 5px;
                                    }

                                    button span::before {
                                        content: "";
                                        display: block;
                                        position: absolute;
                                        width: 8%;
                                        height: 500%;
                                        background: var(--lightgray);
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%) rotate(-60deg);
                                        transition: all 0.3s;
                                    }

                                    button:hover span::before {
                                        transform: translate(-50%, -50%) rotate(-90deg);
                                        width: 100%;
                                        background: #ffffff;
                                    }

                                    button:hover {
                                        color: rgb(96, 105, 124);
                                    }

                                    button:active span::before {
                                        background: #2751cd;
                                    }
                                </style>
                            </a>

                            <a href=""><img src="image/09-12-2021دوازده_مهارت_لازم_برای_توسعه_دهندگان_در_سال_2021.png" alt=""></a>
                        </div>
                        <div class="titre-blog-box">
                            <a href="#" style="text-decoration: none; color: rgb(62, 62, 62);">
                                <p style="margin-top: 4px;">تیتر بلاگ تست</p>
                            </a>
                        </div>
                        <div class="caption-box-blog">
                            <p>این یک کپشن تست برای بلاگ تست است و بعدا برایش کپشن از دیتابیس لود میکنیم تا زمانی که دیتابیس را راه اندازی کنیم این متن قرار دارد</p>
                        </div>
                        <div class="row-down-blog-box">
                            <div class="writer-blog">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                color: #1d77f5;
                margin-top: 3px;
                margin-left: 1px;" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                                <p>امیرمحمد ادیب</p>
                            </div>
                            <div class="two-own-blog">
                                <div class="comment-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="
                    margin-left: 3px;
                    margin-top: -10px;" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    <div class="number-comment-blog">
                                        <p>86</p>
                                    </div>
                                </div>

                                <div class="vio-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                    margin-top: 5px;
                    margin-left: 2px;
                " class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <div class="number-vio-blog">
                                        <p>326</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-blog ">
                        <div class="img-box-blog">
                            <a href="#" class="up-img-blog-box" style="text-decoration: none;">
                                <input type="submit" name="sub" class="btn-box-blog" value="ادامه">
                            </a>

                            <a href=""><img src="image/09-12-2021دوازده_مهارت_لازم_برای_توسعه_دهندگان_در_سال_2021.png" alt=""></a>
                        </div>
                        <div class="titre-blog-box">
                            <a href="#" style="text-decoration: none; color: rgb(62, 62, 62);">
                                <p style="margin-top: 4px;">تیتر بلاگ تست</p>
                            </a>
                        </div>
                        <div class="caption-box-blog">
                            <p>این یک کپشن تست برای بلاگ تست است و بعدا برایش کپشن از دیتابیس لود میکنیم تا زمانی که دیتابیس را راه اندازی کنیم این متن قرار دارد</p>
                        </div>
                        <div class="row-down-blog-box">
                            <div class="writer-blog">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                color: #1d77f5;
                                margin-top: 3px;
                                margin-left: 1px;" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                                <p>امیرمحمد ادیب</p>
                            </div>
                            <div class="two-own-blog">
                                <div class="comment-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="
                                    margin-left: 3px;
                                    margin-top: -10px;" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    <div class="number-comment-blog">
                                        <p>86</p>
                                    </div>
                                </div>

                                <div class="vio-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                    margin-top: 5px;
                                    margin-left: 2px;
                                " class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <div class="number-vio-blog">
                                        <p>326</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-blog ">
                        <div class="img-box-blog">
                            <a href="#" class="up-img-blog-box" style="text-decoration: none;">
                                <input type="submit" name="sub" class="btn-box-blog" value="ادامه">
                            </a>

                            <a href=""><img src="image/09-12-2021دوازده_مهارت_لازم_برای_توسعه_دهندگان_در_سال_2021.png" alt=""></a>
                        </div>
                        <div class="titre-blog-box">
                            <a href="#" style="text-decoration: none; color: rgb(62, 62, 62);">
                                <p style="margin-top: 4px;">تیتر بلاگ تست</p>
                            </a>
                        </div>
                        <div class="caption-box-blog">
                            <p>این یک کپشن تست برای بلاگ تست است و بعدا برایش کپشن از دیتابیس لود میکنیم تا زمانی که دیتابیس را راه اندازی کنیم این متن قرار دارد</p>
                        </div>
                        <div class="row-down-blog-box">
                            <div class="writer-blog">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                color: #1d77f5;
                                margin-top: 3px;
                                margin-left: 1px;" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                                <p>امیرمحمد ادیب</p>
                            </div>
                            <div class="two-own-blog">
                                <div class="comment-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="
                                    margin-left: 3px;
                                    margin-top: -10px;" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    <div class="number-comment-blog">
                                        <p>86</p>
                                    </div>
                                </div>

                                <div class="vio-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                    margin-top: 5px;
                                    margin-left: 2px;
                                " class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <div class="number-vio-blog">
                                        <p>326</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-blog ">
                        <div class="img-box-blog">
                            <a href="#" class="up-img-blog-box" style="text-decoration: none;">
                                <input type="submit" name="sub" class="btn-box-blog" value="ادامه">
                            </a>

                            <a href=""><img src="image/09-12-2021دوازده_مهارت_لازم_برای_توسعه_دهندگان_در_سال_2021.png" alt=""></a>
                        </div>
                        <div class="titre-blog-box">
                            <a href="#" style="text-decoration: none; color: rgb(62, 62, 62);">
                                <p style="margin-top: 4px;">تیتر بلاگ تست</p>
                            </a>
                        </div>
                        <div class="caption-box-blog">
                            <p>این یک کپشن تست برای بلاگ تست است و بعدا برایش کپشن از دیتابیس لود میکنیم تا زمانی که دیتابیس را راه اندازی کنیم این متن قرار دارد</p>
                        </div>
                        <div class="row-down-blog-box">
                            <div class="writer-blog">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                color: #1d77f5;
                                margin-top: 3px;
                                margin-left: 1px;" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                                <p>امیرمحمد ادیب</p>
                            </div>
                            <div class="two-own-blog">
                                <div class="comment-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="
                                    margin-left: 3px;
                                    margin-top: -10px;" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    <div class="number-comment-blog">
                                        <p>86</p>
                                    </div>
                                </div>

                                <div class="vio-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                    margin-top: 5px;
                                    margin-left: 2px;
                                " class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <div class="number-vio-blog">
                                        <p>326</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-blog ">
                        <div class="img-box-blog">
                            <a href="#" class="up-img-blog-box" style="text-decoration: none;">
                                <input type="submit" name="sub" class="btn-box-blog" value="ادامه">
                            </a>

                            <a href=""><img src="image/09-12-2021دوازده_مهارت_لازم_برای_توسعه_دهندگان_در_سال_2021.png" alt=""></a>
                        </div>
                        <div class="titre-blog-box">
                            <a href="#" style="text-decoration: none; color: rgb(62, 62, 62);">
                                <p style="margin-top: 4px;">تیتر بلاگ تست</p>
                            </a>
                        </div>
                        <div class="caption-box-blog">
                            <p>این یک کپشن تست برای بلاگ تست است و بعدا برایش کپشن از دیتابیس لود میکنیم تا زمانی که دیتابیس را راه اندازی کنیم این متن قرار دارد</p>
                        </div>
                        <div class="row-down-blog-box">
                            <div class="writer-blog">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                color: #1d77f5;
                                margin-top: 3px;
                                margin-left: 1px;" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                                <p>امیرمحمد ادیب</p>
                            </div>
                            <div class="two-own-blog">
                                <div class="comment-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="
                                    margin-left: 3px;
                                    margin-top: -10px;" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    <div class="number-comment-blog">
                                        <p>86</p>
                                    </div>
                                </div>

                                <div class="vio-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                    margin-top: 5px;
                                    margin-left: 2px;
                                " class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <div class="number-vio-blog">
                                        <p>326</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-blog ">
                        <div class="img-box-blog">
                            <a href="#" class="up-img-blog-box" style="text-decoration: none;">
                                <input type="submit" name="sub" class="btn-box-blog" value="ادامه">
                            </a>

                            <a href=""><img src="image/09-12-2021دوازده_مهارت_لازم_برای_توسعه_دهندگان_در_سال_2021.png" alt=""></a>
                        </div>
                        <div class="titre-blog-box">
                            <a href="#" style="text-decoration: none; color: rgb(62, 62, 62);">
                                <p style="margin-top: 4px;">تیتر بلاگ تست</p>
                            </a>
                        </div>
                        <div class="caption-box-blog">
                            <p>این یک کپشن تست برای بلاگ تست است و بعدا برایش کپشن از دیتابیس لود میکنیم تا زمانی که دیتابیس را راه اندازی کنیم این متن قرار دارد</p>
                        </div>
                        <div class="row-down-blog-box">
                            <div class="writer-blog">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                color: #1d77f5;
                                margin-top: 3px;
                                margin-left: 1px;" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg>
                                <p>امیرمحمد ادیب</p>
                            </div>
                            <div class="two-own-blog">
                                <div class="comment-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="
                                    margin-left: 3px;
                                    margin-top: -10px;" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    <div class="number-comment-blog">
                                        <p>86</p>
                                    </div>
                                </div>

                                <div class="vio-blog">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="
                                    margin-top: 5px;
                                    margin-left: 2px;
                                " class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    <div class="number-vio-blog">
                                        <p>326</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="all-blog">
                <a href="#">
                    <p>تمامی مقاله ها</p>
                </a>
                <div class="row-down">
                    <div class="to-row"></div>
                </div>
            </div>
        </div><br>
    </div>
















    <!-- footer -->
    <div class="footer ">

        <p class="txt-footer ">تمامی حقوق مادی و معنوی این وبسایت متعلق به تاپ لرن میباشد</p>
    </div>
    <!-- footer -->




</body>






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js " integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN " crossorigin="anonymous "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js " integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q " crossorigin="anonymous "></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js " integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl " crossorigin="anonymous "></script> -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js " integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo " crossorigin="anonymous "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 " crossorigin="anonymous "></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy " crossorigin="anonymous "></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="js/app.js "></script>



</html>