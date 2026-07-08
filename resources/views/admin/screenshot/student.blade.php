@extends('layout.dashboard')
@section('dashboards')
@php
use App\Models\User;
use App\Models\StdPricing;
@endphp
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
                            <li class="breadcrumb-item active" aria-current="page">Screenshots</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(count($screenshots) > 0)
                        <div class="table-responsive">
                            <table id="studentDetails" class="table mb-0">
                                <thead class="text-center">
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Plan</th>
                                    <th>Price</th>
                                    <th>screenshot</th>
                                    <th>Status</th>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($screenshots as $screenshot)
                                    @php
                                        $plan = StdPricing::find($screenshot->plan_id);
                                    @endphp
                                    <tr>
                                        <td><img src="{{ (!empty($screenshot->photo)) ? url('uploads/profileimages/'.$screenshot->photo) :  url('/noprofile/no-profile.jpg') }}" alt="Profile Image" id="" class="rounded-circle me-4 bg-primary" width="150"></td>
                                        <td style="vertical-align: middle">
                                            {{$screenshot->name}}
                                        </td>
                                        <td style="vertical-align: middle">
                                            {{$plan->name}}
                                        </td>
                                        <td style="vertical-align: middle">
                                            Rs.{{$plan->price}}
                                        </td>
                                        <td>
                                            <a class="cursor-pointer" data-bs-toggle="modal" data-bs-target="{{'#screenshot'.$screenshot->id}}">
                                                <img src="{{ (!empty($screenshot->screenshot)) ? url('payment/screenshot/'.$screenshot->screenshot) :  url('/noprofile/no-image.png') }}" alt="Profile Image" width="80">
                                            </a>
                                        </td>
                                        <td style="vertical-align: middle">
                                            @if($screenshot->status == '2')
                                            <a href="{{route('admin.payment.approve',$screenshot->id)}}" class="btn btn-success">Approve</a>
                                            @elseif($screenshot->status == '0')
                                            <button class="btn btn-danger" disabled>Rejected</button>
                                            @else
                                            <button class="btn btn-success" disabled>Approved</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-danger">No screenshots Found</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($screenshots as $screenshot)
<div class="modal fade" id="{{'screenshot'.$screenshot->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <img src="{{ (!empty($screenshot->screenshot)) ? url('payment/screenshot/'.$screenshot->screenshot) :  url('/noprofile/no-image.png') }}" width="380" alt="">
            </div>
        </div>
    </div>
</div>
@endforeach
<!--end page wrapper -->
@endsection
