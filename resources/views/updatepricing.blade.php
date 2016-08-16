@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Pricing</div>
                    <div class="panel-body">

                        On this page, you can update the cost price per square meter of each building type as well as the blurb that is displayed on calculated reports.

                        @foreach ($nodes as $node)

                            <br><br>

                            {{ Form::open(array('url' => 'prices/update/' . $node->id)) }}

                            <div class="panel panel-primary">

                            <div class="panel-heading"> {{$node->subtypeString}} </div>

                            <div class="panel-body">

                            <label>Price / m<sup>2</sup> : </label>{{ Form::text('price_per_meter', $node->price_per_meter , array("class" => "form-control")) }}  <span></span><br>

                            <label>Blurb : </label>{{ Form::textarea('blurb', $node->blurb , array("class" => "form-control")) }}<br>

                            {{ Form::submit('Update Subtype!') }}

                            </div>

                            </div>

                            {{ Form::close() }}

                        @endforeach

                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection