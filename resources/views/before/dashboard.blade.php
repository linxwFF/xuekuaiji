@extends('layouts.master')

@section('extendCss')
<link href={{asset("../build/css/custom.min.css")}} rel="stylesheet">
@endsection

@section('content')
    11111你的内容
@endsection

@section('extentJs')
<script src={{asset("../build/js/custom.min.js")}}></script>
@endsection
