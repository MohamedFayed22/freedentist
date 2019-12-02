@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}

                        </div>
                    @endif
 <a href="http://bsamat.com/demo/free_dentist/home/users">Admin Users</a><br/>
 <a href="http://bsamat.com/demo/free_dentist/home/offers">Offers</a><br/>
 <a href="http://bsamat.com/demo/free_dentist/home/services">Services</a><br/>
 <a href="http://bsamat.com/demo/free_dentist/home/hospitals">Hospitals</a><br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
