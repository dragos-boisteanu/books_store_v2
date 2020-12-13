<header id="header" class="header">
  
    <img src="{{ asset('storage/cover.svg') }}"/>
    <cart-component></cart-component>
    @{{ message }}

</header>

@push('vue-scripts')
    <script>
        new Vue({
            el: '#header',
            created() {
                console.log('vue instance created from header');
            },          
            
            data() {
                return {
                    message: "header vue data",
                }
            }
        });
    </script>
@endpush
