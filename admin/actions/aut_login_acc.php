<?PHP

require_once '../../functions/autoload.php';

$postData = $_POST;
$passwordProvista = $postData['password'];

$login = Autenticacion::logIn($postData['nombreusuario'], $passwordProvista);


if ($login) {

    if($login == "usuario"){ 
        header('location: ../../index.php');
    }else{
        header('location: ../index.php?sec=dashboard');
    }
    
} else {
    header('location: ../../index.php?sec=login');
}

?>