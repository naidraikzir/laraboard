@extends('layouts.app')

@section('content')
<div class="bg-dark-blue ovy-auto">
    <div class="container">
        <div class="row justify-content-center h-100vh">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <div class="text-white mt-5 pt-5">
                    @yield('page')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
