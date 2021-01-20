<select name="{{ $name }}" class="form-input">
    <option value="0" disabled>{{ $title }}</option>
    @foreach($methods as $method)
        <option value="{{ $method->id }}" {{ $id === $method->id ? 'selected' : ''}}>
            {{$method->name }}
        </option>
    @endforeach
</select>