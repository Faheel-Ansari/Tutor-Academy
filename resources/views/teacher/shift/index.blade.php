@extends('layout.dashboard')
@section('dashboards')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-body">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Teacher</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Timings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Timings</h4>
                        @if($shifts != null && $shifts->count() > 0 )
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    @foreach($shifts as $shift)
                                    <tr>
                                        <td style="vertical-align: middle; text-align: start">{{$shift->shift_name}}</td>
                                        <td style="vertical-align: middle; text-align: end">
                                            <a href="{{ route('teacher.shift.edit',$shift->id) }}" class="btn btn-outline-primary text-center me-2">
                                                <i class="fa-solid fa-pen-to-square fs-5"></i>
                                            </a>
                                            @if($shift->status == '0')
                                            <a href="{{ route('teacher.shift.status',$shift->id) }}" class="btn btn-outline-danger text-center">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                            @else
                                            <a href="{{ route('teacher.shift.status',$shift->id) }}" class="btn btn-outline-success text-center">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            @endif
                                            <a href="{{ route('teacher.shift.destroy',$shift->id) }}" class="btn btn-outline-danger text-center ms-2">
                                                <i class="fa-solid fa-trash fs-5"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-warning">Please Add Timings</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection
