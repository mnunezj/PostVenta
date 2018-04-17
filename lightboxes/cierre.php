<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cierre Ticket</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <style>
     body{
       background-image: url('imagenes/fondoportal.png');
       background-repeat: no-repeat;
       background-size: cover;
       font-family: verdana, sans-serif;
       font-size: 13px;
       font-style: normal;
       font-variant: normal;
       font-weight: 300;
     }
     .table{
       font-size:11px;
     }
     .form-group{
       margin-top: 5px;
     }
     .Fields {
       background-color: #F39C12 !important;
       color: white;
       font-size:11px;
       height: 20px;
     }
     .InputStyle {
       font-size:11px;
       height: 20px;
       padding: 2px;
     }

     .InputStyleTable {
       font-size:11px;
       height: 20px;
       text-align: right;
     }
     .btn-default {
       background-color: #F8F9F9  ;
       border-color: #AAB7B8  ;
       font-size:11px;
     }

     .tdTable{
       padding: 2px !important;
     }

     .well{
       margin-top:1px;
       margin-bottom:1px;
       }

     .table-fixed thead {
       width: 97%;
     }
     .table-fixed tbody {
       height: 230px;
       overflow-y: auto;
       width: 100%;
     }
     .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
       display: block;
     }
     .table-fixed tbody td, .table-fixed thead > tr> th {
       float: left;
       border-bottom-width: 0;
     }
     .well-2 {
       background-color: white;
       border-radius: 4px;
       margin-left: -20px;
       margin-right: -20px;
       margin-top: -5px;
       margin-bottom: -5px;
     }
     .btn-success{
       background-color:rgb(150,191,12);
       border-color: rgb(150,191,12);
     }
    </style>

  </head>
  <body>

  <div class="container-fluid" align="center" style="margin-top:40px;">
    <div class="row well" style="width: 750px; height: 449px; padding-top:0px; padding-bottom:0px;">
      <div class="row well-2" align="left">
        <img src="imagenes/logosendero.jpg" style=" padding-left: 5px; padding-bottom: 5px; padding-top: 5px; width:120px; height:auto;">
      </div>
      <div class="row well" style="height: 350px; overflow-y: scroll;" align="left"><!-- Tercera fila -->
        <label><div align="left" style="margin-left:20px;">Cerrar ticket<hr style=" margin-top: 0px; margin-bottom: 0px;"> </div></label>
        <form action="actualizaciones.php" method="get">
<div class="form-group" align="left">
<label>Numero Ticket:</label>
<input type="Ticket" class="form-control" id=NTicket aria-describedby="TicketHelp" placeholder="Ingresar numero del ticket" required>
<small id="emailHelp" class="form-text text-muted">Digitar n°ticket</small>
</div>
<div class="form-group" align="left" style="font-size:12;">
<label>Observación(es):</label>
<input type="Observacion" class="form-control" id="Obs" placeholder="Ingresar observación" required>
</div>
<div class="form-group" align="right">
  <button type="submit" class="btn btn-success" style="">Cerrar</button>
</div>
</form>
          </div>	<!-- Fin tercera fila -->
          <div class="row" style="margin-top:3px; margin-right:-7px;">
            <div class="form-group" style="text-align:right;">
              <button type="submit" onclick="window.location='./index.php'" class="btn btn-default btn-xl">Volver <i class="glyphicon glyphicon-share-alt"></i></button>
            </div>
          </form>
    </div>
  </div>

  </body>
</html>
