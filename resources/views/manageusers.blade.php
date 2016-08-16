@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="notifications" class="panels panel panel-default">
                    <div class="panel-heading">Manage Users</div>
                    <div class="panel-body" style="padding:0;">
                            <table class="table table-striped" style="padding-bottom: 0;margin-bottom: 0;">
                                <tr><td style=""><b>Name</b></td><td style=""><b>Phone #</b></td><td style=""><b>Email</b></td><td style=""><b>Status</b></td><td></td></tr>

                                @foreach ($users as $user)


                                        <tr><td style="">{{ $user->name }}</td><td style="">{{ $user->phone }}</td><td style="">{{ $user->email }}</td><td style="">{{ $user->state }}</td><td><span><a href="/users/manage/{{$user->id}}" class="btn btn-danger" role="button"><b>Manage</b></a></span></td></tr>


                                @endforeach


                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection