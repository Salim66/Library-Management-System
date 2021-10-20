@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('backend.nav-bar')

            <!-- start successfull message -->
            <div class="b_success_message mt-3">

            </div>
            <!-- end successfull message -->

            {{-- <table class="table" id="user_table_data">

            </table> --}}

            <table id="all_book_table_data" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Book Name</th>
                        <th>Action</th>
                    </tr>
                </thead>


            </table>

        </div>
    </div>
</div>
@include('backend.book.create')
@include('backend.book.edit')
@endsection
