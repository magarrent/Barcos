<?php
  include "config/bd.php";

  $avis = "";

  if (isset($_SESSION['usuario'])) {
    header("Location:index.php");
  }

  if (isset($_POST['submit'])) {
    $sql_comprobar = "SELECT Nickname FROM usuarios_activos WHERE Nickname = '".htmlentities($_POST['nickname'])."'";
    $query_comprobar = mysql_query($sql_comprobar);
    if (mysql_num_rows($query_comprobar) == 0) {
      $sql_nuevo = "INSERT INTO usuarios_activos (Nickname, Login, Estado) VALUES ('".htmlentities($_POST['nickname'])."', '".date('Y-m-d H:i:s')."', '0')";
      $query_nuevo = mysql_query($sql_nuevo);
      if ($query_nuevo) {
        $_SESSION['usuario'] = htmlentities($_POST['nickname']);
        header("Location:index.php");
      }
    } else {
      $avis = "<div class='alert alert-danger'>Nickname en uso.</div>";
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
    <link href="css/bootstrap.css" rel="stylesheet">
  </head>
  <body class="fondo_gris">
    <section class="container">
      <div class="col-md-4"></div>
      <article class="col-md-4 login_box">
      <form method="POST">
         <div class="col-md-12">
         <?= $avis ?>
         <h1 align="center">Iniciar Sesión</h1><br/>
          <div class="input-group">
            <input type="text" name="nickname" class="form-control" placeholder="Nickname...">
            <span class="input-group-btn">
              <input class="btn btn-primary" type="submit" name="submit" value="Entrar!">
            </span>
          </div>
          <br/><br/>
        </div>
      </form>  
      </article>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>