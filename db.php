<?php


class DB
{
    static private $handle;

    function __construct() {

        if(!self::$handle) {
            try {
                self::$handle = new PDO(DSN, USERNAME, PASSWORD);
                self::$handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$handle->exec("set names utf8");
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }

    }

    public function addUsers(RegistrationForm $form){
        $statement =  self::$handle->prepare("INSERT INTO users(email, password, image,created_at) VALUES(:email, :password, :image, :created_at)");
        $statement->execute([
            "email" => $form->email,
            "password" => sha1($form->password),
            "image" => $form->image,
            'created_at'=> date("Y-m-d H:i:s")
        ]);

        return self::$handle->lastInsertId();
    }

    public function addLoadData(LoanForm $form){

        $statement = self::$handle->prepare("INSERT INTO loans(user_id, currency, money, county) VALUES(:user_id, :currency, :money, :county)");
        $statement->execute(array(
            "user_id" => $_SESSION['id'],
            "currency" => $form->currency,
            "money" => $form->money,
            "county" => $form->county
        ));
    }

    public function UpdateLoadData(PersonalForm $form){

        $dob = $this->formatDate($form->month,$form->day, $form->year);

        $given_date =  $this->formatDate($form->given_month,$form->given_day, $form->given_year);

        $statement = self::$handle->prepare("
        UPDATE loans set
            name = :name,
            surname = :surname,
            sex = :sex,
            DOB = :DOB,
            address = :address,
            family_count = :family_count,
            identity_type = :identity_type,
            identity_number = :identity_number,
            given_date = :given_date,
            given_person = :given_person
        WHERE 
            user_id = :user_id
        ");
        $statement->execute(array(
            "name" => $form->name,
            "surname" => $form->surname,
            "sex" => $form->sex,
            "DOB" => $dob,
            "address" => $form->address,
            "family_count" => $form->family_count,
            "identity_type" => $form->identity_type,
            "identity_number" => $form->identity_number,
            "given_date" => $given_date,
            "given_person" => $form->given_person,
            "user_id"=> $_SESSION['id']
        ));
    }

    public function formatDate($month,$day,$year){

        $date_ = new DateTime("$month/$day/$year");
        $date = date_format($date_, 'Y-m-d');

        return $date;
    }



    public function selectLoan(){
        $statement = self::$handle->prepare("SELECT * FROM loans WHERE user_id = :user_id");
        $statement->execute(["user_id"=>$_SESSION['id']]);

        return $statement->fetchAll();
    }

    public function selectUser($form){

        $statement = self::$handle->prepare("SELECT * FROM users WHERE email = :email and password = :password");
        $statement->execute([
            "email" => $form->email,
            "password" => sha1($form->password)
        ]);

        return $statement->fetchAll();
    }

    public function checkUserExist($form){

        $statement = self::$handle->prepare("SELECT * FROM users WHERE email = :email ");
        $statement->execute([
            "email" => $form->email,
        ]);
        return $statement->fetchAll();
    }

}



