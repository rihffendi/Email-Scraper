@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
       @include('sidebar')
      
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-dark text-white">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to rihSCrape !
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
