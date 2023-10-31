<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Verifique se a imagem foi enviada
  if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem_tmp = $_FILES['imagem']['tmp_name'];
    $nome_imagem = $_FILES['imagem']['name'];

    // diretório de destino
    $diretorio_destino = 'img/';

    // Aqui verifica se o diretório de destino existe
    if (!is_dir($diretorio_destino)) {
      mkdir($diretorio_destino, 0777, true);
    }

    // Move a imagem pra o diretório específico
    $caminho_destino = $diretorio_destino . $nome_imagem;
    if (move_uploaded_file($imagem_tmp, $caminho_destino)) {
      // A imagem foi carregada com sucesso
    } else {
      // Trata o erro de carregamento da imagem, se precisar
    }
  }

  // Montagem do texto
  $titulo = str_replace('#', '-', $_POST['titulo']);
  $categoria = str_replace('#', '-', $_POST['categoria']);
  $descricao = str_replace('#', '-', $_POST['descricao']);

  // Texto a ser armazenado
  $texto = $_SESSION['id'] . '#' . $titulo . '#' . $categoria . '#' . $descricao . '#' . $nome_imagem . PHP_EOL;

  // Abrindo o arquivo
  $arquivo = fopen('../../app_help_desk/arquivo.hd', 'a');

  // Escrevendo o texto
  fwrite($arquivo, $texto);

  // Fechando o arquivo
  fclose($arquivo);

  // Redirecionan de volta para a página de abertura de chamado
  header('Location: abrir_chamado.php');
}
?>
