<?php
/**
 * Script para comparar as imagens que estão no banco de dados
 * com as imagens que estão no diretório e se caso for diferente deleta
 */

/**
 * Conectando no banco de dados
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "codehacking";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/**
 * Selecionando as imagens do banco de dados
 */
$sql = "select file from photos";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $foto_db[] = $row['file'];
    }
}

/*
 * Selecionando as imagens do diretório
 */
$fileList = glob('public/images/*');
foreach ($fileList as $filename) {
    $foto_path[] = basename($filename);
}

/**
 * Comparando a diferença entre os dois arrays (img banco e img diretório)
 * Se caso estiver no diretório mas não estiver no banco significa que essa imagem é inútil
 * Então deve ser deletada
 */
$result = array_diff($foto_path, $foto_db);
foreach ($result as $foto) {
    if ($foto <> "user-profile-placeholder.png") { //Caso não for uma imagem placeholder
        echo "foto diff: " .$foto. "\n";
        unlink('public/images/'.$foto);
    }
}

mysqli_close($conn);
