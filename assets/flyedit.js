/*
 * flyedit JS 
 * */

var val2Save='';
jQuery.fn.extend({
    flyedit: function (args) {
        /* Mascaras em Javascript (26/08/2008)
         * By Matheus Biagini de Lima Dias
         * Many Thanks ;)
         * */
        
        var jsmasks         = [];
        jsmasks['integer']  = 'onKeyDown="Mascara(this,Integer);" onKeyPress="Mascara(this,Integer);" onKeyUp="Mascara(this,Integer);"';
        jsmasks['zipbr']    = 'onKeyDown="Mascara(this,Cep);" onKeyPress="Mascara(this,Cep);" onKeyUp="Mascara(this,Cep);"';
        jsmasks['cnpj']     = 'onKeyDown="Mascara(this,Cnpj);" onKeyPress="Mascara(this,Cnpj);" onKeyUp="Mascara(this,Cnpj);"';
        jsmasks['cpf']      = 'maxlength="14" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);"';
        jsmasks['data']     = 'onKeyDown="Mascara(this,Data);" onKeyPress="Mascara(this,Data);" onKeyUp="Mascara(this,Data);"';
        jsmasks['moeda']    = 'onKeyDown="Mascara(this,Valor);" onKeyPress="Mascara(this,Valor);" onKeyUp="Mascara(this,Valor);"';
        jsmasks['telefone'] = 'onKeyDown="Mascara(this,Telefone);" onKeyPress="Mascara(this,Telefone);" onKeyUp="Mascara(this,Telefone);"';
        jsmasks['website']  = 'onKeyDown="Mascara(this,Site);" onKeyPress="Mascara(this,Site);" onKeyUp="Mascara(this,Site);"';
        jsmasks['email']    = 'onKeyDown="Mascara(this,Email);" onKeyPress="Mascara(this,Email);" onKeyUp="Mascara(this,Email);"';
        var fieldMask ='';
        var tagForm  ='';

      
        $(this).addClass( "flyfd" );
        $(this).click(function(e) {
          e.preventDefault();
          var el        = $(this);//current element
          var cid       = el.attr('id');
          var value     = el.text();
          var oldValue  = value;
          var ftype     = el.attr("data-type");
          var fopts     = el.attr("data-opts");
          var fmask     = el.attr("data-mask");
          var fmax      = el.attr("data-max");
          var baseUrl   = el.attr("data-url");
          
          var brc='';
          if(ftype=='textarea'){var brc='<br clear="all">';}
          
          //buttons & container
          var fcButtons         = '&nbsp;<button class="bt-save btn btn-primary btn-sm" type="button"><i class="fas fa-check"></i></button>&nbsp;<button class="bt-cancel btn btn-warning btn-sm" type="button"><i class="fas fa-window-close fa-lg"></i></button>';
          var containerStart    = '<span id="c_'+cid+'" class="spFly"><div class="spFlyfield">';
          var containerEnd      = '</div>'+brc+'<div class="spFlyfield-btn">'+fcButtons+'</div></span>';
          //var containerEnd      = ''+fcButtons+'</div></span>';
          
          var fopt='';
          if(el.attr("data-opts")){
          var fopts = el.attr("data-opts");
            if(fopts!=''){
              var opts = fopts.split("|");
              for (o = 0; o < opts.length; o++)
              {
                var Value=opts[o];
                fopt = fopt + '<option value="'+Value+'">'+Value+'</option>';
              }
            }else{
              fopt = '<option value="">N/D</option>';
            }
          }
          
          if(fmax!=''){
              fmax = ' maxlength="'+fmax+'" ';
          }else{fmax='';}
          
          if(ftype=='text'){
            if(fmask!=''){fieldMask= jsmasks[fmask];}else{fieldMask='';}//if use mask
            tagForm = '<input  onclick="select()" class="flytext" type="text" id="'+cid+'_field" value="'+value+'" '+fieldMask+fmax+' / >';
          }
          
          if(ftype=='textarea'){
            if(fmask!=''){fieldMask= jsmasks[fmask];}else{fieldMask='';}//if use mask
            tagForm = '<textarea class="flytextarea" type="text" id="'+cid+'_field" / >'+value+'</textarea>';
          }
          
          if(ftype=='select'){
            tagForm = '<select class="flyselect" id="'+cid+'_field"><option>Selecione</option>'+fopt+'</select>';
          }
          
          
          
          //append tag after element
          if(tagForm){
            el.after(containerStart+tagForm+containerEnd);
            if($('#'+cid+'_field').val()!=value){
              $('#'+cid+'_field').val('');
            }
            $('#'+cid+'_field').focus();
            //$('#'+cid+'_field').select();
          }
          
          //click botao cancelar fecha o campo e retorna o status anterior
          $(".bt-cancel").click(function() {
            $("#c_"+cid).hide();
            el.css('display','inline');          
          });
          
          
          
          function save(cid,bUrl){

            //~ var save=false;
            //~ var val2save ='';
            //click botao para salvar os dados informados no campo
              $("#c_"+cid).hide();
              if(ftype=='text')     {var tx = $( "#"+cid+"_field" ).val();}
              if(ftype=='select')   {var tx = $( "#"+cid+"_field option:selected" ).text();}
              if(ftype=='textarea') {var tx = $( "#"+cid+"_field" ).val();}   
              if(tx!=''&&value!=''){el.text(tx);}
              if(tx==''&&value!=''){el.text('informar');}
              if(tx==''&&value==''){el.text('vazio');}
              let uid = el.attr("data-pk");
              el.html('<img src="'+bUrl+'assets/loading-flyedit.gif" />');   
              el.css('display','inline');   
              //~ save=true;   
              
                var request   = $.ajax({
                  url: baseUrl+'ajx',
                  method: "POST",
                  data: { go: 'ficha', pk: uid, content: tx },
                  dataType: "html",
                  success: function(data) {
                  eval(data);
                  }
                });           
            
          }           
          
          //~ var save=false;
          //~ var val2save ='';
          
          //click botao para salvar os dados informados no campo
          $(".bt-save").click(function() {
            save(cid,baseUrl);  
          });
          
          
          //hide virtualPlace holder
          el.css('display','none');
       
          
            $("#"+cid+"_field").keyup(function(e){
              if(e.keyCode == 13)
              {
              save(cid);
              }
            });
          
          
          
            
              $(document).mouseup(function(e) 
              {
                  var container = $("#c_"+cid);
                      // if the target of the click isn't the container nor a descendant of the container
                      if (!container.is(e.target) && container.has(e.target).length === 0) 
                      {
                          container.hide();
                          el.css('display','inline');
                    }
              });
          
          
          
        });
			}
});



$(document).ready(function () {


$('.form-ficha a').flyedit();
  


});
