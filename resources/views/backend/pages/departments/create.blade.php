3

@extends('backend.layouts.master')

@section('title')
    Departments Create - Admin Panel
@endsection

@section('styles')


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
                    <h4 class="page-title pull-left">Departments Create</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.departments.index') }}">All Departments</a></li>
                        <li><span>Create Departments</span></li>
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
                        <h4 class="header-title">Create Departments</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.departments.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label for="dep_name">Departments Name</label>
                                    <input type="text" class="form-control" id="dep_name" name="dep_name" placeholder="Enter Departments Name">
                                    @error('dep_name')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="priority">Priority</label>
                                    <input type="number" class="form-control" id="priority" name="priority" placeholder="Enter Priority">
                                    @error('priority')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="exampleInputStatus">Status</label>
                                    <select class="form-control form-select" name="status" id="exampleInputStatus">
                                        <option value="">Chose</option>
                                        <option value="1">Active</option>
                                        <option value="2">De-Active</option>
                                    </select>

                                    @error('status')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>





                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')

@endsection
