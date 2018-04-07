<?php
 require_once 'config.php';
 require_once 'db.php';

 class App
 {
     public static function redirect($url){
         header("location: $url" );
         die();
     }

     public static function isLoged(){
         return !empty($_SESSION['id']);
     }

     public static function login($id){

         $_SESSION['id']= $id;

     }

     public static function uploadFile($image){

         $uploaddir = 'uploads/';
         $uploadfile = $uploaddir . basename($image['name']);

         if (move_uploaded_file($image['path'], $uploadfile)) {
            echo "File is valid, and was successfully uploaded.\n";
         } else {
            echo "Possible file upload attack!\n";
         }
     }

     public static function imageCheck($file){

        $image = [];

        if(isset($file['image']['tmp_name']) && !empty($file['image']['tmp_name'])){

            list(,$type) = explode('/', $file['image']['type']);
            $image = [
                'name' => md5(time()).'.'. $type,
                'path' => $file['image']['tmp_name'] 
            ] ;    
       
        }       

        return $image;
     }

     public static function LoanPass(){

         $loanPass = false;
         $loan = (new DB())->selectLoan();
         if(!empty($loan)){
             $loanPass = true;
         }

         return $loanPass;
     }

     public static function getCountry(){
         return ['Երևան','Արագածոտն','Արարատ', 'Արմավիր','Գեղարքունիք','Կոտայք','Լոռի','Շիրակ','Սյունիք','Տավուշ',
             'Վայոց ձոր'];
     }

     public static function getYears(){
         return array_reverse(range(1950, date("Y")));
     }

     public static function getMonth(){
         return ['Հունվար','Փետրվար','Մարտ','Ապրիլ','Մայիս','Հունիս','Հուլիս','Օգոստոս','Սեպտեմբեր','Նոյեմբեր','Դեկտեմբեր',];
     }

     public static function PersonalPass(){

         $personalPass = false;

         $personal = (new DB())->selectLoan();
         if(!empty($personal) && isset($personal[0]['given_person']) && !is_null($personal[0]['given_person'])){
             $personalPass = true;
         }
         return $personalPass;
     }

     public static function checkLogin($form){

         $loged = false;
         $users = (new DB())->selectUser($form);
         if(!empty($users)){
             $loged = $users[0]['id'];
         }

         return $loged;
     }
 }