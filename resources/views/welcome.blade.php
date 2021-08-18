@extends('layouts.main')

@section('page_title')
README
@endsection

@section('content')
{!! (new \Parsedown())->text(file_get_contents(base_path() . '/readme.md')) !!}
@endsection

@section('page_style')
<style>
    th,
    td {
        border: 1px solid #999;
        padding: 0.7em;
    }

    th {
        background-color: #121889;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #cceeff;
    }
</style>
@endsection