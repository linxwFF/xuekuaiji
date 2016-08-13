@extends('layouts.master')

@section('extendCss')
<link href={{asset("../build/css/custom.min.css")}} rel="stylesheet">
@endsection

@section('content')

@endsection

@section('extentJs')
<script src={{asset("../build/js/custom.min.js")}}></script>
@endsection
