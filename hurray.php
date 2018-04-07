<?php

include 'app.php';

if(App::isLoged()){
    if(!App::PersonalPass()) {
        App::redirect('/personal.php');
    }
}else{
    App::redirect('/registration.php');
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
                <div class="step activeStep">2</div>
                Վարկի պայմաններ
            </div>
            <div class="col-md-3">
                <div class="step activeStep">3</div>
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
        <h3>Hurray! We did that again !</h3>
    </div>
</div>
</body>
</html>
