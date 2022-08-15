@section('title', 'Dashboard')

@extends('layouts.master')



@section('content')

<div class="row">
    <div class="col-12 col-sm-12 col-xxl d-flex">
        <div class="card illustration flex-fill">
            <div class="card-body p-0 d-flex flex-fill">
                <div class="row no-gutters w-100">
                    <div class="col-6">
                        <div class="illustration-text p-3 m-1">
                            <h4 class="illustration-text">Welcome Back, {{ Auth::user()->name }}!</h4>
                            <p class="mb-0">HSE |  {{ auth()->user()->userRole() }}</p>
                        </div>
                    </div>
                    <div class="col-6 align-self-end text-right">
                        <img src="/assets/img/customer-support.png" alt="Customer Support" class="img-fluid illustration-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="custom-message" class="mr-2 btn btn-primary">Custom</button>
</div>

@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="alert-message">
        <strong>{{ session('error') }}</strong>
    </div>
</div>
@endif
<div class="row">


    @if (auth()->user()->role === 'user' || auth()->user()->role === 'site_member')
        @livewire('project.dashboard')
    @else
        @livewire('charts.incident-type')
        @livewire('charts.incident-type-wps')
    @endif

</div>

@endsection
