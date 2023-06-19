<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once("Connection.php");


$conn = Connection::getConnection();


if (isset($_POST["submetido"])) {
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $autor = isset($_POST['autor']) ? $_POST['autor'] : null;
    $genero = isset($_POST['genero']) ? $_POST['genero'] : null;
    $qtd_paginas = isset($_POST['qtd_paginas']) ? $_POST['qtd_paginas'] : null;

    $sql = 'INSERT INTO livros (titulo, autor, genero, qtd_paginas) VALUES (?, ?, ?, ?)';   
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titulo, $autor, $genero, $qtd_paginas]);

    header("location: livros.php");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de livros</title>
</head>
<body>
    <h1>Cadastro de livros</h1>

    <h3>Formulário de livros</h3>

    <form action="" method="POST">

    <input type="text" name="titulo" placeholder="informe o titulo"> <br> <br>

    <input type="text" name="autor" placeholder="informe o autor"> <br> <br>

    <select name="genero">
        <option value="">selecione o genero</option>
        <option value="D">drama</option>
        <option value="R">romance</option>
        <option value="F">ficcao</option>
        <option value="O">outro</option>
    </select> <br><br>

    <input type="number" name="qtd_paginas" placeholder="informe o numero de paginas"> <br> <br>

    <button type="submit">
        cadastrar
    </button>

    <input type="hidden" name="submetido" value="1">

    </form>


    <h3>Listagem de livros</h3>
    <?php 
        $sql = "SELECT * FROM livros";

 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->fetchAll();
    ?>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Título</td>
            <td>Autor</td>
            <td>Gênero</td>
            <td>Páginas</td>
        </tr>
        
        <?php foreach($result as $reg): ?>
            <tr>
                <td> <?php echo $reg['id'] ?> </td>
                <td> <?php echo $reg['titulo'] ?> </td>
                <td> <?php echo $reg['autor'] ?> </td>
                <td> <?php



                        switch($reg['genero']) {
                            case 'D':
                                echo "drama";
                                break;

                                case 'F':
                                    echo "ficcao";
                                    break;
    
                                case 'R':
                                    echo "romance";
                                    break;
                                
                                case 'O':
                                    echo "outro";
                                    break;
                        } ?> 
                </td>
                <td> <?= $reg['qtd_paginas'] ?> </td>
                <td><a href="livros_del.php?id=<?php echo $reg['id'] ?> " onclick="return confirm('confrima a exclusao?');">excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

