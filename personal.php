<?php

include 'app.php';
include 'forms/personalForm.php';

if(App::isLoged()){
    if(App::PersonalPass()) {
        App::redirect('/hurray.php');
    }else{
        if(!App::LoanPass()){
            App::redirect('/loan.php');
        }
    }
}else{
    App::redirect('/registration.php');
}
$form = new PersonalForm();
$years = App::getYears();
$getMonth = App::getMonth();


if(!empty($_POST)) {

    $form->setAttributes($_POST);
    $form->validate();

    if (!$form->hasErrors()) {

        (new DB())->UpdateLoadData($form);
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
         <form action="" method="POST">
                <div>
                    <input type="text" id="name" name="name"
                           class="JustInput" placeholder="Անուն*" value="<?= $form->name?>">
                    <div><small class="error"><?= $form->getError('name') ?></small></div>
                </div>
                <br>
                <div>
                    <input type="text" id="surname" name="surname"
                           class="JustInput" placeholder="Ազգանուն*"
                           value="<?= $form->surname?>">
                    <div><small class="error"><?= $form->getError('surname') ?></small></div>

                </div>
                <br>
                <div>
                    <label> Նշեք Ձեր Սեռը</label>
                    <div class="sex_radio">
                        <label><input type="radio" name="men" <?= $form->sex == 'men' ? 'checked' : ''?>> Արրական </label>

                        <label><input type="radio" name="women" <?= $form->sex == 'women' ? 'checked' : ''?>> Իգական </label>
                    </div>
                    <input type="hidden" name="sex" value="<?= $form->sex ?>">
                    <div><small class="error"><?= $form->getError('sex') ?></small></div>
                </div>
                <br>
                <div>

                    <label for="sex"> Ծննդյան Տարեթիվ </label>

                    <div class="DOB">
                        <div class="row">
                            <div class="col-md-4">
                                <select id="year" name="year" class="SelectBox">
                                    <option value="">Տարի</option>
                                    <?php  foreach ($years as $key=>$value){?>
                                        <option value="<?= $value ?>"
                                            <?= $form->year == $value ? 'selected' : ''?>> <?= $value?></option>
                                    <?php } ?>
                                </select>
                                <div><small class="error"><?= $form->getError('year') ?></small></div>
                            </div>
                            <div class="col-md-4">
                                <select id="month" name="month" class="SelectBox">
                                    <option value=""> Ամիս</option>
                                    <?php  foreach ($getMonth as $key=>$value){?>
                                        <option value="<?= $key ?>" <?= $form->month == $value ? 'selected' : ''?>><?= $value?></option>
                                    <?php } ?>
                                </select>
                               <div> <small class="error"><?= $form->getError('month') ?></small></div>
                            </div>
                            <div class="col-md-4">
                                <select id="day" name="day" class="SelectBox">
                                    <option> Օր</option>
                                </select>
                               <div> <small class="error"><?= $form->getError('day') ?></small></div>
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <div>
                    <input id="address" type="text" name="address" class="JustInput" placeholder="Բնակության հասցե"
                           value="<?= $form->address?>">
                    <div><small class="error"><?= $form->getError('address') ?></small></div>
                </div>
                <br>
                <div>
                    <input id="family_count" type="number" name="family_count" class="JustInput"
                           placeholder="Ընտանիքի Անդամների Քանակ"
                           value="<?= $form->family_count?>">
                    <div><small class="error"><?= $form->getError('family_count') ?></small></div>
                </div>
                <br>
                <div>
                    <label> Անձը Հաստատող փաստաթուղթ </label>
                    <div class="identity_type_radio">
                        <label><input type="radio" name="passport" <?= $form->identity_type == 'passport' ? 'checked' : ''?>> Անձնագիր </label>

                        <label><input type="radio" name="id_cart" <?= $form->identity_type == 'id_cart' ? 'checked' : ''?>>Նույնականացման քարտ</label>
                    </div>
                    <input id="identity_type" type="hidden" name="identity_type" value="<?= $form->identity_type?>">
                    <div><small class="error"><?= $form->getError('identity_type') ?></small></div>
                </div>
                <br>
                <div>
                    <input id="identity_number" type="text" name="identity_number" class="JustInput"
                           placeholder="Անձը հաստատող փաստաթուղթի սերիա* "
                           value="<?= $form->identity_number?>"
                    >
                    <div><small class="error"><?= $form->getError('identity_number') ?></small></div>
                </div>
                <br>
                <div>
                    <label> Տրված է </label>

                    <div class="row">
                        <div class="col-md-4">
                            <select id="given_year" name="given_year" class="SelectBox">
                                <option value="">Տարի</option>
                                <?php foreach ($years as $key=>$value){?>
                                    <option value="<?= $value?>" <?= $form->given_year == $value ? 'selected' : ''?>><?= $value?></option>
                                <?php }?>
                            </select>
                            <div><small class="error"><?= $form->getError('given_year') ?></small></div>
                        </div>
                        <div class="col-md-4">
                            <select id="given_month" name="given_month" class="SelectBox">
                                <option value=""> Ամիս</option>
                                <?php foreach ($getMonth as $key=>$value){?>
                                    <option value="<?= $key?>" <?= $form->given_month == $value ? 'selected' : ''?>><?= $value?></option>
                                <?php }?>
                            </select>
                            <div><small class="error"><?= $form->getError('given_month') ?></small></div>
                        </div>
                        <div class="col-md-4">
                            <select id="given_day" name="given_day" class="SelectBox">
                                <option> Օր</option>
                            </select>
                            <div><small class="error"><?= $form->getError('given_day') ?></small></div>
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    <input id="given_person" type="text" name="given_person" class="JustInput"
                           placeholder="Ում կողմից *"
                           value=" <?= $form->given_person ?>"
                    >
                    <div><small class="error"><?= $form->getError('given_person') ?></small></div>
                </div>
                <br>
                <button type="submit" class="continue"> Շարունակել</button>
            </form>
        </div>
    </div>
</body>
</html>