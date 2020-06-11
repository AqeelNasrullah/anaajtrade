<div class="p-3" style="border-radius: 5px;background-color: lightgray;position: sticky; top: 15px;">
    <div class="mx-auto mb-2" style="width: 150px;height: 150px;border-radius: 100%;overflow: hidden;"><img src="{{ asset('images/dps/'.$profile->avatar) }}" alt="Image not found" width="100%"></div>
    <div>
        <h4 class="text-center fw-900 mb-1">{{ $profile->name ?? 'Unknown User' }}</h4>
        <h6 class="text-center mb-1"><i class="fas fa-phone"></i> {{ $profile->phone_number }}</h6>
        <h6 class="text-center mb-1"><i class="fas fa-address-card"></i> {{ $profile->cnic }}</h6>
        <h6 class="text-center"><i class="fas fa-map-marker-alt"></i> {{ $profile->address }}</h6>
    </div>
</div>
