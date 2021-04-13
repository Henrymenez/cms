<?php session_start();


$errorCount = 0;
$username = $_POST['username'] != "" ? $_POST['username'] : $errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['email'] = $email;
$_SESSION['username'] = $username;



if($errorCount > 0){
    $_SESSION["error"] = "You have " . $errorCount . " errors in your form";
    header("Location: ../password.php");
}else{
    $allUsers = scandir("../db/");
    $countAll = count($allUsers);

    for ($counter = 0; $counter < $countAll ; $counter++) { 
        $currentUser = $allUsers[$counter];
        
        if($currentUser == $email . ".json"){

            $userString = file_get_contents("../db/".$currentUser); 
            $userObject = json_decode($userString);
            $passwordDB = $userObject->password;
            $usernameDB = $userObject->username;

             if($username != $usernameDB){
                $_SESSION["error"] = "Reset code incorrect!!";
                header("Location:../reset.php");
                       die();

               }else{
                for ($counter = 0; $counter < $countAll ; $counter++) { 
                    $currentUser = $allUsers[$counter];
                    if($currentUser == $email . ".json"){
                        $userString = file_get_contents("../db/".$currentUser); 
                     $userObject = json_decode($userString) ;
                      $userObject->password = password_hash($password,PASSWORD_DEFAULT);
                     
                        unlink("../db/".$currentUser);
                    
        file_put_contents("../db/". $email .  ".json", json_encode($userObject));
        $_SESSION["message"] = "Password reset Successful , Login Please";
        header("Location:../login.php");
        
                   die();
                    }
                }
                
                 

                 
               }
             }
                }
                $_SESSION["error"] = "Invalid Email";
                header("Location:../reset.php");
                    die();
 }


?>