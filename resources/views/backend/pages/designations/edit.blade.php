
@extends('backend.layouts.master')

@section('title')
    Designations Edit - Admin Panel
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection


@section('admin-content')

    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Designations Create</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.designations.index') }}">All Designations</a></li>
                        <li><span>Edit Designations - {{$designation->d_name}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Designations - {{ $designation->deg_name }}</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.designations.update', $designation->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="d_name">Departments  Name</label>
                                    <select class="form-control form-select" name="dep_id" id="dep_id">
                                        <option value="">Chose</option>
                                        @foreach($departments as $depData)


                                            <option value="{{$depData->id}}">{{$depData->dep_name}}</option>


                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="deg_name">Designations Name</label>
                                    <input type="text" class="form-control" id="deg_name" name="deg_name" placeholder="Enter Designations Name" value="{{$designation->deg_name }}">
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="exampleInputStatus">Status</label>
                                    <select class="form-control form-select" name="status" id="exampleInputStatus">
                                        <option value="">Chose</option>
                                        <option value="1" {{$designation->status == 1 ? 'selected': ''}}>Active</option>
                                        <option value="2" {{$designation->status == 2 ? 'selected': ''}}>De-Active</option>
                                    </select>
                                </div>

                            </div>



                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save User</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>
@endsection
