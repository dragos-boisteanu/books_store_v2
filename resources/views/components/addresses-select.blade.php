<select name="{{ $name }}">
    <option value="0" disabled>{{ $title }}</option>
    @foreach($addresses as $address)
        <option value="{{ $address->id }}" 
            @if($id) 
                {{ $id === $address->id ? 'selected' : ''}} 
            @else 
                @if(strpos($name, 'shipping') > 0)   
                    {{ $address->default_for_shipping ? 'selected' : '' }} 
                @else
                    {{ $address->default_for_invoice ? 'selected' : '' }} 
                @endif
            @endif>
            {{ $loop->iteration . ' - ' . $address->first_name . ' ' . $address->name . ' ' . $address->address  . ' ' . $address->county->name . ' ' . $address->city->name . ' ' . $address->phone_number }}                                
        </option>
    @endforeach
</select>
