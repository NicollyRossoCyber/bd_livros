<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);


$id = isset($_GET["id"]) ? $_GET["id"] : null;

if ($id) {
    require_once("Connection.php");
    $conn = Connection::getConnection();
    $sql = "DELETE FROM livros WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    header("location: livros.php");

} else {
    echo "ID nao foi encontrado";
    echo "<br>";
    echo "<a href='livros.php'>voltar</a>";

}

?>