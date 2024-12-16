<?PHP

require_once '../../functions/autoload.php';

Autenticacion::logOut();

header('location: ../../index.php?sec=login');