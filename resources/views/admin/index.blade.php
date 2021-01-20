@extends('layouts.app')

@section('content')

    <div class="view">
        @include('includes.dashboard-nav')
        <div class="view__content">
            {{ Breadcrumbs::render('dashboard') }}
            <h1>Wellcome to administration dashboard</h1>
            <div>
            
            </div>
        </div>
        
    </div>
@endsection

