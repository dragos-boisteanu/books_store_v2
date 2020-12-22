<div>
    <div>
        {{ $address->first_name . ' ' . $address->name }}
    </div>
    <div>
        {{ $address->address }}
    </div>
    <div>
        <span>{{ $address->county->name }}</span>, <span>{{ $address->city->name}}</span>
    </div>
    <div>
        {{ $address->phone_number }}
    </div>
</div>