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
                            <th>Department adı</th>
                            <th>Əməliyyat</th>
                           
                
                        </tr>
                    </thead>
                </table>
            </div>
    </div>
    <!-- end col -->
    @include('admin.pages.department.modal')
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
                       $("#derpartment-modal").modal('toggle');
                    },
                }

                  
              ],
                "ajax": '{{ route('department.list')}}',
                
                "columns": [
                    { "data": 'id' },
                    { "data": 'name' },
                    { 
                        "data": 'id',
                        "render": function (param) { 
                          return   `<button class='btn btn-danger destroy' title='Sil' data-id="`+param+`" route="{{route('department.destroy','destroy')}}"><i class=' ri-delete-bin-2-line'></i></button>
                          <button class='btn btn-info edit' title='Düzənlə' data-id="`+param+`" ><i class='fas fa-pen'></i></button>
                                 `;
                         }

                    },

                ],
            });

            function reload(){
                table.ajax.reload();
            }
            $("#save-departament").click(function (e) { 
                e.preventDefault();
                let data = {
                    _token : "{{ csrf_token() }}",
                    name: $("#name").val()
                }                
                $.post("{{route('department.store')}}", data,
                    function (response) {
                     if(response.code == 200){
                       
                        table.ajax.reload();
                        $("#create-form").trigger("reset");
                        $("#derpartment-modal").modal('toggle');
                     }
                    }).fail(function(error) {
                       $.each(error.responseJSON, function (index, value) { 
                        toastr.error(value)
                       });
                    });;
            });



            $(document).on('click','.edit',function(){
            let id = $(this).data('id');
            let url = "{{route('department.edit','edit')}}"
            url = url.replace('edit',id);

            let data = {
                _token: "{{csrf_token()}}",
                id: id
            };
            
            $.get(url, function (response) {
                    if(response.code == 200){
                        $("#edit-name").val(response.data.name);
                        $("#edit-id").val(response.data.id);
                        $("#derpartment-modal-edit").modal('toggle');
                    }
                });
        });

        $("#edit-departament").click(function(){
            let data = $("#edit-form").serialize();
            let id = $(this).data('edit-id');
            let url = "{{route('department.update','update')}}"
            url = url.replace('update',id);
            console.log(data);
            $.post(url, data,
                function (response) {
                    if(response.code == 200){
                        table.ajax.reload();
                        $("#create-form").trigger("reset");
                        $("#derpartment-modal-edit").modal('toggle');
                    }
                });
          
     
        })


        });

        
    </script>

@endpush