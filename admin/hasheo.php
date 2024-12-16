<?PHP

// La contraseña del superadmin es abc123 - usuario superadmin_vecchio

$passwordSuperadmin = "abc123";
$passwordHash = password_hash($passwordSuperadmin, PASSWORD_DEFAULT);

echo "Contraseña super admin hasheada: ";
echo "<pre>";
print_r($passwordHash);
echo "</pre>";

// La contraseña del admin es boquitacampeon - usuario admin_vecchio

$passwordAdmin = "boquitacampeon";
$passwordHashAdmin = password_hash($passwordAdmin, PASSWORD_DEFAULT);

echo "Contraseña admin hasheada: ";
echo "<pre>";
print_r($passwordHashAdmin);
echo "</pre>";

// La contraseña del usuario es jorgekpo - usuario usuario_vecchio


$passwordUsuario = "jorgekpo";
$passwordHashUsuario = password_hash($passwordUsuario, PASSWORD_DEFAULT);

echo "Contraseña usuario hasheada: ";
echo "<pre>";
print_r($passwordHashUsuario);
echo "</pre>";


?>