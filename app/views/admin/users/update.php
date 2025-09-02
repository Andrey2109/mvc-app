<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
$id = $_SESSION['user_id'] ? $_SESSION['user_id'] : NULL;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    var_dump($_FILES["profile_image"]);
    echo "<br>";
    var_dump(images_path('1_images'));
    if(!file_exists($_SERVER["HTTP_HOST"] . "/images/" . $id . "_images")){
        mkdir("images/" . $id . "_images");
    } else{

    }
    exit();
    $username = sanitize($_POST['username']);
    $first_name = sanitize($_POST['first_name']);
    $last_name = sanitize($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = sanitize($_POST['phone']);
    $birthday = sanitize($_POST['birthday']);
    $organization = sanitize($_POST['organization']);
    $location = sanitize($_POST['location']);
    
    $user = new User;
    if(isset($id)){
        if($user->updateUser($id, $username, $email, $first_name, $last_name, $phone, $birthday, $organization, $location)){
        redirect('admin/users/profile');
    }
    } else{
        echo '<script>alert("Authentication required.")</script>';
        redirect('/user/login');
    }
    
}


?>