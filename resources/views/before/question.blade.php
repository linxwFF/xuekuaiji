@extends('layouts.master')

@section('extendCss')
<link href={{asset("../build/css/custom.css")}} rel="stylesheet">
<style>

.black{
    color: #000000;
}


</style>
@endsection

@section('content')
<div class="row">

    <p>
        
    </p>

</div>
@endsection

@section('extentJs')
<script src={{asset("../build/js/custom.js")}}></script>
@endsection
