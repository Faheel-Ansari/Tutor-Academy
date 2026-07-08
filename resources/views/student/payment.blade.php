@extends('layout.dashboard')
@section('dashboards')
<div class="container d-flex flex-column gap-5 justify-content-start align-items-start mt-5 pt-5 px-4" style="height: 150vh">
    <h1 class="text-danger mt-5">Pay Now</h1>
    <div class="d-lg-flex gap-4 align-items-center justify-content-between w-lg-50">
        <span class="d-flex align-items-center gap-2"><h2>{{$teacher->fullname}}</h2><p class="m-0">(Teacher)</p></span>
        <button class="btn btn-danger px-4 py-2 text-center" disabled><h3>Rs.{{$teacherFee->fee}}</h3></button>
    </div>
    
    <div class="row d-flex gap-lg-0 gap-5 justify-content-between w-100 mt-5">
        <div class="col-md-4 d-flex flex-column align-items-center">
            <div class="d-flex">
                <img src="{{asset('/payment/logo/Easypaisa-logo.png')}}" width="150" alt="">
            </div>
            <div class="d-flex">
                <img src="{{asset('/payment/logo/easypaisa-payment.jpeg')}}" width="400" alt="">
            </div>
        </div>
        <div class="col-md-4 d-flex border-start border-end flex-column align-items-center">
            <div class="d-flex">
                <img src="{{asset('/payment/logo/Jazzcash-logo.png')}}" width="150" alt="">
            </div>
            <div class="d-flex">
                <img src="{{asset('/payment/logo/jazzcash-payment.jpeg')}}" width="380" alt="">
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column align-items-center">
            <div class="d-flex">
                <img src="{{asset('/payment/logo/bank-transfer-logo.png')}}" width="150" alt="">
            </div>
            <div class="d-flex">
                <p>Not Available</p>
            </div>
        </div>
    </div>
    <div class="row w-100 mb-5">
        <form method="POST" action="{{route('student.teacher.payment.done')}}" enctype="multipart/form-data" class="form-control d-lg-flex gap-3 align-items-center py-4 justify-content-between mt-4 mb-5">
            @csrf
            <input type="hidden" name="booking_id" value="{{$pageid->id}}">
            <div class="col-10 ms-4 d-flex flex-column justify-content-between">
                <p class="mb-3 text-danger">After making payment. Please upload screenshot for verification.</p>
                <input type="file" class="form-control @error('screenshot') is-invalid border border-danger @enderror" name="screenshot">
                @error('screenshot') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="col-12 col-md-2 mt-3">
                <button type="submit" class="col-10 btn btn-primary py-3 px-4">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
