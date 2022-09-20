
@extends('backend.layouts.master')

@section('title')
    Employee Add - Admin Panel
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
                    <h4 class="page-title pull-left">Employee Add </h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.employees.index') }}">All Employee</a></li>
                        <li><span>Add Employee</span></li>
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
        <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Personal Information start -->
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            @include('backend.layouts.partials.messages')


                            <h4 class="header-title">Add Employee</h4>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="name">Employee</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Employee Name">
                                    @error('name')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="email">Employee Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Employee Email">
                                    @error('email')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" autocomplete="new-password" >
                                    @error('password')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                                    @error('password_confirmation')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4 col-sm-6">
                                    <label for="username">Employee Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Employee Username" required>
                                    @error('username')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="birth">Date Of Birth</label>
                                        <input type="date" class="form-control" id="birth" name="birth" placeholder="">
                                    </div>

                                    @error('birth')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_card">Identity Id</label>
                                        <input type="number" class="form-control" id="id_card"  value="{{old('id_card')}}"  name="id_card" placeholder="Enter a NID" min="0" value="1">
                                    </div>

                                    @error('id_card')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="d_name">Departments  Name</label>
                                    <select onchange="clickTag(this.value)" class="form-control form-select" name="dep_name" id="dep_name">
                                        <option value="">Chose</option>
                                        @foreach($departments as $depData)
                                            <option value="{{$depData->id}}">{{$depData->dep_name}}</option>
                                        @endforeach
                                    </select>


                                    @error('dep_name')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="deg_name">Designation  Name</label>
                                    <select class="form-control form-select" name="deg_name" id="deg_name">
                                        <option value="">Chose</option>
                                        @foreach($designations as $degData)
                                            <option value="{{$degData->id}}">{{$degData->deg_name}}</option>
                                        @endforeach
                                    </select>


                                    @error('dep_name')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror


                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option selected>Choose</option>

                                            <option value="male" >Male</option>
                                            <option value="female" >Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    @error('gender')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="number" class="form-control" id="mobile" value="{{old('mobile')}}"  name="mobile" placeholder="Enter a Mobile" min="0">
                                    </div>

                                    @error('mobile')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emp_nid">NID</label>
                                        <input type="number" class="form-control" id="emp_nid"  value="{{old('emp_nid')}}"  name="emp_nid" placeholder="Enter a NID" min="0" value="1">
                                    </div>

                                    @error('emp_nid')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Nationality</label>
                                        <select name="nationality" id="nationality" class="form-control">
                                            <option selected>Choose</option>

                                            <option value="bangladesh" >Bangladesh</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    @error('nationality')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Religion</label>
                                        <select name="religion" id="religion" class="form-control">
                                            <option selected>Choose</option>
                                            <option value="islam" >Islam</option>
                                            <option value="hinduism" >Hinduism</option>
                                            <option value="other">Other</option>

                                        </select>
                                    </div>

                                    @error('religion')
                                    <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>

                            <div class="form-group">
                                <label for="file">Uplode PP Image</label>
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
