<div class="address__details">
    <div class="detail details__name">
        {{ $address->first_name . ' ' . $address->name }}
    </div>
    <div class="detail details__address">
        {{ $address->address }}
    </div>
    <div class="detail details__location">
        <span class="locaiton__county">{{ $address->county->name }}</span>

        <span>{{ $address->city->name}}</span>
    </div>
    <div class="detail details__phone-number">
        {{ $address->phone_number }}
    </div>
</div>