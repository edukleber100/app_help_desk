<?php

    session_start();
    //remover índices do array da sessão 
    //unset()


    //destruir variável de sessão
    //session_destroy()

    session_destroy();
    header('Location: index.php');

?>