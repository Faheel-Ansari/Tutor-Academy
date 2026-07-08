@extends('layout.dashboard')
@section('dashboards')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Admin</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pricing & Plans</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        @if($pricings->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th style="vertical-align: middle; text-align: start">Plan Name</th>
                                        <th style="vertical-align: middle; text-align: start">Price</th>
                                        <th style="vertical-align: middle; text-align: start">Number of Clicks</th>
                                    </tr>
                                    @foreach($pricings as $pricing)
                                    <tr>
                                        <td style="vertical-align: middle; text-align: start">{{$pricing->name}}</td>
                                        <td style="vertical-align: middle; text-align: start">{{$pricing->price}}</td>
                                        <td style="vertical-align: middle; text-align: start">{{$pricing->click}}</td>
                                        <td style="vertical-align: middle; text-align: end"><a href="{{ route('admin.pricing.edit',$pricing->id) }}" class="btn btn-primary text-center me-3"><i class="fa-solid fa-pen-to-square fs-5"></i></a><a href="{{ route('admin.pricing.destroy',$pricing->id) }}" class="btn btn-outline-danger text-center"><i class="fa-solid fa-trash fs-5"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-danger">Please add Pricing</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection
