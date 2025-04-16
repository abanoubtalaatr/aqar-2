<div class="col-md-2 mb-3">
    <select name="car_entrance" class="form-control">
        <option value="">@lang('Car Entrance')</option>
        <option value="1" {{ request('car_entrance') == '1' ? 'selected' : '' }}>@lang('Yes')</option>
        <option value="0" {{ request('car_entrance') == '0' ? 'selected' : '' }}>@lang('No')</option>
    </select>
</div>

<div class="col-md-2 mb-3">
    <select name="elevator" class="form-control">
        <option value="">@lang('Elevator')</option>
        <option value="1" {{ request('elevator') == '1' ? 'selected' : '' }}>@lang('Yes')</option>
        <option value="0" {{ request('elevator') == '0' ? 'selected' : '' }}>@lang('No')</option>
    </select>
</div>

<div class="col-md-2 mb-3">
    <select name="swimming_pool" class="form-control">
        <option value="">@lang('Swimming Pool')</option>
        <option value="1" {{ request('swimming_pool') == '1' ? 'selected' : '' }}>@lang('Yes')</option>
        <option value="0" {{ request('swimming_pool') == '0' ? 'selected' : '' }}>@lang('No')</option>
    </select>
</div>

<div class="col-md-2 mb-3">
    <select name="driver_room" class="form-control">
        <option value="">@lang('Driver Room')</option>
        <option value="1" {{ request('driver_room') == '1' ? 'selected' : '' }}>@lang('Yes')</option>
        <option value="0" {{ request('driver_room') == '0' ? 'selected' : '' }}>@lang('No')</option>
    </select>
</div>

<div class="col-md-2 mb-3">
    <select name="maid_room" class="form-control">
        <option value="">@lang('Maid Room')</option>
        <option value="1" {{ request('maid_room') == '1' ? 'selected' : '' }}>@lang('Yes')</option>
        <option value="0" {{ request('maid_room') == '0' ? 'selected' : '' }}>@lang('No')</option>
    </select>
</div>
