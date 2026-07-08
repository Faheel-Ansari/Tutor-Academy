@extends('frontend.body.master')
@section('content')
<div class="container d-flex flex-column gap-5 justify-content-start align-items-start mt-5 pt-5 px-4" style="height: 150vh">
    <h1 class="text-danger mt-5">Pay Now</h1>
    <div class="d-flex align-items-center justify-content-between w-50">
        <span><h2>{{$pricing->name}}</h2><p>( you can visit {{$pricing->click}} teacher's profiles )</p></span>
        <button class="btn btn-danger px-4 py-2" disabled><h3>Rs.{{$pricing->price}}</h3></button>
    </div>
    
    <div class="row d-flex justify-content-between w-100 mt-5">
        <div class="col-4 d-flex flex-column align-items-center">
            <div class="d-flex">
                <img src="{{asset('/payment/logo/Easypaisa-logo.png')}}" width="150" alt="">
            </div>
            <div class="d-flex">
                <img src="{{asset('/payment/logo/easypaisa-payment.jpeg')}}" width="400" alt="">
            </div>
        </div>
        <div class="col-4 d-flex border-start border-end flex-column align-items-center">
            <div class="d-flex">
                <img src="{{asset('/payment/logo/Jazzcash-logo.png')}}" width="150" alt="">
            </div>
            <div class="d-flex">
                <img src="{{asset('/payment/logo/jazzcash-payment.jpeg')}}" width="380" alt="">
            </div>
        </div>
        <div class="col-4 d-flex flex-column align-items-center">
            <div class="d-flex">
                <img src="{{asset('/payment/logo/bank-transfer-logo.png')}}" width="150" alt="">
            </div>
            <div class="d-flex">
                <p>Not Available</p>
            </div>
        </div>
    </div>
    <div class="row w-100">
        <form method="POST" action="{{route('package.payment.done')}}" enctype="multipart/form-data" class="form-control d-flex align-items-center justify-content-between mt-4">
            @csrf
            <input type="hidden" name="plan_id" value="{{$pricing->id}}">
            <div class="col-10 ms-4 d-flex flex-column justify-content-between">
                <p class="mb-3 text-danger">After making payment. Please upload screenshot for verification.</p>
                <input type="file" class="form-control @error('screenshot') is-invalid border border-danger @enderror" name="screenshot">
                @error('screenshot') <span class="text-danger">{{$message}}</span> @enderror
            </div>
            <div class="col-2">
                <button type="submit" class="el-btn">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
