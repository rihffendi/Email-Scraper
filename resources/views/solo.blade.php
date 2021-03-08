@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('sidebar')
    
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-dark text-white">Seach For Single Site</div>

                <div class="card-body">
                   <form action="{{route('singleSite')}}" method ="post">
                       @csrf
                       <div class="form-group">
                            <label for="site" class="mb-2">Enter URL</label>
                            <input type="text" class="form-control" id="site" aria-describedby="site" name="site" placeholder="Enter site link">
                            <small id="site" class="form-text text-muted  mb-5">Correct format https://example.com</small>
                      </div>
                      <button type="submit" class="btn btn-primary mb-5">Submit</button>
                   </form>
                   @if(!empty($home))
                    <span style='padding:10px 20px; '><a href='{{$home}}' style='color:red'>{{$home}}</a>  does not exist</span>
                     
                   @endif
                </div>
                @if(!empty($mail)) 
                <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Email</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($mail as $key => $email)
                        <tr>
                            <td>{{$email}}</td>
                         
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
