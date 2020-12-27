@extends('layouts.app')

@section('content')
<div id="view" class="view">
    <div class="carrousel">
        test
    </div>

    <form method="GET" action="{{ route('search') }}">

        <input type="text" id="search" name="q" placeholder="Search"/>

        <button type="submit">Search</button>
            
    </form>

    <x-books :books="$books"></x-books>
</div>
@endsection

@push('vue-scripts')
    <script>
        new Vue({
            el: '#view',
            created() {
                console.log('vue instance created from home page');
            },          
            
        });
    </script>
@endpush
