@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Notification</div>
                    <div class="panel-body">

                            {{ Form::open(array('url' => 'notification/create')) }}


                            <label>Subject : </label>{{ Form::text('subject', null, array("class" => "form-control")) }}

                            <label>Content : </label>{{ Form::textarea('text', null, array("class" => "form-control")) }}

                            <label>Schedule Post : </label>{{ Form::text('scheduledate', null, array("class" => "form-control", "id" => "datetimepicker")) }}

                        <br>

                            {{ Form::submit('Create Notification!') }}

                            {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
