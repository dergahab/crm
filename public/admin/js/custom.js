  $(document).ready(function() {
    $(".select2").select2();
});

$(document).on("click",".destroy",function(){
    let url = $(this).attr('route');
    let id = $(this).data('id');

    url = url.replace('destroy',id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "DELETE",
        url: url,
        data: { id: id},
        success: function (response) {
            if(response.code == 200){
                swal.fire({
                    title: 'Error!',
                    text: 'Melumat silindi',
                    icon: 'info',
                   
                });
                $('.data-tabe').DataTable().ajax.reload();
            }
        }
    });
});