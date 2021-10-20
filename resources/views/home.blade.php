@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('backend.nav-bar')

            <!-- start successfull message -->
            <div class="success_message mt-3">

            </div>
            <!-- end successfull message -->

        </div>
    </div>
</div>
@include('backend.admin.create')
@endsection

