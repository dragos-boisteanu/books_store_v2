<select name="{{ $name }}">
    <option value="0" disabled>{{ $title }}</option>
    @foreach($addresses as $address)
        <option value="{{ $address->id }}" {{ $id === $address->id ? 'selected' : ''}}>
            {{ $loop->iteration . ' - ' . $address->first_name . ' ' . $address->name . ' ' . $address->address  . ' ' . $address->county->name . ' ' . $address->city->name . ' ' . $address->phone_number }}                                
        </option>
    @endforeach
</select>
