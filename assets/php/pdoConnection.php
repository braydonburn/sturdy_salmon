<?PHP
$pdo = new PDO('mysql:host=localhost;dbname=cab230', 'root', 'dreadman1');
#$pdo = new PDO('mysql:host=localhost;dbname=n9715894', 'n9715894', 'password');
#$pdo = new PDO('mysql:host=localhost;dbname=cab230', 'root1', 'password');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
