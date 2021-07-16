

$(function() {
  let trigger = () => {
    $('#edit-meter').on('click', function(e) {
        const meter = $(this).data('meter');
        $.ajax({
            url: `/api/meter/${meter}`,
            type: 'GET',
            success: function(response) {
                console.log(response)
            },
            error: function(xhr, ajaxOptions, thrownError) {}

        });
        $('#meterModal').modal('show');
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
                            <td id="edit-meter" data-meter="${item.num_meter}">
                                <a href="javascript:;"><i class="fas fa-edit"></i></a>
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
    
  

});
