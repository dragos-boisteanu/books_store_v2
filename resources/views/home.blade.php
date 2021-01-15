@extends('layouts.app')

@section('content')
<div id="view" class="view">
    <div class="view__content home">
        <div class="carrousel">
            test
        </div>
        
        <div class="newest">
            <x-books :books="$newBooks"></x-books>
        </div>
        {{-- <div class="most-sold">
            <x-books :books="$mostSoldBooks"></x-books>
        </div> --}}
        {{-- <div class="most-viewd">
            <x-books :books="$mostViewdbooks"></x-books>
        </div> --}}
       
    </div>
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
