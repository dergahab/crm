@extends('admin.layouts.main')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">İcazə Yarat</h4>
                <div class="flex-shrink-0">

                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <form action="{{ route('role.create') }}" method="POST">
                    @csrf
                    @include('admin.pages.roles.__form')
                </form>

            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    @endsection