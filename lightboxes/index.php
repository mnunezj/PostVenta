<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal PostVenta</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<style>
body{
  background-image: url('imagenes/fondoportal.png');
  background-repeat: no-repeat;
  background-size: cover;
  font-size: 11px;
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
.Titulo {
  margin-top: -20px;
  padding: 5px;
  font-family: verdana, sans-serif;
  font-size: 16px;
  font-style: normal;
  font-variant: normal;
  font-weight: 300;
}
.InputStyleTable {
  font-size:11px;
  height: 20px;
}
.btn-default {
  background-color: #F8F9F9  ;
  border-color: #AAB7B8  ;
  font-size:11px;
}

.btn-secondary {
  background-color: #F8F9F9  ;
  border-color: #AAB7B8  ;
  font-size:9px;
  padding: 2px 7px;
}

.tdTable{
  padding: 2px !important;
}

.well{
  }
  .well-2{
    background-color: white;
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
.img{
  width: auto;
  height: 30px;
}
.ctn {
  border-radius: 10px;
}
.btn-success{
  background-color:rgb(150,191,12);
  border-color: rgb(150,191,12);
}
.btn-danger{
  background-color:rgb(201,80,107);
  border-color: rgb(201,80,107);
}
</style>

  </head>
  <body>
    <div class="container-fluid" align="center" style="margin-top:140px">
      <div class="row well" style="width: 600px; height: 130px; padding-top:0px; padding-bottom:0px;">
          <div class="well" align="left" style=" height: 0px; margin-left:-20px; margin-right:-20px;">
            <img src="imagenes/minilogo.png" class="img" style="margin-top:-20px">

           <small><label class="Titulo" style="">Menú Principal</label></small>
          </div>
      <div class="row well-2" style="margin-top:-20px; margin-left:-20px; margin-right:-20px; height:auto;">
<div class="col-sm-12" style="padding:20px">
  <button type="submit" style="" onclick="window.location='./resumenreporte.php'" class="btn btn-success btn-lg btn-block">Reportes de gestión</button>
  <br>
  <button type="submit" onclick="window.location='./cierre.php'" class="btn btn-success btn-lg btn-block">Cierre Ticket</button>
</div>
      </div>
      <div class="row well-2" align="right" style="padding-right:17px; margin-left:-20px; margin-right: -20px; height:100px; border-bottom-right-radius:4px;border-bottom-left-radius:4px;">
        <br>
        <button type="submit" style="margin-top:5px" onclick="" class="btn btn-danger btn-lg">Cerrar sesión <span class="glyphicon glyphicon-remove"></span></button>
      </div>
    </div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
