function getData(url, elementId){
    Swal.fire({title: 'Memuat data..', icon: 'info', toast: true, position: 'top-end', showConfirmButton: false, timer: 0});
    $.ajax({
        url: url,
        type: "get",
        datatype: "html"
    }).done(function(data){
        Swal.fire({title: 'Selesai', icon: 'success', toast: true, position: 'top-end', showConfirmButton: false, timer: 2500, timerProgressBar: false,});
        $(elementId).empty().html(data);
        $('[data-toggle="tooltip"]').tooltip();
    }).fail(function(jqXHR, ajaxOptions, thrownError){
        Swal.fire({html: 'No response from server', icon: 'error', toast: true, width: '100%', position: 'top', showConfirmButton: true, timer: 0});
    });
}
