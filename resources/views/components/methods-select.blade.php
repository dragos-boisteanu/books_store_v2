<select name="{{ $name }}">
    <option value="0">{{ $title }}/option>
    @foreach($methods as $method)
        <option value="{{ $method->id }}" {{ $id === $method->id ? 'selected' : ''}}>
            {{$method->name }}
        </option>
    @endforeach
</select>