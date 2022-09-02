<?php
require_once 'pdo.php';
$conexao = novaConexao();
$sql = "SELECT * FROM produtos LIMIT :qtde OFFSET :inicio";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
    html, body{
        padding: 10px;
    }
</style>

<body>
    <table class="table table-striped">

        <tr>
            <th>ID</th>
            <th>CNPJ</th>
            <th>CODIGO</th>
            <th>PRODUTO</th>
            <th>TRIBUTAÇÃO</th>
        </tr>

        <?php
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':qtde', 100, PDO::PARAM_INT);
            $stmt->bindValue(':inicio', 0, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $resultado = $stmt->fetchAll();

                foreach ($resultado as $row => $value) {
                    echo '<tr>';
                    echo "<td> ${value['id']}</td>";
                    echo "<td> ${value['cnpj']}</td>";
                    echo "<td> ${value['codigo']}</td>";
                    echo "<td> ${value['produto']}</td>";
                    echo "<td> ${value['tributacao']}</td>";
                    echo '</tr>';
                }
                ;

            } else {
                echo "Código: " . $stmt->errorCode() . "<br>";
                print_r($stmt->errorInfo());
            };

            $conexao->close();
        ?>
    </table>
</body>

</html>