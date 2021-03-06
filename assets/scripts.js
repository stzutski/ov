$( document ).ready(function() {
  // Handler for .ready() called.


  $("#tajax").click(function() {
      $.ajax({
        url: 'http://localhost/labs/ov/ajx?tipo=alert&msg=um-teste',
        success:
        function(data){
          eval(data);
        }
      });
  });

  //rotina de recuperacao de senha de acesso
  $(".btn-lstpwd").click(function() {
      
      if($('#recuperar').val()==''){
          alert('Informe o email do cadastro');
      }else{
      
          let goUrl     = $(this).attr("data-go"); //to card
          var dataForm  = $( "#lostpwd" ).serialize();
          var request   = $.ajax({
            url: goUrl,
            method: "POST",
            data: dataForm,
            dataType: "html",
            success: function(data) {
                eval(data);
              }
          }); 
      
    }

  });

  //rotina de recuperacao de senha de acesso
  $(".btn-reconf").click(function() {

      if($('#emladdr').val()==''){
          alert('Informe o email do cadastro');
      }else{
      
          let goUrl     = $(this).attr("data-go"); //to card
          var dataForm  = $( "#reconf" ).serialize();
          var request   = $.ajax({
            url: goUrl,
            method: "POST",
            data: dataForm,
            dataType: "html",
            success: function(data) {
                eval(data);
              }
          }); 
      
    }

  });
  


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


});

//~ function emlAlerts(x){
  //~ alert(x);
  //~ let emlused = document.getElementById('emlUsed');
  //~ let emlok   = document.getElementById('emlOk');
  //~ let emlerr  = document.getElementById('emlErr');

  //~ emlused.style.display = "none";
  //~ emlok.style.display   = "none";
  //~ emlerr.style.display  = "none";
  
  //~ if(x=='0'){
    //~ emlok.style.display     = "none";
  //~ }
  //~ else if(x=='1'){
    //~ emlused.style.display   = "none";
  //~ }
  //~ else if(x=='2'){
    //~ emlerr.style.display    = "none";
  //~ }
  //~ else{
    
  //~ emlused.style.display     = "none";
  //~ emlok.style.display       = "none";
  //~ emlerr.style.display      = "none";
  
  //~ }
  
//~ }

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
