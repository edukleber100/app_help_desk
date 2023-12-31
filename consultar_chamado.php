<?php require_once "validador_acesso.php"; ?>

<?php
  // Chamados
  $chamados = array();

  // Abrir o arquivo.hd
  $arquivo = fopen('../../app_help_desk/arquivo.hd', 'r');

  // Enquanto houver registros (linhas) a serem recuperados
  while (!feof($arquivo)) {
    $registro = fgets($arquivo);
    $chamados[] = $registro;
  }

  fclose($arquivo);
?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="logoff.php">SAIR</a>
        </li>
      </ul>
    </nav>
    <div class="container">    
      <div class="row">
        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="filtro">Filtrar Chamados:</label>
                <input type="text" id="filtro" class="form-control" placeholder="Digite o termo de pesquisa">
              </div>
              <button class="btn btn-primary" onclick="filtrarChamados()">Pesquisar</button>
              <?php 
                foreach($chamados as $chamado){
                  $chamado_dados = explode('#', $chamado);

                  if ($_SESSION['perfil_id'] == 2) {
                    if ($_SESSION['id'] != $chamado_dados[0]) {
                      continue;
                    }
                  }

                  if (count($chamado_dados) < 4) {
                    continue;
                  }
              ?>
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?= $chamado_dados[1] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $chamado_dados[2] ?></h6>
                  <p class="card-text"><?= $chamado_dados[3] ?></p>
                  <?php if (isset($chamado_dados[4])) : ?>
                    <img src="img/<?= $chamado_dados[4] ?>" alt="Imagem do Chamado" width="400" height="250">
                  <?php endif; ?>
                </div>
              </div> 
              <?php } ?>
              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="home.php">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function filtrarChamados() {
        var termo = document.getElementById('filtro').value.toLowerCase();
        var chamados = document.querySelectorAll(".card.mb-3.bg-light");
        chamados.forEach(function(chamado) {
          var textoChamado = chamado.textContent.toLowerCase();
          if (textoChamado.indexOf(termo) !== -1) {
            chamado.style.display = 'block';
          } else {
            chamado.style.display = 'none';
          }
        });
      }
    </script>
  </body>
</html>
