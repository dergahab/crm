@extends('admin.layouts.main')
@section('content')

@include('admin.pages.task.inc.task-statistic')
<div class="row">
    <div class="col-lg-12">
        <div class="card" id="tasksList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Task list</h5>
                </div>
            </div>

            <!--end card-body-->
            <div class="card-body">
                <div class="table-responsive table-card mb-4">
                    <table class="table data-tabe table-nowrap dt-responsive table-bordered display table-striped " style="width:100%" id="tasks-table">
                        <thead class="">
                            <tr>
                                <th  style="width: 40px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th >ID</th>
                                <th>Layihə</th>
                                <th>Task</th>
                                <th>Təhkim olunanalar</th>
                                <th>Başlama vaxdı</th>
                                <th >Status</th>
                                <th>Prioritet</th>
                                <th>Əməliyyat</th>
                            </tr>
                        </thead>
                      
                    </table>
                    <!--end table-->
                   
                </div>
               
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->


@include('admin.pages.task.inc.modals')
@endsection



@push('js_stack')
    <script>
        $(document).ready(function () {
           
            let table = new DataTable('#tasks-table', {
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
                       $("#new-task-modal").modal('toggle');
                    },
                }
              ],
                "ajax": '{{ route('task.list')}}',
                "columns": [
                    { 
                         "data": 'id',
                        "render": function (param) { 
                          return  `<div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="chk_child" value="${param}'">
                                    </div>`; 
                         }
                    },
                    { "data": 'id' },
                    { "data": 'project' },
                    { "data": 'title' },
                    { 
                        "data": 'user',
                        "render": function (param) { 
                            let html = '<div class="avatar-group">';
                            param.forEach(item => {
                                html +=  `
                                        <a href="javascript: void(0);" class="avatar-group-item" data-img="avatar-3.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="${item.full_name}">
                                            <img src="{{asset('admin/assets/images/users/avatar-3.jpg')}}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                   `; 
                            });
                            html += ' </div>';
                          return html;  
                         }
                    },
                    { "data": 'start' },
                    { 
                        "data": 'status',
                        "render": function (status) { 
                          return   `<span class="badge badge-soft-secondary text-uppercase" style="color:`+status.color+` !important" >`+status.name+`</span>`;    
                         }
                    },
                    { 
                        "data": 'priority',
                        "render": function (priority) { 
                          return  `<span class="badge  text-uppercase" style="background-color: `+priority.color+` !important">`+priority.name+`</span>`;    
                         }
                    },
                    { 
                        "data": 'id',
                        "render": function (param) { 
                            let id = param;
                        let url = "{{route('task.details','show')}}"
                        url = url.replace('show',id);
                          return   `<button class='btn btn-danger destroy' title='Sil' data-id="`+param+`" route="{{route('task.destroy','destroy')}}"><i class=' ri-delete-bin-2-line'></i></button>
                          <a href="`+url+`"  class='btn btn-warning show' title='Bax' data-id="`+param+`" ><i class='fas fa-eye'></i></a>
                                     <button class='btn btn-info edit' title='Düzənlə' data-id="`+param+`" ><i class='fas fa-pen'></i></button>`;
                                 
                         }

                    },
                ],
            });
    
            $("#add-btn").click(function (e) { 
                e.preventDefault();
               let data = $("#new-task-form").serialize();
                $.post("{{route('task.store')}}", data,
                    function (response) {
                     if(response.code == 200){
                        console.log(response.data)
                        table.ajax.reload();
                        $("#new-task-form").trigger("reset");
                        $("#new-task-modal").modal('toggle');
                     }
                    }).fail(function(error) {
                       $.each(error.responseJSON, function (index, value) { 
                        toastr.error(value)
                       });
                    });
            });


            $(document).on('click','.edit',function(e){
                let id = $(this).data('id');
                let url = "{{route('task.edit','edit')}}"
                url = url.replace('edit',id);
                let data = {
                    _token: "{{csrf_token()}}",
                    id: id
                };

                $.get(url, function (response) {
                    if(response.code == 200){

                        $("#edit-project").val(response.data.project);
                        $("#edit-title").val(response.data.title);
                        $("#edit-description").val(response.data.description);
                        $("#edit-start").val(response.data.start);
                        $("#edit-deadline").val(response.data.deadline);
                        $('#edit-priority').val(response.data.priority);
                        $('#edit-status').val(response.data.status);
                        $('#edit-deadline').val( response.data.deadline);
                        $('#edit-id').val( response.data.id);

                        $('.users').each(function() {
                            if(response.data.user_ids.includes( parseInt( $(this).val()))){
                                $(this).attr('checked',true);
                            }
                        });
                        $("#edit-task-modal").modal('toggle');
                    }
                });
    
                $("#update-btn").click(function(){
                    let id = $("#edit-id").val();
                    let  data = $("#edit-task-form").serialize();
                    let url = "{{route('task.update','update')}}"
                    url = url.replace('update',id);
                   

                    $.post(url, data,
                        function (response) {
                            if(response.code == 200){
                                table.ajax.reload();
                                // $("#edit-task-form").trigger("reset");
                                $("#edit-task-modal").modal('toggle');
                            }
                        });
                })


            })
        });
    </script>
@endpush

