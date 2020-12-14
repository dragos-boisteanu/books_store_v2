<header id="header" class="header">
  
    @auth
        <form method="post" action="{{ route('logout')}}">
            @csrf

            <button type="submit">Logout</button>
        </form>
    @endauth
    
    <img src="{{ asset('storage/cover.svg') }}"/>
    <cart-component></cart-component>


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
