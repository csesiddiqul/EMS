@php
    $usr = Auth::guard('admin')->user();
@endphp

@extends('backend.layouts.master')

@section('title')
Dashboard Page - Admin Panel
@endsection

@section('styles')

@endsection


@section('admin-content')




<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.html">Home</a></li>
                    <li><span>Dashboard</span></li>
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
    <div class="col-lg-8">
        <div class="row">


            @if($employee_data)


            <div class="col-md-12 mb-3 mb-lg-0">

                <img class="rounded-circle mb-3 mt-3" src="{{ $employee_data->img}}"style="height: 130px; width: 130px" alt="">

                <div class="card">
                    <div class="seo-fact sbg3">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">Data</div>
                            <p>{{ $employee_data->name}}</p>
                            <p>{{ $employee_data->email}}</p>
                            <p>{{ $employee_data->mobile}}</p>
                            <p>{{ $department->dep_name}}</p>

                        </div>
                    </div>
                </div>
            </div>
            @endif


                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg1">
                            <a href="{{ route('admin.roles.index') }}">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="fa fa-users"></i> Roles</div>
                                    <h2>{{ $total_roles }}</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-md-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg2">
                            <a href="{{ route('admin.admins.index') }}">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="fa fa-user"></i> Admins</div>
                                    <h2>{{ $total_admins }}</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3 mb-lg-0">
                    <div class="card">
                        <div class="seo-fact sbg3">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon">Permissions</div>
                                <h2>{{ $total_permissions }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </div>
</div>




@endsection

