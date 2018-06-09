<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="view/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="view/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="view/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="view/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="view/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="view/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="view/plugins/datatables/dataTables.bootstrap4.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="view/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="view/plugins/bootstrap/css/bootstrap.min.css">
  <!--script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script-->
  <script src="view/dist/js/plugins/sweetalert/sweetalert.js"></script>
    <!--script src="view/dist/js/plugins/sweetalert/sweetalert.min.js"></script-->
    <link rel="stylesheet" href="view/dist/js/plugins/sweetalert/sweetalert.css">
      
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <?php
  //funcion del controlador
  $controller = new MVC();
  //mostrar div en caso de estar logueado
  $controller->showNav();

  ?>
    <!-- Ejecutar funcion -->
    <?php
    //se crea una instancia de la clase controlador
    $controllerT = new MVC();
    //se ejecuta el metodo enlaces paginas controler que en base al valor de la variable action tomada por el metodo post, se redirecciona a una pagina especificada
    $controllerT->enlacePaginasController();
  ?>
  
  </div>
</div>
<!-- ./wrapper -->
  </body>
  
  <!-- Modal para borrar algo-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h3>
                 Confirmación de baja
              </h3> 
            </div>
            <div class="modal-body">
               <div class="form-group">
                    <p>
                    <label>Ingresa tu contraseña para confirmar baja</label>
                    <input type="password" id="contra_txt" class="form-control" placeholder="Contraseña">
                    <p id="error" style="color:red"></p> 
                 </p>
                  </div>
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok" onclick="confirmar();">Confirmar</a>
            </div>
        </div>
    </div>
</div>

  


  
  

  
  


<!--<footer class="main-footer">
    <strong>Copyright &copy; 2018 <a href="http://adminlte.io">UPV</a>.</strong>
    All rights reserved.
    
  </footer> -->

<!-- jQuery -->
<script src="view/plugins/jquery/jquery.min.js"></script>

<script src="view/plugins/bootstrap/js/bootstrap.min.js"></script>


<!-- DataTables -->
<script src="view/plugins/datatables/jquery.dataTables.js"></script>
<script src="view/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="view/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="view/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="view/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="view/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="view/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="view/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="view/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="view/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="view/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
 
        //funcion de confirmacion en js para confimar el borrado de un registro
        function confirmar(){
          var ps = "<?php echo $_SESSION['user_info']['password'] ?>";
          var x = document.getElementById("contra_txt").value;
          if(x != ps){
            document.getElementById("error").innerHTML = "Contraseña incorrecta";
             event.preventDefault();
          }
           
        }

      //funcion de confirmacion de cierre de sesion, muestra un sweet alert
        function confirmLogout(){
          event.preventDefault();
          swal({
          title: "Cerrar sesión",
          text: "¿Seguro que deseas cerrar la sesión?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-info",
          confirmButtonText: "Si, estoy seguro",
          closeOnConfirm: false
        },
        function(){
          window.location = 'index.php?action=logout';
        });
          
     
         
        }
  
  
     $('#confirm-delete').on('show.bs.modal', function(e) {
       document.getElementById("error").innerHTML = "";
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    });
  
      //funcion encargada de mostrar un alert cuando el usuario da clic en el boton actualizar y pida la contraseña
    function c(){
       var ps = "<?php echo $_SESSION['user_info']['password'] ?>";
        event.preventDefault();
        swal({
          title: "Confirmar acción",
          text: "<p>Ingresa tu contraseña para guardar los cambios</p><br><input type='password' class='form-control' id='pass_sw' placeholder='Escribe tu contraseña aqui' autofocus><label id='err_sa' style='color:red'></label><br>",
          html: true,
          
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          confirmButtonText: "Confirmar",
          closeOnConfirm: false,
          inputPlaceholder: "Escribe tu contraseña aqui",
          inputValidator: (value) => {
            return !value && 'You need to write something!'
          }
        }, function () {
          var inputValue = document.getElementById("pass_sw").value;
          if (inputValue === false) return false;
          if (inputValue != ps) {
            document.getElementById("err_sa").innerHTML = "Contraseña incorrecta";
            //swal.showInputError("You need to write something!");
            //swal("Operación cancelada!", "La contraseña es incorrecta", "error");
            return false
          }
           $( "#targ" ).click();
          swal("Exito!", "Registro modificado", "success");
        });
      
     }
    //funcion que se manda llamar al tratar de eliminar algun registro y muestra un sweet alert pidiendo la contraseña del usuario
    function b(id){
       var ps = "<?php echo $_SESSION['user_info']['password'] ?>";
        event.preventDefault();
        swal({
          title: "Confirmar baja de registro",
          text: "<p>Ingresa tu contraseña para dar de baja el registro</p><br><input type='password' class='form-control' id='pass_sw_2' placeholder='Escribe tu contraseña aqui' autofocus><label id='err_sa_2' style='color:red'></label><br>",
          html: true,
          
          type: "error",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          confirmButtonText: "Confirmar",
          closeOnConfirm: false,
          inputPlaceholder: "Escribe tu contraseña aqui",
        }, function () {
          var inputValue = document.getElementById("pass_sw_2").value;
          if (inputValue === false) return false;
          if (inputValue != ps) {
            document.getElementById("err_sa_2").innerHTML = "Contraseña incorrecta";
            return false
          }
          var ur = document.getElementById("borrar_btn"+id).href;
          //alert(ur);
          window.location = ur;
          swal("Exito!", "Registro eliminado", "success");
        });
      
     }
  //crear datable para Historial y ordenar por fecha
    $(document).ready(function() {
    $('#htable').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );


      //necesario para mostrar dataTables
          $(function () {
            $('.select2').select2();
            $("#example1").DataTable();
          });
      </script> 

</html>
