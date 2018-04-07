<?php

include 'app.php';
include 'forms/loginForm.php';
$form = new LoginForm();

if(App::isLoged()){
    App::redirect('/loan.php');
}



if(!empty($_POST)) {

    $form->setAttributes($_POST);
    $form->validate();

    if (!$form->hasErrors()) {
        $loged = App::checkLogin($form);
        if($loged){
            App::login($loged);
            App::redirect('/registration.php');
        }else{
            $form->addError('email', 'Սխալ Էլ հասցե');
            $form->addError('password', 'Սխալ Գաղտնաբառ');
        }
    }
}

?>

<html>
<head>

    <title>App Name </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="libs/bootstrap.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="libs/bootstrap-theme.css">
    <!-- Latest compiled and minified JavaScript -->
    <link  rel="stylesheet" href="libs/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="libs/jquery-3.3.1.js"></script>
    <script src="js/app.js"></script>
    <script src="libs/bootstrap.js"></script>

</head>
<body>

<div class="parentDiv Login">

    <form action="" method="POST">
        <h1> <span class="login_title">մուտք</span> </h1>
        <div class="emailDiv">
            <i class="fa fa-envelope-o login_email_icon"></i>
            <input type="text" placeholder="էլ հասցե" class="JustInput" name="email" value="<?= $form->email ?>">
        </div>
        <div class="errorParent">  <small class="error"><?= $form->getError('email') ?></small></div>

        <div class="emailDiv">
            <i class="fa fa-lock login_email_icon"></i>
            <input type="password" placeholder="Գաղտնաբառ" class="JustInput" name="password" value="<?= $form->password ?>">
        </div>
        <div class="errorParent">  <small class="error"><?= $form->getError('password') ?></small></div>

        <div>
            <button type="submit" class="continue"> մուտք </button>
        </div>
        <a href="/registration.php">
            Գրանցվել
        </a>
    </form>
</div>
</body>
</html>

