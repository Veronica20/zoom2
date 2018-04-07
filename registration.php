<?php

include 'app.php';
include 'forms/registrationForm.php';
$form = new RegistrationForm();

// session_destroy();
if(App::isLoged()){
    App::redirect('/loan.php');
}

if(!empty($_POST)) {   

    $image = App::imageCheck($_FILES);

    $_POST['image'] = $image['path'] ?? '';
 
    $form->setAttributes($_POST);
    $form->validate();

    if (!$form->hasErrors()) {

        App::uploadFile($image);

        $form->image = $image['name'];

        App::login((new DB())->addUsers($form));
        App::redirect('/loan.php');

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
    <link href="libs/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" href="css/app.css">
    <script src="libs/jquery-3.3.1.js"></script>
    <script src="js/app.js"></script>
    <script src="libs/bootstrap.js"></script>

</head>
<body>
<div class="container">
    <div class="stepsDiv">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="step activeStep">1</div>
                <b>Գրանցման Տվյալներ</b>
            </div>
            <div class="col-md-3">
                <div class="step">2</div>
                Վարկի պայմաններ
            </div>
            <div class="col-md-3">
                <div class="step">3</div>
                Անձնական տվյալներ
            </div>
            <div class="col-md-2">
                <?php if(isset($_SESSION['id'])):?>
                    <div class="logOutClass"><a href="/logout.php">Logout</a></div>
                <?php else:?>
                    <div class="logOutClass"><a href="/">Login</a></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="parentDiv">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="FormDiv">
                <div>
                    <label for="email"> </label>
                    <input value="<?= $form->email ?>" id="email" type="text" name="email" class="JustInput" placeholder="<?= $form->getAttributeLabel('email') ?> *">
                    <small class="error"><?= $form->getError('email') ?></small>
                </div>
                <div>
                    <label for="confirm_email"> </label>
                    <input value="<?= $form->confirm_email ?>" id="confirm_email" type="text" name="confirm_email" class="JustInput"
                           placeholder="<?= $form->getAttributeLabel('confirm_email') ?>  *">
                    <small class="error"><?= $form->getError('confirm_email') ?></small>

                </div>
                <div>
                    <label for="password"> </label>
                    <input id="password" type="password" name="password" class="JustInput" placeholder="<?= $form->getAttributeLabel('password') ?>  *">
                    <small class="error"><?= $form->getError('password') ?></small>
                </div>
                <div>
                    <label for="confirm_password"> </label>
                    <input id="confirm_password" type="password" name="confirm_password" class="JustInput" placeholder="<?= $form->getAttributeLabel('confirm_password') ?>  *">
                    <small class="error"><?= $form->getError('confirm_password') ?></small>
                </div>
                <div>
                    <span>Ներբեռնել Լուսանկար *</span>
                    <input id="image" type="file" name="image">
                    <small class="error"><?= $form->getError('image') ?></small>
                </div>
            </div>
            <div>
                <button type="submit" class="continue"> Շարունակել </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>