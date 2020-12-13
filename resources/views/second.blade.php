@extends('layouts.app')

@section('content')
    <div id="view" class="container">
        @{{test}}
    </div>
    <demo-component></demo-component>
@endsection

@push('vue-scripts')
    <script>
        new Vue({
            el: '#view',
            created() {
                console.log('vue instance created from home page');
            },          
            data() {
                return {
                    test: 'test variable'
                }
            }
        });
    </script>
@endpush
