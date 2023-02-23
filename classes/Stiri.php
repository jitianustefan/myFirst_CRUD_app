<?php

class Stiri {
    const TABLENAME = 'stire';

    public $titlu;
    public $poza;
    public $categorie;
    public $continut;

    // metoda care seteaza atributele

    public function setTitlu($titlu_stire){
        $this->titlu = filter_var( $titlu_stire, FILTER_SANITIZE_STRING);
    }
    public function setCategorie($categorie_stire){
        $this->categorie = filter_var( $categorie_stire, FILTER_SANITIZE_STRING);
    }
    public function setContinut($continut_stire){
        $this->continut = filter_var( $continut_stire, FILTER_SANITIZE_STRING);
    }
    public function setIdUtilizator($id_utilizator){
        $this->id_utilizator = filter_var( $id_utilizator, FILTER_SANITIZE_STRING);
    }
    public function setIdStire($id_stire){
        $this->id_stire = filter_var( $id_stire, FILTER_SANITIZE_STRING);
    }
    public function setContinut_comm($continut_comm){
        $this->continut_comm = filter_var( $continut_comm, FILTER_SANITIZE_STRING);
    }

    // metoda care ofera informatii despre valoarea atributelor

    public function getTitlu(){
        return $this->titlu;
    }
    public function getCategorie(){
        return $this->categorie;
    }
    public function getContinut(){
        return $this->continut;
    }

    public function getPoza(){
        return $this->poza;
    }

    public function getIdUtilizator(){
        return $this->id_utilizator;
    }
    public function getIdStire(){
        return $this->id_stire;
    }
    public function getContinut_comm(){
        return $this->continut_comm;
    }
    

    public function comentariu($continut_comm,$id_utilizator,$id_stire){
        $this->setContinut_comm($continut_comm);
        $this->setIdUtilizator($id_utilizator);
        $this->setIdStire($id_stire);

        $sql = "INSERT INTO `comentariu` (`text`, `id_utilizator`, `stirea`) VALUES ('$this->continut_comm', '$this->id_utilizator', '$this->id_stire')";

        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $res = mysqli_query($conn,$sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    //seteaza poza

//     public function setPoza($poza){
// $target_dir = "assets/images/";
// $target_file= $target_dir . basename($_FILES["poza"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// if(isset($_POST["submit"])){
//     $check = getimagesize($_FILES["poza"]["tmp_name"]);
//     if($check !== false) {
//         echo " File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }

// //verifica daca imaginea exista 

// if(file_exists($target_file)){
//     echo "Poza deja exista" ;
//     $uploadOk = 0;
// }

// //verifica dimensiunea pozei

// if ($_FILES['poza']["size"] > 500000) {
//     echo "Dimensiunea este prea mare ";
//     $uploadOk = 0;
// }
// //Verifica formatul
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
//     echo "Accept doar formate de tip jpg , png, jpeg, gif. ";
//     $uploadOk = 0;
// }

// //Verifica daca existavreo eroare
// if($uploadOk ==0){
//     echo "Poza dumneavoastra nu a fost inserata ";
// }else {
//     if(move_uploaded_file($_FILES["poza"]["tmp_name"], $target_file)){
//         echo "Poza " . htmlspecialchars( basename( $_FILES["poza"]["name"]) . "a fost uploadata");
//     }else {
//         echo "Scuze, a aparut o eroare in incarcarea imaginii dvs.";
//     }
// }
//     }
    
public function setPoza($poza)
{
      if (isset($poza)) {

           $upload = new Uploader($poza);
           $upload->allowed_extensions(array("png", "jpg", "jpeg", "gif"));
           $upload->max_size(5); // in MB
           $upload->path("assets/images");
           $upload->encrypt_name();
           
           if (! $upload->upload()) {
           echo "Upload error: " . $upload->get_error();
           $this->poza ='';
           } else {
           //echo "Upload successful!";
            $this->poza = $upload->get_name();
           }
      }
}



  //  introducerea datelor in tabela





  
    public function create() {
        $sql = "INSERT INTO " . self::TABLENAME . " (`titlu`, `poza`, `categorie`, `continut`) VALUES ('$this->titlu', '$this->poza', '$this->categorie', '$this->continut')";

        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $res = mysqli_query($conn,$sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function read($id=null){
        $sql = "SELECT * FROM " . self::TABLENAME;
        if($id){
            $sql .= " WHERE id=$id";
        }else {
            $sql .=" ORDER BY id DESC";
        }
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $res=mysqli_query($conn, $sql);
        return $res;
    }

    public function read33($categorie=NULL){
        $sql = "SELECT id, titlu, poza, continut FROM " . self::TABLENAME; 
        if($categorie){
            $sql .=  " WHERE categorie='$categorie' ORDER BY id DESC";
        }else {
            $sql .=" ORDER BY id DESC";
        }
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $res=mysqli_query($conn, $sql);
        return $res;

    }

   
 

    public function afiscom($id_stire){
        $this->setIdStire($id_stire);
        $sql = "SELECT * FROM `comentariu` WHERE `stirea`='$this->id_stire' ORDER BY id DESC"; 
        $instance= Database::getInstance();
        $conn= $instance->getConnection();
        $res = mysqli_query($conn, $sql);
        return $res;
    }
    

    public function update($id){
        $sql= "UPDATE " . self::TABLENAME . " SET 
        titlu= '$this->titlu',
        poza='$this->poza',
        categorie='$this->categorie',
        continut='$this->continut'
        WHERE id=$id";

    $instance= Database::getInstance();
    $conn = $instance->getConnection();
    $res = mysqli_query($conn, $sql);
    if($res){
        return true;
    }else {
        return false;
        }
    }

    public function deletecom($id){
        // $this->deletePoza($id);

        $sql = "DELETE FROM `comentariu` WHERE id=$id";
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $res = mysqli_query($conn, $sql);
        if($res){
            return true;
        }else {
            return false;
        }
    }
   
    public function delete($id){
        // sa se stearga si fisierul din images
        $this->deletePoza($id);

      $sql = "DELETE FROM " . self::TABLENAME . " WHERE id=$id";
        $instance = Database::getInstance();
        $conn = $instance->getConnection();// se creeaza conexiunea la baza de date
        $res = mysqli_query($conn, $sql);
       if($res){
              
           return true;
       }else{
           return false;
       }
   }
   private function deletePoza($id){

        $sql = "SELECT poza FROM " . self::TABLENAME . " WHERE id=$id LIMIT 1";
        $instance = Database::getInstance();
        $conn = $instance->getConnection();// se creeaza conexiunea la baza de date
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_fetch_assoc($result);
        $poza = $row['poza'];
        unlink("assets/images/$poza");
   }
}