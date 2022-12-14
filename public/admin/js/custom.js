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

    Swal.fire({
        title: 'Silmək isətiyinizdən əminsiz?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'İmtina et',
        confirmButtonText: 'Sil'
      }).then((result) => {
        if (result.isConfirmed) {
            console.log(result);
            if(result.isConfirmed){
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: { id: id},
                    success: function (response) {
                        if(response.code == 200){
                            toastr.success("Məlumat silindi")
                            $('.data-tabe').DataTable().ajax.reload();
                        }
                    }
                });
            }

         
        }
      })

});

$(document).on('click','.atendent_delete', function(){
    let id = $(this).data('id');
    let task = $(this).data('task');
    let url = $(this).attr('route');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Swal.fire({
        title: 'İşci bu taskın təhim olunalarıdan çıxarılsın?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'İmtina et',
        confirmButtonText: 'Təsdiqlə'
      }).then((result) => {
        if (result.isConfirmed) {
            if(result.isConfirmed){
                $.ajax({
                    type: "Post",
                    url: url,
                    data: { id: id,task:task},
                    success: function (response) {
                        if(response.code == 200){
                            toastr.success("Fayl silindi")
                            $('#task-peron-'+id).remove()
                            $('.data-tabe').DataTable().ajax.reload();
                        }
                    }
                });
            }

         
        }
      })
});


$(document).on('click','#file-delete', function(){
    let id = $(this).data('id');
    let task = $(this).data('task');
    let url = $(this).attr('route');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Swal.fire({
        title: 'Faylı silmək isətiyinizdən əminsiz?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'İmtina et',
        confirmButtonText: 'Sil'
      }).then((result) => {
        if (result.isConfirmed) {
            if(result.isConfirmed){
                $.ajax({
                    type: "Post",
                    url: url,
                    data: { id: id,task:task},
                    success: function (response) {
                        if(response.code == 200){
                            toastr.success("Fayl silindi")
                            $('#file-box-'+id).remove()
                            $('.data-tabe').DataTable().ajax.reload();
                        }
                    }
                });
            }

         
        }
      })
});