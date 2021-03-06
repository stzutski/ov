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
  
  
  
  
  

});
