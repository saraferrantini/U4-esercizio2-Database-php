<!-- <a href="http://localhost/IFOA0124/S1L3-database-mysql-1/1-pizzeria/?id=1">Utente1</a><br>
<a href="http://localhost/IFOA0124/S1L3-database-mysql-1/1-pizzeria/?id=3">Utente2</a><br>
<a href="http://localhost/IFOA0124/S1L3-database-mysql-1/1-pizzeria/?id=4">Utente 3</a><br> -->

<?php
// connessione al database
// preparazione della query
// esecuzione della query
// usare i dati


$host = 'localhost';
$db   = 'youtube';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// comando che connette al database
// $pdo = new PDO("mysql:host=localhost;dbname=ifoa_pizzeria", 'root', '', $options);
$pdo = new PDO($dsn, $user, $pass, $options);

// SELECT DI TUTTE LE RIGHE
$stmt = $pdo->query('SELECT * FROM users');
// echo '<ul>';
// while ($row = $stmt->fetch())
// {
//     echo '<pre>' . print_r($row, true) . '</pre>';
//     echo "<li>$row[name]</li>";
// }
// echo '</ul>';

echo '<ul>';
foreach ($stmt as $row)
{
    echo "<li>$row[nome]</li>";
    echo "<li>$row[cognome]</li>";
    echo "<li>$row[età]</li>";
}
echo '</ul>';


// SELECT DI UNA RIGA SPECIFICA
$id = 2;
$id = $_GET['id'];
// $stmt = $pdo->query("SELECT nome FROM dishes WHERE id = $id"); // NON FARE MAI!!!!!!
$stmt = $pdo->prepare("SELECT nome FROM users WHERE id = ?");
$stmt->execute([3]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<h2>$row[nome]</h2>";


// INSERT
// $stmt = $pdo->prepare("INSERT INTO users (nome,cognome) VALUES (:nome, :cognome)");
// $stmt->execute([
//     'nome' => 'Gloria',
//     'cognome' => 'Rossi',
// ]);

// DELETE
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([10]);

// UPDATE
$stmt = $pdo->prepare("UPDATE users SET nome = :nome  WHERE id = :id");
$stmt->execute([
    'id' => 16,
    'name' => 'Pizza editata'
]);