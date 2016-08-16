@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Notification</div>
                    <div class="panel-body">

                            {{ Form::open(array('url' => 'notification/update/' . $notification->id)) }}


                            <label>Subject : </label>{{ Form::text('subject', $notification->title, array("class" => "form-control")) }}

                            <label>Content : </label>{{ Form::textarea('text', $notification->content, array("class" => "form-control")) }}

                            <label>Schedule Post : </label>{{ Form::text('scheduledate',  $notification->scheduledate, array("class" => "form-control", "id" => "datetimepicker")) }}

                        <br>

                            {{ Form::submit('Update Notification!') }}

                            {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
