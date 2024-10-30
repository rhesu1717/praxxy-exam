@extends('layouts.master')

@section('content')
    <app-component csrf-token="{{ csrf_token() }}" />
@endsection