<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div id="dropdowncps">
          <div class="dropdown" id="minha">
              <ul class="dropdown-menu" id ="minhalista">
                <li><a href="" onclick="ajustaAltura('S'); window.print(); ajustaAltura('N');"  class="dropdown-item">Imprimir</a></li>
                <li><a href="" class="dropdown-item" onclick="$('#tela_acesso').click()">Cancelar</a></li>
              </ul>
          </div>
      </div>

    <div id="interno">
      <a href="" class="btn btn-outline-warning btn-sm cpcnoprint" style="color: #ffffff" onclick="$('#minhalista').toggle()" xonmouseup="showMain('tela_add','minhalista','./listapopup_get.php?indice=');" data-bs-toggle="dropdown">
            ...
      </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
        // Fechar o dropdown se clicar fora dele
        
        $(window).click(function(event) {
          console.log('adsa');
            if (!$(event.target).closest('#minhalista').length) {
               $('#minhalista').hide();
            }
        });
    });
</script>    

  </body>

</html>

