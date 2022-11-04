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

                <table id="users" class="table table-nowrap dt-responsive table-bordered display table-striped " style="width:100%">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Ad</th>
                            <th>Email</th>
                            <th>active</th>
                           
                
                        </tr>
                    </thead>
                </table>
            </div>
    </div>
    <!-- end col -->
</div>
@endsection



@push('js_stack')
    <script>
        $(document).ready(function () {
            let table = new DataTable('#users', {
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/az-AZ.json"
                },
                dom: 'Bfrtip',
                buttons: [
                  { extend: 'pdf', text: '<i class="fas fa-file-pdf fa-1x" aria-hidden="true"> Exportar a PDF</i>' },
                  { extend: 'csv', text: '<i class="fas fa-file-csv fa-1x"> Exportar a CSV</i>' },
                  { extend: 'excel', text: '<i class="fas fa-file-excel" aria-hidden="true"> Exportar a EXCEL</i>' },
                  'pageLength'
              ],
                "ajax": '{{ route('user.list')}}',
                
                "columns": [
                    { "data": 'id' },
                    { "data": 'name' },
                    { "data": 'email' },
                    { 
                        "data": 'email',
                        "render": function (param) { 
                          return   "<button class='btn btn-danger'><i class=' ri-delete-bin-2-line'></i></button>";
                         }

                    },

                ],
            });
        });
    </script>

@endpush
