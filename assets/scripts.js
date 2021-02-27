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

});
