<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leitosa</title>
</head>
<body>
    <h1>passa as informações</h1>
    <form name="info_produto" id="info_produto" method="post">

        <input type="hidden" name="form_id" value="form1">

        <div class= "info" id= "acao1">
            <input class="acao1" name="adicionar" id="adicionar" value="Adicionar" onclick= "out(1)" type="radio">
            <label for="adicionar">Adicionar</label>

            <input class="acao1" name="atualizar" id="atualizar" value="Atualizar" onclick="out(1)" type="radio">
            <label for="atualizar">Atualizar</label>

            <input class="acao1" name="esgotado" id="esgotado" value="Esgotado" onclick="out(1)" type="radio">
            <label for="esgotado">Esgotado <br></label>
        </div>

        <div class= "info" id= "acao2">
            <input class= "acao2" name= "acao2" id= "Outros" value= "Outros" type= "radio" onclick= "out(2)">
            <label for= "Outros">Outros</label>

            <input class= "acao2" name= "acao2" id= "Congelados" value= "Congelados" type= "radio" onclick= "out(2)">
            <label for= "Congelados">Congelados</label>

            <input class= "acao2" name= "acao2" id= "Gelados" value= "Gelados" type= "radio" onclick= "out(2)">
            <label for= "Gelados">Gelados</label>

            <input class= "acao2" name= "acao2" id= "Lanches" value= "Lanches" type= "radio" onclick= "out(2)">
            <label for= "Lanches">Lanches</label>
        </div>

        <button type='submit'>Enviar</button>
    </form>


    <p id="acao_final1"></p>
    <p id="acao_final2"></p>

    <script src= "get_info5_6.js"></script>

    <?php
    require_once "db.php";

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Nome: " . $row["nome"]. " - Descrição: " . $row["descricao"]. "<br>";
        }
    }

    function clean($objeto){

        $objeto = htmlspecialchars($objeto);
        $objeto = stripslashes($objeto);
        $objeto = trim($objeto);

        return $objeto;

    };

    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['form_id']) && $_POST['form_id'] == 'form1') {

            $name_produto = clean($_POST['nome_produto']);
            $descricao_produto = clean($_POST['descricao_produto']);
            $preco_produto1 = clean($_POST['preco_produto']);
            $preco_produto1 = verificando_letras($preco_produto1);
            $preco_produto = formatarPreco($preco_produto1);
            $promocao_produto = $_POST["promocao"];
            $escolha= '';

            $acao = $_POST['acao2'];

            switch ($acao) {
                case 'Outros':
                    $escolha= 'Outros';
                    break;
                case 'Congelados':
                    $escolha= 'Congelados';
                    break;
                case 'Gelados':
                    $escolha= 'Gelados';
                    break;
                case 'Lanches':
                    $escolha= 'Lanches';
                    break;
            }

            if ($escolha == '') {
                $escolha= 'nenhum opção selecionada';
            }

        enviando_formulario($escolha, $name_produto, $descricao_produto, $preco_produto, $promocao_produto);

        }

        
    }
    
    ?>
</body>
</html>



