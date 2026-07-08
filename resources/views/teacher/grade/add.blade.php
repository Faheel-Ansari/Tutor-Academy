@extends('layout.dashboard')
@section('dashboards')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Teacher</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{route('teacher.grade.index')}}" class="text-decoration-none">Grades</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Grade</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-lg-6">
                <div class="border border-3 p-4 rounded">
                    <div class="card">
                        <div class="card-body p-4">
                            <h5>Add Grade to Teach</h5>
                            <div class="row g-3">
                                <!-- Restaurant Name -->
                                <form method="POST" action="{{route('teacher.grade.store')}}">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="grade" class="form-label mb-2">Select Grade</label>
                                        <select name="grade" id="grade" class="form-control @error('grade') is-invalid @enderror" >
                                            <option disabled selected value="">~~ Please Select ~~</option>
                                            @foreach($grades as $grade)
                                            <option value="{{$grade->grade}}">{{$grade->grade}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('grade') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
