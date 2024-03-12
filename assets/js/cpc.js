function atualizarrel() {
    filtro = '';
    if (document.getElementById("option2").checked) filtro = ';01';
    else if (document.getElementById("option3").checked) filtro = ';02';
    else if (document.getElementById("option4").checked) filtro = ';07';
    else if (document.getElementById("option5").checked) filtro = ';30';
    else if (document.getElementById("option6").checked) filtro = ';60';
    if (document.getElementById("status0").checked) filtro += ';S0';
    if (document.getElementById("status1").checked) filtro += ';S1';
    if (document.getElementById("status3").checked) filtro += ';S3';
    if (document.getElementById("status4").checked) filtro += ';S4';
    if (document.getElementById("status5").checked) filtro += ';S5';
    if (document.getElementById("status6").checked) filtro += ';S6';


    filtro += ';';
    // filtro += document.getElementById("statusfiltro").value;

    showMain(filtro,'cpcMain','main.php?tela=suporte/lista&filtro=','#laudoview');
      
  }