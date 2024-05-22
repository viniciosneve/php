<?php

require_once "get_info.php";

$servername = "localhost";
$username = "wmbtgjum_produtos_loja";
$password = "Aa123456!";
$dbname = "wmbtgjum_produtos_loja";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}






$sql = "SELECT * FROM produtos;";
$result = $conn->query($sql);

#preço
function verificando_letras($preco) {

    $str = preg_replace('/[^0-9.,]/', '', $preco);
    return $str;

}


$id_produto = $result -> num_rows + 1;
function formatarPreco($preco) {
    if (
        strpos($preco, ',') === false && strpos($preco, '.') === false ||
        strpos($preco, '.') !== false && preg_match('/.\d{3}$/', $preco)
        ){
        
        $preco .= ',00';

    } elseif (preg_match('/.\d{2}$/', $preco)){

        $preco = str_replace(".", ",", $preco);
    
    } elseif (preg_match('/,\d{1}$/', $preco)){

        $preco .= "0";

    } elseif (preg_match('/.\d{1}$/', $preco)){

        $preco .= "0";
        $preco_float = (float) $preco;

        return $preco_float;

    } elseif (strpos($preco, ',') !== false){
        $ultimo_caractere = substr($preco, -1);

        if ($ultimo_caractere == ',') {

            $preco .= '00';

        }

    } 

    
    $preco = str_replace(".", "", $preco);
    $preco = str_replace(",", ".", $preco);
    $preco_float = (float) $preco;

    return $preco_float;
}




function enviando_formulario ($local, $nome, $descricao, $preco, $promocao_produto) {
    $promocao = false;
    if ($promocao_produto == 'on') {
        $promocao= true;
    }
    
    $pegando_id = "SELECT id FROM produtos ORDER BY id DESC LIMIT 1;";
    $result = $conn->query($pegando_id);
    $id= 0;

    if ($result->num_rows > 0) {
        $id= result + 1;
    }

    //$envio = 'INSERT INTO produtos (id, local, nome, descricao, preco, promocao) VALUES ($id, $local, $nome, $descricao, $promocao);';
    //$conn->query($envio);
}
#adicionando ao banco de dados






$conn -> close();
?>

