$( document ).ready(function() {
  // Handler for .ready() called.

  /*re order*/
  if($('.zorder').length){
    var order='';
    $('.zorder').dragndrop({
      onDrop: function( element, droppedElement ) {
      $(".zorder").find("li").each(function(){ order += this.id + ','; });
      let table   = $('#'+element.id).attr("data-table");
      let idsrv   = $('#'+element.id).attr("data-ids");
      let urlProc = $('#'+element.id).attr("data-url");
      //console.log('!order '+order+' |table '+table+' |idc '+idsrv+' |url '+urlProc);
      zorderUpdate(order,table,idsrv,urlProc);
      order='';
      }
    });
  }
  

  if($('.zorderE').length){
    var order='';
    $('.zorderE').dragndrop({
      onDrop: function( element, droppedElement ) {
      $(".zorderE").find("li").each(function(){ order += this.id + ','; });
      let table   = $('#'+element.id).attr("data-table");
      let idsrv   = $('#'+element.id).attr("data-ids");
      let urlProc = $('#'+element.id).attr("data-url");
      //console.log('!order '+order+' |table '+table+' |idc '+idsrv+' |url '+urlProc);
      zorderUpdate(order,table,idsrv,urlProc);
      order='';
      }
    });
  }


  
  
  

  /* botao clonar */          
  $(".btn-clone").click(function() {
    let urlProc  = $(this).attr("data-procurl"); //to card
    var confirma = confirm('Deseja clonagem do servico, fases e etapas?');
    if(confirma){
        var request   = $.ajax({
        url: urlProc,
        method: "POST",
        data: { go: 'cloneserv'},
        dataType: "html",
        success: function(data) {
        eval(data);
        }
      });      
    }
  });
  
  

  /* end reorder*/          
  $("#tajax").click(function() {
      $.ajax({
        url: 'http://localhost/labs/ov/ajx?tipo=alert&msg=um-teste',
        success:
        function(data){
          eval(data);
        }
      });
  });
  
  //ROTINA PARA HABILITAR E DESABILITAR FORMULARIOS
  $('.onoff-form').click(function() {
    let idForm  = $(this).attr("data-idform"); //to card
    var delay   = 500; //1 seconds
    setTimeout(function(){
      if( $('#id_'+idForm).is(":checked") == true ){
        $('#'+idForm+'_onoff').prop( "disabled", false );
        $('.frmRemove_onoff').prop( "disabled", false );
        //enable
      }
      else
      {
        $('#'+idForm+'_onoff').prop( "disabled", true );
        $('.frmRemove_onoff').prop( "disabled", true );
        //disable
      }            
       //your code to be executed after 1 seconds
    },delay);    
    
  });


  /*rotina select Jump*/
  $( ".jumpTo" ).change(function() {
    let goUrl       = $(this).attr("data-go"); //to card
    let uid         = $(this).val();
    console.log( goUrl+uid );
    window.location = goUrl+uid;
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

/*
 * funcao para reordenar itens em uma tabela Z-ORDENADA
 * */
function zorderUpdate(reorder,tb,idsrv,urlProc){
  //alert('go: reorder, table: '+tb+', ids: '+idsrv+', order: '+reorder+'');
  
  var request   = $.ajax({
    url: urlProc,
    method: "POST",
    data: { go: 'reorder', table: tb, ids: idsrv, order: reorder},
    dataType: "html",
    success: function(data) {
    eval(data);
    }
  }); 
  
}



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
