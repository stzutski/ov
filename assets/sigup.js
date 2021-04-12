
  //rotina para checar email durante o cadastro (losefocus)
  $( ".chkRegisterMail" ).focusout(function() {
      let goUrl   = $(this).attr("data-go"); //to card
      let emladdr = $(this).val();
      if(emladdr){
        var request   = $.ajax({
          url: goUrl,
          method: "POST",
          data: { emladdr: emladdr, go: 'chkmail'},
          dataType: "html",
          success: function(data) {
              //eval(data);
              $("#emlUsed").hide();$("#emlOk").hide();$("#emlErr").hide();
              if(data=='0'){$("#emlOk").show();}
              if(data=='1'){$("#emlUsed").show();}
              if(data=='2'){$("#emlErr").show();}
            }
        });         
        
      }
  });  

  //funcao para conferir validade do formato do email
  function formatoEmail(email){
      var str = email;
      var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      if(filtro.test(str)) {
          return true;
      } else {
          return false;
      }
  }


  //confere CPF
  function isValidCPF(cpf) {
      if (typeof cpf !== "string") return false
      cpf = cpf.replace(/[\s.-]*/igm, '')
      if (
          !cpf ||
          cpf.length != 11 ||
          cpf == "00000000000" ||
          cpf == "11111111111" ||
          cpf == "22222222222" ||
          cpf == "33333333333" ||
          cpf == "44444444444" ||
          cpf == "55555555555" ||
          cpf == "66666666666" ||
          cpf == "77777777777" ||
          cpf == "88888888888" ||
          cpf == "99999999999" 
      ) {
          return false
      }
      var soma = 0
      var resto
      for (var i = 1; i <= 9; i++) 
          soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i)
      resto = (soma * 10) % 11
      if ((resto == 10) || (resto == 11))  resto = 0
      if (resto != parseInt(cpf.substring(9, 10)) ) return false
      soma = 0
      for (var i = 1; i <= 10; i++) 
          soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i)
      resto = (soma * 10) % 11
      if ((resto == 10) || (resto == 11))  resto = 0
      if (resto != parseInt(cpf.substring(10, 11) ) ) return false
      return true
  }  

    
  //consulta cidades pela UF
  $( "#campoUf" ).change(function() {
    var estado = $( this ).val();
    let goUrl  = $(this).attr("data-URL"); //request
    if(estado!='')
    {
      var request   = $.ajax({
        url: goUrl+'ajx',
        method: "POST",
        data: { go: 'lstcidades', uf: estado},
        dataType: "html",
        success: function(data) {
            eval(data);
          }
      }); 

    }else{
      $('#cidadeCli').html('<option value="">Selecione o Estado</option>'); //load data  
    }
  });


  //confere CPF
  function isValidCPF(cpf) {
      if (typeof cpf !== "string") return false
      cpf = cpf.replace(/[\s.-]*/igm, '')
      if (
          !cpf ||
          cpf.length != 11 ||
          cpf == "00000000000" ||
          cpf == "11111111111" ||
          cpf == "22222222222" ||
          cpf == "33333333333" ||
          cpf == "44444444444" ||
          cpf == "55555555555" ||
          cpf == "66666666666" ||
          cpf == "77777777777" ||
          cpf == "88888888888" ||
          cpf == "99999999999" 
      ) {
          return false
      }
      var soma = 0
      var resto
      for (var i = 1; i <= 9; i++) 
          soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i)
      resto = (soma * 10) % 11
      if ((resto == 10) || (resto == 11))  resto = 0
      if (resto != parseInt(cpf.substring(9, 10)) ) return false
      soma = 0
      for (var i = 1; i <= 10; i++) 
          soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i)
      resto = (soma * 10) % 11
      if ((resto == 10) || (resto == 11))  resto = 0
      if (resto != parseInt(cpf.substring(10, 11) ) ) return false
      return true
  }


  /*
   * alert label cpf invalido
   * */
  $( "#campoCpf" ).focusout(function() {
    var res = isValidCPF( $(this).val() );
    if(res==false){
        $('#cpfHelp').removeClass('text-muted');
        $('#cpfHelp').addClass('text-danger');
        $('#cpfHelp').html('Cpf não válido!');
    }else{
        $('#cpfHelp').removeClass('text-danger');
        $('#cpfHelp').addClass('text-muted');
        $('#cpfHelp').html('Somente números.');
    }
  });


  //confere força da senha
  function CheckPasswordStrength(password) {
    var password_strength = document.getElementById("pwdHelp");
      //if textBox is empty
      if(password.length==0){
          password_strength.innerHTML = "";
          return;
      }
      //Regular Expressions
      var regex = new Array();
      regex.push("[A-Z]"); //For Uppercase Alphabet
      regex.push("[a-z]"); //For Lowercase Alphabet
      regex.push("[0-9]"); //For Numeric Digits
      regex.push("[$@$!%*#?&]"); //For Special Characters


      var passed = 0;

      //Validation for each Regular Expression
      for (var i = 0; i < regex.length; i++) {
          if((new RegExp (regex[i])).test(password)){
              passed++;
          }
      }

      //Validation for Length of Password
      if(passed > 2 && password.length > 8){
          passed++;
      }else{
          passed--;
      }

      //Display of Status
      var color = "Red";
      var passwordStrength = "";
      switch(passed){
          case 0:
              passwordStrength = "Senha insegura.";
              color = "Red";              
              break;
          case 1:
              passwordStrength = "Senha insegura.";
              color = "Red";
              break;
          case 2:
              passwordStrength = "Boa senha.";
              color = "darkorange";
              break;
          case 3:
                  break;
          case 4:
              passwordStrength = "Senha segura.";
              color = "Green";
              break;
          case 5:
              passwordStrength = "Senha muito segura.";
              color = "darkgreen";
              break;
          default:
              passwordStrength = "Senha insegura.";
              color = "Red";
          
      }
      password_strength.innerHTML = 'Mínimo 6 caracteres. ('+passwordStrength+')';
      password_strength.style.color = color;
  }

  $( "#campoSenha" ).keyup(function() {
    CheckPasswordStrength( $(this).val() );
  });


  function vf_sigup(){
    if(error==true){
      return msge;
    }else{
      return false;
    }
  }


  $( "#btCads" ).click(function() {
    var error=false;  
    var msge='';  
    if($('#campoNome').val().length<4){error=true; msge +='Informe corretamente o campo nome'+"\n";}
    if($('#campoSobrenome').val().length<4){error=true; msge +='Informe corretamente o campo sobrenome'+"\n";}
    if($('#campoEmail').val().length<4){error=true; msge +='Informe corretamente o campo email'+"\n";}
    if($('#campoTelefone').val().length<4){error=true; msge +='Informe corretamente o campo telefone'+"\n";}
    if( isValidCPF( $('#campoCpf').val() )== false){error=true; msge +='Informe corretamente o campo CPF'+"\n";}
    if($('#campoUf').val().length<2){error=true; msge +='Selecione o estado'+"\n";}
    if($('#campoCidade').val().length<4){error=true; msge +='Selecione a cidade'+"\n";}
    if($('#campoSenha').val().length<6){error=true; msge +='Sua senha deve ter pelo menos 6 caracteres!'+"\n";}
    if($('#campoConfSenha').val()!=$('#campoSenha').val()){error=true; msge +='O campo senha e confirme não são idênticos!'+"\n";}

    if(error==true){
      alert(msge);
    }else{
      $('#adUser').submit();
    }
  });

  /*
   * botao de submissao de form para configuracao do pedido
   * */
$(document).on("click", "#sb2conf", function(event){
    $('#cnfPed').submit();
});
