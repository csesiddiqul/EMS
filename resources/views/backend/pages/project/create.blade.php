
@extends('backend.layouts.master')

@section('title')
    Projects Add - Admin Panel
@endsection

@section('styles')
    <script src="{{ asset('backend/assets/js/vendor/jquery-3.6.1.min.js') }}"></script>
@endsection


@section('admin-content')

    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Projects Add </h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.projects.index') }}">All Projects</a></li>
                        <li><span>Add Projects</span></li>
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
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Personal Information start -->
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            @include('backend.layouts.partials.messages')


                            <h4 class="header-title">Add Projects</h4>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="project_name">Projects</label>
                                    <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Enter Projects Name">
                                    @error('project_name')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="project_code">Projects Code</label>
                                    <input type="text" class="form-control" id="project_code" name="project_code" placeholder="Enter Projects Code">
                                    @error('project_code')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="assign_to">Assign To</label>
                                    <select  class="form-control form-select" name="assign_to" id="assign_to">
                                        <option value="">Chose</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach
                                    </select>


                                    @error('assign_to')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="status">Status</label>
                                    <select  class="form-control form-select" name="status" id="status">
                                        <option value="">Chose</option>
                                        <option value="1">Active</option>
                                        <option value="1">On-Hold</option>
                                        <option value="1">Complete</option>

                                    </select>


                                    @error('status')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                </div>


                            </div>



                            <div class="form-group">
                                <label for="file">SRS</label>
                                <input type="file" name="file" class="form-control"  placeholder="Choose File..">
                            </div>
                            @error('file')
                            <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>



            <button type="submit" class="btn btn-success float-right mt-4 pr-4 pl-4">Save Data</button>
            <div class="clearfix"></div>
        </form>


@endsection

@section('scripts')
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        function clickTag(did){
            if(did){
                $.ajax({
                    type:"GET",
                    url: '/getdslist?dep_id='+did,
                    success:function(res){

                        if(res){
                            $("#deg_name").empty();
                            $("#deg_name").append('<option>Select Designation</option>');
                            $.each(res,function(key,value){
                                $("#deg_name").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }else{
                            $("#deg_name").empty();
                        }
                    }
                });
            }else{
                $("#deg_name").empty();
            }
        }
    </script>





            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.select2').select2();
                })
            </script>
@endsection
