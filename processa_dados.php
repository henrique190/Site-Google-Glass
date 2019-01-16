<html>
<head>
    <title>Enviando formulario.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
header('Content-Type: text/html; charset=utf-8');
//var_dump($_POST);
$nome = $_POST['tnome'];
$senha = $_POST['tpass'];
$email = $_POST['temail'];
$sexo = $_POST['tsexo'];
$nascimento = $_POST['tnasc'];
$longa = $_POST['tlonga'];
$numero = $_POST['tnumero'];
$estado = $_POST['testado'];
$grau = $_POST['turg'];
$texto = $_POST['tmen'];
$cidade = $_POST['tcidade'];
$pedido = $_POST['tped'];
$cor = $_POST['tcor'];
$quantidade = $_POST['tqtd'];
$preco = $_POST['ttotal'];

$servername = "localhost";
$database = "meubanco";
$username = "root";
$password = "";




// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");


$sql = "SELECT max(id_pessoa) from pessoa";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row['max(id_pessoa)'];
    }
} else {
    echo "0 results";
}


$insert1 = "INSERT INTO pessoa VALUES (default, '$nome', '$email', '$sexo', '$nascimento')";
$insert2 = "INSERT INTO endereco VALUES (default, '$longa', '$numero', '$estado', '$cidade', $id)";
$insert3 = "INSERT INTO mensagem VALUES (default, '$grau', '$texto', $id)";
$insert4 = "INSERT INTO pedido VALUES (default, '$pedido', '$cor', '$quantidade', '$preco', $id)";

if (mysqli_query($conn, $insert1)) {
    if (mysqli_query($conn, $insert2)) {
        if (mysqli_query($conn, $insert3)) {
            if (mysqli_query($conn, $insert4)) {
                echo "Formulario enviado com sucesso";
            } else {
                echo "Error: " . $insert4 . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $insert3 . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $insert2 . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error: " . $insert1 . "<br>" . mysqli_error($conn);
}



mysqli_close($conn);


?>

</body>
</html>


