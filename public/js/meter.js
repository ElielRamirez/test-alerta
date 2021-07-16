

$(function() {
  let trigger = () => {
    $('td#edit-meter').on('click', function(e) {
        const meter = $(this).data('meter');
        $.ajax({
            url: `/api/meter/${meter}`,
            type: 'GET',
            success: function(response) {
              $('#meterModalLabel').html('Editar Medidor');
              $('#addMeterForm #num_meter').val(response.num_meter).prop('disabled', true);
              $('#addMeterForm #description').val(response.description);
              $('#addMeterForm #version').val(response.version);
              $('#addMeterForm #type').val(response.type);
              $('#meterModal').modal('show');
              
                console.log(response)
            },
            error: function(xhr, ajaxOptions, thrownError) {}

        });
        
    });
}
$(function() {
    $.ajax({
        url: '/api/meter',
        type: 'GET',
        success: function(response) {
            let strFields = '';
            for (const item of response) {
                strFields += `<tr>
                            <td>${item.num_meter}</td>
                            <td>${item.description}</td>
                            <td>${item.version}</td>
                            <td class="text-uppercase">${item.type}</td>
                            <td>${!item.instalation_date? 'Inactivo':item.instalation_date}</td>
                            <td id="edit-meter" data-meter="${item.num_meter} data-toggle="modal" data-target="#meterModal">
                                <a href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="right" title="Editar"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>`;
            }
            $('#meters-table').prepend(strFields);
            $('#meters-table').DataTable({
              "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
            });
            trigger();
        },
        error: function(xhr, ajaxOptions, thrownError) {

        }

    });
    $('#addMeterForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/api/meter',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                console.log(response);
                $('#meterModal').modal('toggle');
                alert('Se creo nuevo medidor, de click en ACEPTAR para actualizar pagina.')
                location.reload();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                let errors = xhr.responseJSON.errors;
                let strErrors = '';
                for (const error in errors) {
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
                setTimeout(() => $(".alert").alert('close'), 5000)
            }

        });
        return false;
    });
    $('.delete').on('click', function(e) {
        let numMeter = $(this).data('num-meter');
        $.ajax({
            url: `/api/meter/${numMeter}`,
            type: 'DELETE',
            success: function(response) {

                alert('se elimino Medidor')
                location.reload();

            },
            error: function(xhr, ajaxOptions, thrownError) {

                alert('fallo la eliminacion')
            }

        });
    })
});
    
  $('#closeMeterModal').on('click',function (){
    $('#meterModal').modal('hide');

  })
  $('#meterModal button.close').on('click',function (){
    $('#meterModal').modal('hide');

  })

});
