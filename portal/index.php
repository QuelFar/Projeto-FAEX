<?php

require_once('config.php');
require_once('Crud.php');

    $crud = new Crud(HOST,USER,PASSWORD,DB,CHARSET);
        if(isset($_POST) and !empty($_POST)){
            $dados = $_POST;         
            $select = $crud->select('pessoa',$dados);

            if($select->num_rows > 0){
               header('location: acessado.php');
            }else{
                echo "<script> alert('INFORMAÇÕES INVALIDAS')</script>";
            }
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <title>Portal T.I</title>
</head>
<body>
    <div id="main-login">
        <div class="left-login">
          <h1>Faça login <br> Para acessar o Portal</h1>
          <img src="images/tela-login.svg" alt="" class="left-img">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>
                <form method="post" class="textfield">
                    <div class="textfield">
                        <label for="cpf">CPF do Usuário</label>
                        <input type="text" name="cpf" id="cpf" placeholder="Usuário">
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha">
                    </div>
                    <button class="btn-login" type="submit">LOGIN</button>
                    <button class="btn-login" type="submit">SOU PROFESSOR</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>