<input id="busca" type="text" class="form-control" onfocus="$(this).trigger('keyup');" placeholder="Pesquisar..." 
    onkeyup='var value = $(this).val().toLowerCase();
    $(".list-group a").filter(function() {
      // Verifica se o item corresponde ao texto filtrado
      var match = $(this).text().toLowerCase().indexOf(value) > -1;
      $(this).toggle(match);

      // Se corresponder, expande o elemento pai
      
      if(match) {
        var targetId = $(this).data("bs-target"); // Obtem o id do elemento alvo
        if(targetId) {
          $(targetId).collapse("show"); // Expande o elemento pai
          // Garante que o ícone de seta seja atualizado para o estado "expandido"
          $(this).find(".seta").removeClass("fa-angles-right").addClass("fa-angles-down");
        }
      }
      return match;
    });'>

<?
 include "headermain.php";
if (session_status() != PHP_SESSION_ACTIVE)
session_start();
include "sgbd/fatura.php";
$sql ="select * from menusistema(". $_SESSION['SISTEMA'] .",".$_SESSION['ID_CPC'].")";
foreach ($fatura->query($sql) as $rowsistema)
 {
    echo $rowsistema['DIV'];
    if ($rowsistema['TIPO'] == 'M') {
?>
<div class="list-group">
    <a href class="dropdown-item list-group-item list-group-item-action d-flex justify-content-between align-items-center <? if ($rowsistema['NIVEL'] =='2') echo " ms-3" ?>" aria-current="true" style="border:none" data-bs-toggle="collapse" data-bs-target="#<? echo $rowsistema['ID'] ?>" aria-expanded="true" aria-controls="collapseExample" onclick="$(this).find('.seta').toggleClass('fa-angles-right fa-angles-down');">
    <div><i class="<? echo $rowsistema['ICONE'] ?> me-2"></i><? echo $rowsistema['DESCRICAO'] ?></div><i class="fa-solid fa-angles-right ms-4 seta"></i></a>
    </a>
    <div class="list-group collapse" id="<? echo $rowsistema['ID'] ?>">
<? } else { ?>
    <li class="<? if ($rowsistema['NIVEL'] =='2') echo " ms-4 comando"; else echo "ms-2"; ?>"><a href onclick="<? echo $rowsistema['COMANDO']?>" style="border:none" class="<? if ($rowsistema['COMANDO'] == "") echo "btn disabled fst-italic " ?> list-group-item list-group-item-action ms-2 dropdown-item"><i class="<? echo $rowsistema['ICONE'] ?> me-2"></i><? echo $rowsistema['DESCRICAO'] ?></a></li>    
<? } 
} 
 if (($rowsistema['NIVEL'] ?? '') =='2') echo "</div></div>";
?>
</div></div>
