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
                        <li class="breadcrumb-item"><a href="{{route('teacher.area.index')}}" class="text-decoration-none">Area</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Area</li>
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
                            <div class="row g-3">
                                <!-- Restaurant Name -->
                                <form method="POST" action="{{route('teacher.area.update',$selectedarea->id)}}">
                                    @csrf
                                    <div class="col-md-12 mb-3">
                                        <label for="area" class="form-label mb-2">Select Area</label>
                                        <select name="area" id="area" class="form-control @error('area') is-invalid @enderror">
                                            <option disabled selected value="">~~ Please Select ~~</option>
                                            @foreach($areas as $area)
                                            <option value="{{$area->area}}" {{$area->area == $selectedarea->area ? 'selected' : ''}}>{{$area->area}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('area') }}</span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4">Save</button>
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
