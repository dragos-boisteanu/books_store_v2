@extends('layouts.app')

@section('content')

    <div class="view page-404">
        
        <div class="view__content">
            {{ Breadcrumbs::render() }}

            <div class="page-404__content">
                404 NOT FOUND
            </div>
            
        </div>
    </div>

@endsection