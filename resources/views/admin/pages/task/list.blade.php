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
                                <th>Faylar</th>
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
@include('admin.pages.task.inc.task_detale')
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
                buttons: [{
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf fa-1x" aria-hidden="true"></i> PDF'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv fa-1x"></i> CSV'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel" aria-hidden="true"></i> EXCEL'
                    },
                    'colvis',
                    {
                        text: '<i class="fas fa-plus"></i> Əlavə et',
                        className: 'btn btn-success left',
                        action: function (e, dt, node, config) {
                            $("#new-task-modal").modal('toggle');
                        },
                    }
                ],
                "ajax": "{{ route('task.list')}}",
                "columns": [{
                        "data": 'id',
                        "render": function (param) {
                            return `<div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="chk_child" value="${param}'">
                                    </div>`;
                        }
                    },
                    {
                        "data": 'id'
                    },
                    {
                        "data": 'project'
                    },
                    {
                        "data": 'title'
                    },
                    {
                        "data": 'user',
                        "render": function (param) {
                            let html = '<div class="avatar-group">';
                            param.forEach(item => {
                                html += `
                                        <a href="javascript: void(0);" class="avatar-group-item" style="margin-left:0px !important" data-img="avatar-3.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="${item.full_name}">
                                            <img src="{{asset('admin/assets/images/users/avatar-3.jpg')}}" alt="" class="rounded-circle avatar-xxs">
                                        </a>
                                   `;
                            });
                            html += ' </div>';
                            return html;
                        }
                    },
                    {
                        "data": 'files',
                        "render": function (files) {
                            let html = '<div class="avatar-group">';
                            files.forEach(item => {
                                html += `
                                        <a href="${item.path}" target="_blanck" class=""  title="${item.name}">
                                           <i class="fas fa-file-contract fa-2x"></i>
                                        </a>
                                   `;
                            });
                            html += ' </div>';
                            return html;
                        }
                    },
                    {
                        "data": 'start'
                    },
                    {
                        "data": 'status',
                        "render": function (status) {
                            return `<span class="badge badge-soft-secondary text-uppercase" style="color:` + status.color + ` !important" >` + status.name + `</span>`;
                        }
                    },
                    {
                        "data": 'priority',
                        "render": function (priority) {
                            return `<span class="badge  text-uppercase" style="background-color: ` + priority.color + ` !important">` + priority.name + `</span>`;
                        }
                    },
                    {
                        "data": 'id',
                        "render": function (param) {
                            let id = param;
                            let url = "{{route('task.details','show')}}"
                            url = url.replace('show', id);
                            return `<button class='btn btn-danger destroy' title='Sil' data-id="` + param + `" route="{{route('task.destroy','destroy')}}"><i class=' ri-delete-bin-2-line'></i></button>
                          <button   class='btn btn-warning show' title='Bax' data-id="` + param + `" ><i class='fas fa-eye'></i></button>
                                     <button class='btn btn-info edit' title='Düzənlə' data-id="` + param + `" ><i class='fas fa-pen'></i></button>`;

                        }

                    },
                ],
            });

            $("#add-btn").click(function (e) {
                e.preventDefault();
                //    let data = $("#new-task-form").serialize();
                $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                 formData = new FormData();

                 var totalfiles = document.getElementById('file').files.length;

                    for (var index = 0; index < totalfiles; index++) {
                        formData.append("file[]", document.getElementById('file').files[index]);
                    }
                    let users = []

                    $($('.user_id')).each(function (index, element) {
                        formData.append("user_id[]", $(element).val());
                    });


                formData.append("_token", "{{csrf_token() }}");
                formData.append("project", $("#project").val());
                formData.append("title", $("#title").val());
                formData.append("description", $("#description").val());
                formData.append("start", $("#start").val());
                formData.append("deadline", $("#deadline").val());
                formData.append("priority", $("#priority").val());
                formData.append("status_id", $("#status_id").val());
               
                $.ajax({
                    enctype: 'multipart/form-data',
                    type: "POST",
                    url: "{{route('task.store')}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        table.ajax.reload();
                        $("#new-task-form").trigger("reset");
                        $("#new-task-modal").modal('toggle');
                    },
                    error: function (error) {
                        $.each(error.responseJSON, function (index, value) {
                            toastr.error(value)
                        });
                    }
                });

            });

            $(document).on('click', '.edit', function (e) {
                let id = $(this).data('id');
                let url = "{{route('task.edit','edit')}}"
                url = url.replace('edit', id);
                let data = {
                    _token: "{{csrf_token()}}",
                    id: id
                };

                $.get(url, function (response) {
                    if (response.code == 200) {
                        $("#edit-project").val(response.data.project);
                        $("#edit-title").val(response.data.title);
                        $("#edit-description").val(response.data.description);
                        $("#edit-start").val(response.data.start);
                        $("#edit-deadline").val(response.data.deadline);
                        $('#edit-priority').val(response.data.priority);
                        $('#edit-status').val(response.data.status_id);
                        $('#edit-id').val(response.data.id);

                        $('.edit_user_id').each(function () {
                            if (response.data.user_ids.includes(parseInt($(this).val()))) {
                                $(this).attr('checked', true);
                            }
                        });
                        $("#edit-task-modal").modal('toggle');
                    }
                });

            })

            $("#update-btn").click(function (e) {
                e.preventDefault();

                let id  = $("#edit-id").val();
                let url = "{{route('task.update','update')}}"
                url = url.replace('update', id);
                editFormData = new FormData();

                var edittotalfiles = document.getElementById('edit-file').files.length;
                for (var index = 0; index < edittotalfiles; index++) {
                    editFormData.append("file[]", document.getElementById('edit-file').files[index]);
                }

                $($('.edit_user_id')).each(function (index, element) {
                    editFormData.append("user_id[]", $(element).val());
                });

                editFormData.append("_token", "{{csrf_token() }}");
                editFormData.append("project", $("#edit-project").val());
                editFormData.append("title", $("#edit-title").val());
                editFormData.append("description", $("#edit-description").val());
                editFormData.append("start", $("#edit-start").val());
                editFormData.append("deadline", $("#edit-deadline").val());
                editFormData.append("priority", $("#edit-priority").val());
                editFormData.append("status_id", $("#edit-status").val());
                editFormData.append("id", $("#edit-id").val());
                editFormData.append("_method", $("input[name=_method]").val());

                $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    enctype: 'multipart/form-data',
                    type: "POST",
                    url: url,
                    data: editFormData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        table.ajax.reload();
                        $("#edit-task-modal").modal('toggle');
                    },
                    error: function (error) {
                        $.each(error.responseJSON, function (index, value) {
                            toastr.error(value)
                            return false;
                        });
                    }
                });

                })

                $(document).on('click', '.show',function(){
                    let id = $(this).data('id');
                            let url = "{{route('task.details','show')}}"
                            url = url.replace('show', id);
                    $.get(url,
                        function (response) {
                            if(response.code == 200){
                                console.table(response.data)
                                $("#dtitle").html(response.data.tesk)
                                $("#dproject").html(response.data.project)
                                $("#dpriority").html(`<span class="badge  text-uppercase" style="background-color: ` + response.data.priority.color + ` !important">` +  response.data.priority.name + `</span>`)
                                $("#dstatus").html(`<span class="badge  text-uppercase" style="background-color: ` + response.data.status.color + ` !important">` +  response.data.status.name + `</span>`)
                                $("#ddedline").html(response.data.deadline)
                                $("#dcontent").html(response.data.description)


                                let assign_to = '';

                                response.data.user
                                $.each(response.data.user, function (index, val) { 
                                    assign_to +=  ` <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{asset('admin/assets/images/users/avatar-9.jpg')}}" alt=""
                                                    class="avatar-xs rounded-circle">
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h6 class="mb-1"><a href="pages-profile.html">${val.full_name}</a></h6>
                                                <p class="text-muted mb-0">Full Stack Developer</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown">
                                                    <button class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>`;
                                });
                                $("#assign_to").html(assign_to)

                                let files = '';

                                response.data.file
                                $.each(response.data.user, function (index, val) { 
                                    files +=  ` `;
                                });
                                $("#assign_to").html(files)


                                $("#detaleModal").modal('toggle');
                            }
                        });
                })

        });
    </script>
@endpush

