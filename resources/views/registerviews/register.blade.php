@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
                <div class='card'>
                        <div class="card-header">
                                <h5>Register</h5>
                        </div>
                        <div class="card-body">
                                {!!Form::open(['action'=>'RegistrationController@create','method'=>'POST','class'=>'form-horizontal'])!!}
                                <div class="form-group">
                                {{Form::text('name','',['class'=>'form-control','placeholder'=>'Enter name'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::text('username','',['class'=>'form-control','placeholder'=>'Enter username'])}}
                                </div>
                                <div class="form-group">
                                        {{Form::text('email','',['class'=>'form-control','placeholder'=>'Enter email'])}}
                                    </div>
                                <div class="form-group">
                                    {{Form::password('password',['class'=>'form-control','placeholder'=>'Enter password'])}}
                                </div>
                                {{Form::submit('Register',['class'=>'btn btn-primary'])}}
                                {!!Form::close()!!}
                        </div>
                    </div>
        </div>
    </div>
        
</div>
</div>
@endsection