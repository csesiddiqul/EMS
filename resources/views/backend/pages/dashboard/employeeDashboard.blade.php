@php
    $usr = Auth::guard('admin')->user();


@endphp

@extends('backend.layouts.master')

@section('title')
    Dashboard Page - Employee Panel
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

    @if($emd)
        <div class="main-content-inner">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-area">
                                <div class="invoice-head">
                                    <div class="row">
                                        <div class="iv-left col-6">
                                            <span>PROFILE</span>
                                        </div>
                                        <div class="iv-right col-6 text-md-right">
                                            <span>#{{$emd->id}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="invoice-address">
                                            <h3 class="text-capitalize">{{$emd->name}}</h3>
                                            {{--                                            <h5 class="text-capitalize" >{{$dig->deg_name}}</h5>--}}
                                            <p> <i class="fa fa-envelope-o"></i> {{$emd->email}} &#160;<i class="fa fa-phone-square"></i> {{$emd->mobile}} &#160;<i class="fa fa-user"></i> {{$emd->nid}}</p>
                                            <p class="text-capitalize">{{$emd->nationality}}, &#160;{{$emd->gender}} &#160;,{{$emd->religion}}</p>
                                            {{--                                            <p class="text-capitalize">{{$dip->dep_name}}</p>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <ul class="invoice-date">
                                            <img src="{{$emd->img}}" alt="10/10" class="img-thumbnail w-25 mb-3">

                                            {{--                                            <li>Joining Date : {{$dip->created_at->format('Y-m-d')}}</li>--}}

                                        </ul>
                                    </div>
                                </div>

                                <div class="invoice-table table-responsive mt-5">
                                    <div class="invoice-address">
                                        <h3 class="text-capitalize">Project</h3>
                                    </div>

                                    <table class="table table-bordered table-hover text-right">

                                        <thead>
                                        <tr class="text-capitalize">
                                            <th class="text-center" style="width: 5%;">id</th>
                                            <th>Project Name</th>

                                            <th class="text-left" style="width: 45%; min-width: 130px;">description</th>
                                            <th style="min-width: 100px">Review</th>
                                            <th>More Data</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-left">Crazy Toys</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="text-left">Beautiful flowers</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-buttons text-right">
                                <a href="#" class="invoice-btn">print profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif






    <div class="row">
        <div class="col-lg-8">
            <div class="row">

                @if ($usr->roles[0]->name == 'superadmin')

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
                @endif
            </div>
        </div>
    </div>
    </div>




@endsection

