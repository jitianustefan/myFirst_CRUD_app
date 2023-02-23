<?php 

class User{
    public $nume;
    public $prenume;
    public $email;
    private $parola;

    public function __construct(){


    }

    //Functia de inregistrare 

    public function register($nume,$prenume,$email,$parola){
        $this->setNume($nume);
        $this->setPrenume($prenume);
        $this->setEmail($email);
        $this->setParola($parola);
        
        $sql="SELECT id FROM `users` WHERE email='$this->email' LIMIT 1";
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $check = mysqli_query($conn,$sql);
        $count_row = mysqli_num_rows($check);

        //daca utilizatorul nu a fost inregistrat in baza de date, inregistreaza

        if($count_row == 0){
            $sql_ins="INSERT INTO `users` (`nume`,`prenume`,`email`,`parola`) VALUES ('$this->nume','$this->prenume','$this->email','$this->parola')";  
            $res= mysqli_query($conn, $sql_ins);
            if($res){
                return true;
            }else {
                return false;
            }
        }else{
        return false;
        }

    }
//Functia de logare 
    public function logare($umail,$upass){
        $sql="SELECT * FROM `users` WHERE email='$umail' LIMIT 1";
        $instance= Database::getInstance();
        $conn = $instance->getConnection();
        $res = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($res);
        if($rowCount == 1) {
            // $row = mysqli_fetch_assoc($res);
            // if(password_verify($upass, $row['parola'])){
                $row = mysqli_fetch_assoc($res);
                $upass=md5($upass);
                if ($upass == $row['parola']) {
                $_SESSION['user_session'] = $row['id'];
                return true;
            }else {
                return false;
            }
        }

    }

    public static function is_loggedin(){
        if(isset($_SESSION['user_session'])){
            return true;
        }
    }

    public static function is_admin($id){
        $sql = "SELECT tip_utilizator FROM `users` WHERE id=$id";
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $res2 = mysqli_query($conn,$sql);
        $res1 = mysqli_fetch_assoc($res2);
        $res = $res1['tip_utilizator'];
        return $res;
    }
    
    public static function logout(){
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

    public function read(){
        $sql = "SELECT * FROM `users` ORDER BY `id` DESC";
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $res = mysqli_query($conn,$sql);
        return $res;
    }
   

    public function redirect($url){
        header ("Location: $url");
    }

    public static function getUserIP(){
        if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])){
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        }elseif (filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else {
            $ip = $remote;
        }
        return $ip;
    }





    //Getter si Setter pentru variabile 

    public function setNume($nume){
        $this->nume=$nume;
    }
    public function getNume(){
        return $this->nume;
    }

    //

    public function setPrenume($prenume){
        $this->prenume=$prenume;
    }
    public function getPrenume(){
        return $this->prenume;
    }

    //

    public function setEmail($email){
        $this->email=$email;
    }
    public function getEmail(){
        return $this->email;
    }

    //

    public function setParola($parola){
        $this->parola=md5($parola);
    }
    public function getParla(){
        return $this->parola;
    }
   



}