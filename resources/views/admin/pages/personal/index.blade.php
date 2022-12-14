@extends('admin.layouts.main')
@section('content')

<div class="row">
    
    <div class="col-lg-12">
{{-- 
        {{ Breadcrumbs::render('user') }} --}}
    </div>
    <div class="col-lg-12">
        <div class="card">
           
            <div class="card-body">

                <table id="users" class="table data-tabe table-nowrap dt-responsive table-bordered display table-striped " style="width:100%">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Ad soyad</th>
                            <th>Email</th>
                            <th>Deparatament</th>
                            <th>Vəzif</th>
                            <th>Əməliyat</th>
                        </tr>
                    </thead>
                </table>
            </div>
    </div>
    <!-- end col -->
    @include('admin.pages.personal.modal')
</div>
@endsection



@push('js_stack')
    <script>
        $(document).ready(function () {
           

            let table = new DataTable('#users', {
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/az-AZ.json"
                },
                dom: '<"html5buttons"B>lTfgitp',
                lengthChange: true,
                buttons: [
                  { extend: 'pdf', text: '<i class="fas fa-file-pdf fa-1x" aria-hidden="true"></i> PDF' },
                  { extend: 'csv', text: '<i class="fas fa-file-csv fa-1x"></i> CSV' },
                  { extend: 'excel', text: '<i class="fas fa-file-excel" aria-hidden="true"></i> EXCEL' },   
                  'colvis',
                  {
                    text: '<i class="fas fa-plus"></i> Əlavə et',
                    className: 'btn btn-success left',
                    action: function(e, dt, node, config) {
                       $("#personal-modal").modal('toggle');
                    },
                }
              ],
                "ajax": '{{ route('personal.list')}}',
                "columns": [
                    { "data": 'id' },
                    { "data": 'full_name' },
                    { "data": 'email' },
                    { 
                        "data": 'department',
                        "render": function (department) { 
                          return department.name ;         
                         }
                    },
                    { 
                        "data": 'position',
                        "render": function (position) { 
                          return position.name ;         
                         }
                    },
                    { 
                        "data": 'id',
                        "render": function (param) { 
                          return   `<button class='btn btn-danger destroy' title='Sil' data-id="`+param+`" route="{{route('position.destroy','destroy')}}"><i class=' ri-delete-bin-2-line'></i></button>
                                    <button class='btn btn-info edit' title='Düzənlə' data-id="`+param+`" ><i class='fas fa-pen'></i></button> `;         
                         }
                    },
                ],
            });

    
            $("#save-personal").click(function (e) { 
                e.preventDefault();
                let data = {
                    _token : "{{ csrf_token() }}",
                    name: $("#name").val(),
                    surname: $("#surname").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    position_id: $("#position_id").val(),
                    department_id: $("#department_id").val(),
                }                            
                $.post("{{route('personal.store')}}", data,
                    function (response) {
                     if(response.code == 200){
                        console.log(response.data)
                        table.ajax.reload();
                        $("#create-form").trigger("reset");
                        $("#personal-modal").modal('toggle');
                        console.log(xhr.responseText);
                     }
                    }).fail(function(error) {
                       $.each(error.responseJSON, function (index, value) { 
                        toastr.error(value)
                       });
                    });
            });

            $(document).on('click','.edit',function(){
            let id = $(this).data('id');
            let url = "{{route('personal.edit','edit')}}"
            url = url.replace('edit',id);
            let data = {
                _token: "{{csrf_token()}}",
                id: id
            };
            
            $.get(url, function (response) {
                      $('#edit-form').trigger("reset");
                    if(response.code == 200){
                        $('#edit-form').trigger("reset");
                        $("#edit-name").val(response.data.name);
                        $("#edit-surname").val(response.data.surname);
                        $("#edit-email").val(response.data.email);
                        $("#edit-password").val(response.data.password);
                        $("#edit-id").val(response.data.id);
                        $('#edit-department_id option[value="'+ response.data.department_id +'"]').attr("selected", "selected");
                        $('#edit-position_id option[value="'+ response.data.position_id +'"]').attr("selected", "selected");
                       
                        $("#personal-modal-edit").modal('toggle');
                    }
                });
        });

                $("#edit-position").click(function(){
                    let data = $("#edit-form").serialize();
                 
                    let id = $("#edit-id").val();
                    let url = "{{route('personal.update','edit-id')}}"
                    url = url.replace('edit-id',id);
                    $.post(url, data,
                        function (response) {
                            if(response.code == 200){
                                table.ajax.reload();
                                $("#create-form").trigger("reset");
                                $("#personal-modal-edit").modal('toggle');
                            }
                        });
              })
            //  

              
        });

    </script>
    <script>
      </script>

@endpush
