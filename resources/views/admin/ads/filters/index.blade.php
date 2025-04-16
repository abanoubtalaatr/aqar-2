                        {{-- Basic Search --}}
                        <div class="col-md-3 mb-3">
                            <input type="text" name="search" class="form-control" placeholder="@lang('Search in description, address')"
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="@lang('Search by phone')"
                                value="{{ request('phone') }}">
                        </div>

                        {{-- Date Filters --}}
                        <div class="col-md-3 mb-3">
                            <select name="published_at" class="form-control">
                                <option value="">@lang('Filter by publish date')</option>
                                <option value="3" {{ request('published_at') == '3' ? 'selected' : '' }}>
                                    @lang('Last 3 days')</option>
                                <option value="7" {{ request('published_at') == '7' ? 'selected' : '' }}>
                                    @lang('Last 7 days')</option>
                                <option value="30" {{ request('published_at') == '30' ? 'selected' : '' }}>
                                    @lang('Last 30 days')</option>
                                <option value="all" {{ request('published_at') == 'all' ? 'selected' : '' }}>
                                    @lang('All time')</option>
                            </select>
                        </div>


                        {{-- Price Range --}}
                        <div class="col-md-3 mb-3">
                            <input type="number" name="price_from" class="form-control" placeholder="@lang('Min Price')"
                                value="{{ request('price_from') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="number" name="price_to" class="form-control" placeholder="@lang('Max Price')"
                                value="{{ request('price_to') }}">
                        </div>

                        {{-- Area Range --}}
                        <div class="col-md-3 mb-3">
                            <input type="number" name="area_from" class="form-control" placeholder="@lang('Min Area')"
                                value="{{ request('area_from') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="number" name="area_to" class="form-control" placeholder="@lang('Max Area')"
                                value="{{ request('area_to') }}">
                        </div>
