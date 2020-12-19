@extends('layouts.app')

@section('content')
    <div id="view" class="view">

    </div>

@endsection

@push('vue-scrips')
<script>
    new Vue({
        el: '#view',
        created() {
            console.log('vue instance created from books page');
        },          
        
    });
</script>
@endpush