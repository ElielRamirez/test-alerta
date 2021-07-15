

$(function() {
    // Document is ready
    $('#addMeterForm').on('submit',function(e){
        e.preventDefault();
        $.ajax({
          url: '/api/meter',
          type: 'POST',
          data : $(this).serialize(),
          success: function(response){
            console.log(response);
            $('#meterModal').modal('toggle');
            alert('Se creo nuevo medidor')
            location.reload();
          },
          error:function(xhr, ajaxOptions, thrownError){
              let errors = xhr.responseJSON.errors;
              let strErrors='';
              for(const error in errors){
                  strErrors += `<li>${error}</li>`
              }
              console.log(strErrors)
              $('#addMeterForm').prepend(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <p>Verifique los siguientes datos:</p>  
              <ul>${strErrors}</ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>`);
            setTimeout(()=>$(".alert").alert('close'),5000)
          }

        });
        return false;
    });
  $('.delete').on('click',function(e){
    let numMeter =  $(this).data('num-meter');
    $.ajax({
      url: `/api/meter/${numMeter}`,
      type: 'DELETE',
      success: function(response){
        
        alert('se elimino Medidor')
        location.reload();

      },
      error:function(xhr, ajaxOptions, thrownError){
          
        alert('fallo la eliminacion')
      }

    });
  })

});
