<?php
include 'app.php';
include 'forms/loanForm.php';

$form = new LoanForm();

$country = App::getCountry();

if(App::isLoged()){
    if(App::LoanPass()){
        App::redirect('/personal.php');
    }    
}else{
    App::redirect('/registration.php');
}

if(!empty($_POST)) {   

    $form->setAttributes($_POST);
    $form->validate();

    if (!$form->hasErrors()) {

        (new DB())->addLoadData($form);
        App::redirect('/personal.php');

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
                <div class="step activeStep">2</div>
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
    <div class="parentDiv loanMain">
        <form action="" method="POST">
            <div>
                <label >Արժույթ </label>
                <div class="currency_radio">
                    <div class="radio">
                        <label><input type="radio" name="AMD" <?= $form->currency == 'AMD' ? 'checked' : '' ?>> AMD</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="USA" <?= $form->currency == 'USA' ? 'checked' : '' ?>>USA</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="EUR" <?= $form->currency == 'EUR' ? 'checked' : '' ?>>EUR</label>
                    </div>
                    <input name="currency" type="hidden" value="<?= $form->currency?>">
                    <div>  <small class="error"><?= $form->getError('currency') ?></small></div>
                </div>
            </div>
            <div>
                <label for="money">Ւրքան գումար է ձեզ անհրաժեշտ</label>
                <input id="money" name="money" type="number" placeholder="գումարի չափը" class="JustInput" value"<?= $form->money ?>" >
                <div><small class="error"><?= $form->getError('money') ?></small></div>
            </div>

            <div>
                <label for="county">Որտեղ եք ցանկանում ստանալ վարկը</label>
                <select class="SelectBox" id="county" name="county">
                    <option value=""> Մարզ *</option>
                    <?php foreach ($country as $key => $value) {?>
                        <option value="<?= $value?>" <?= $form->county == $value ? 'selected' : '' ?>><?= $value?></option>
                    <?php }?>
                </select>
                <div> <small class="error"><?= $form->getError('county') ?></small></div>

            </div>

            <button type="submit" class="continue"> Շարունակել</button>
        </form>
    </div>
</div>

</body>
</html>