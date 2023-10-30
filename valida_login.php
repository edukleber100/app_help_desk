<?php

//variavel verifica  se a autenticacao foi realizada
$usuario_autenticado = false;

//usuarios do sistema
$usuarios_app = array(
    array('email' => 'teste@teste.com.br', 'senha' => '1509')
);

foreach($usuarios_app as $user) {

   if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha'] ){
        $usuario_autenticado = true;
   }

}

if($usuario_autenticado){
    echo 'Usuário autenticado';
} else {
    header('Location: index.php?login=erro');
}


?>