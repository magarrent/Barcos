<?php
  include "config/bd.php";

  $avis = "";

  if (!isset($_SESSION['usuario'])) {
    header("Location:login.php");
  }

  $sql_disponibles = "SELECT * FROM usuarios_activos WHERE Estado = '0' && Nickname != '".$_SESSION['usuario']."'";
  $query_disponibles = mysql_query($sql_disponibles);

  $sql_ocupados = "SELECT * FROM usuarios_activos WHERE Estado = '1' && Nickname != '".$_SESSION['usuario']."'";
  $query_ocupados = mysql_query($sql_ocupados);

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
      <article class="col-md-4 box">
         <div class="col-md-12">
         <?= $avis ?>
         <div id="invitacion">
          <p></p>
         </div>
           <div id="usuarios_activos">
         <h2 align="center">Usuarios disponibles</h2>
           <?php
            while ($array_disponibles = mysql_fetch_assoc($query_disponibles)) {
              echo "<a id='".$array_disponibles['Nickname']."'>";
                echo "<img src='img/disponible.png'>";
                echo "<span>".$array_disponibles['Nickname']."</span>";
              echo "</a><br/>";
            }
           ?>
           </div>

           <div id="usuarios_ocupados">
           <h2 align="center">Usuarios ocupados</h2>
           <?php
            while ($array_ocupados = mysql_fetch_assoc($query_ocupados)) {
                echo "<img src='img/ocupado.png'>";
                echo "<span>".$array_ocupados['Nickname']."</span>";
              echo "<br/>";
            }
           ?>
           </div>
        </div><br/>
      </article>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      setInterval(function(){ 
       
          $.ajax({
              type: "POST",
              url: "comprobar_disponibilitat.php",
              dataType: "json",
              success: function(msg, string, jqXHR) {
                $("#usuarios_activos").html("").append("<h2 align='center'>Usuarios disponibles</h2>");
                $("#usuarios_ocupados").html("").append("<h2 align='center'>Usuarios ocupados</h2>");
                  for (var i in msg) {
                    var $nom = msg[i].split(":")[0];
                    var $estado = msg[i].split(":")[1];
                    if ($estado == 1) {
                      $("#usuarios_ocupados").append("<img src='img/ocupado.png'><span>"+$nom+"</span><br/>");
                    } else {
                      $("#usuarios_activos").append("<a id='"+$nom+"'><img src='img/disponible.png'><span>"+$nom+"</span></a><br/>");
                    }
                  }
              }
          }); 

          $.ajax({
              type: "POST",
              url: "comprobar_invitacions.php",
              dataType: "json",
              success: function(msg1, string, jqXHR) {
                for (var o in msg1) {
                  var $origen = msg1[o].split(":")[0];
                  var $destino = msg1[o].split(":")[1];
                  var $estado = msg1[o].split(":")[2];

                  console.log($destino);

                  if ($destino == "<?= $_SESSION['usuario'] ?>") {
                    $("#invitacion p").html("Invitación de <b>"+$origen+"</b>");
                  };
                }
              }
          }); 

      }, 3000);

      $("#usuarios_activos a").click(function() {
        var $id = $(this).attr("id");
        $.post("enviar_invitacion.php", {destino:$id}, function() {
          alert("Invitacion enviada");
        });
      });
    </script>
  </body>
</html>