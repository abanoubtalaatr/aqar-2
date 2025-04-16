 <nav class="mt-2">
     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


         <li class="nav-item">
             <a href="{{ route('admin.dashboard') }}" class="nav-link {{ activeTab('admin.dashboard.*') }}">
                 <i class="nav-icon fas fa-cogs"></i>
                 <p>
                     @lang('dashboard.Dashboard')
                 </p>
             </a>
         </li>

         @if (auth()->user()->can('admin-read') || auth()->user()->can('user-read') || auth()->user()->can('role-read'))
             <li
                 class="nav-item has-treeview
                 {{ openTab('admin.admins.*') }} {{ openTab('admin.roles.*') }}
                        {{ openTab('admin.users.*') }} ">
                 <a href="#"
                     class="nav-link {{ activeTab('admin.admins.*') }} {{ activeTab('admin.users.*') }}
                                {{ activeTab('admin.roles.*') }}">
                     <i class="nav-icon fas fa-users"></i>
                     <p>
                         @lang('dashboard.Users Management')
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>

                 <ul class="nav nav-treeview">
                     @can('role-read')
                         <li class="nav-item">
                             <a href="{{ route('admin.roles.index') }}" class="nav-link {{ activeTab('admin.roles.*') }}">
                                 <i class="far fa-user nav-icon"></i>
                                 <p>@lang('dashboard.Roles and Permissions')</p>
                             </a>
                         </li>
                     @endcan

                     @can('admin-read')
                         <li class="nav-item">
                             <a href="{{ route('admin.admins.index') }}"
                                 class="nav-link {{ activeTab('admin.admins.*') }}">
                                 <i class="far fa-user nav-icon"></i>
                                 <p>@lang('dashboard.Admins')</p>
                             </a>
                         </li>
             @endif

             @can('user-read')
                 <li class="nav-item">
                     <a href="{{ route('admin.users.index') }}" class="nav-link {{ activeTab('admin.users.*') }}">
                         <i class="far fa-user nav-icon"></i>
                         <p>@lang('dashboard.users')</p>
                     </a>
                 </li>
             @endcan
         </ul>
         </li>
         @endif


         @can('ad-read')
             <li
                 class="nav-item has-treeview {{ openTab('admin.ads-sell.*') }} {{ openTab('admin.ads-rent.*') }} {{ openTab('admin.ads-month-or-day.*') }}">
                 <a href="#"
                     class="nav-link {{ activeTab('admin.ads-sell.*') }} {{ activeTab('admin.ads-rent.*') }} {{ activeTab('admin.ads-month-or-day.*') }}">
                     <i class="nav-icon fas fa-bullhorn"></i>

                     <p>
                         @lang('dashboard.Ads')
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">

                     <li class="nav-item">
                         <a href="{{ route('admin.ads-sell.index') }}" class="nav-link {{ activeTab('admin.ads-sell.*') }}">
                             <i class="fas fa-tags"></i> <!-- Sale tag icon for selling -->

                             <p>@lang('dashboard.ads for sell')</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.ads-rent.index') }}" class="nav-link {{ activeTab('admin.ads-rent.*') }}">
                             <i class="fas fa-key"></i> <!-- Key icon for rent -->
                             <p>@lang('dashboard.ads for rent')</p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ route('admin.ads-month-or-day.index') }}"
                             class="nav-link {{ activeTab('admin.ads-month-or-day.*') }}">
                             <i class="fas fa-calendar-alt"></i> <!-- Calendar icon for time-based rentals -->
                             <p>@lang('dashboard.ads for rent for month or day')</p>
                         </a>
                     </li>


                 </ul>
             </li>
         @endcan



         @if (auth()->user()->can('order-read'))
             <li
                 class="nav-item has-treeview {{ openTab('admin.orders-sell.*') }} {{ openTab('admin.orders-rent.*') }} ">
                 <a href="#"
                     class="nav-link {{ activeTab('admin.orders-sell.*') }} {{ activeTab('admin.orders-rent.*') }} ">
                     <i class="nav-icon fas fa-shopping-cart"></i>
                     <p>
                         @lang('dashboard.Orders')
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">

                     <li class="nav-item">
                         <a href="{{ route('admin.orders-sell.index') }}"
                             class="nav-link {{ activeTab('admin.orders-sell.*') }}">
                             <i class="far fa-circle nav-icon"></i>
                             <p>@lang('dashboard.orders for sell')</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.orders-rent.index') }}"
                             class="nav-link {{ activeTab('admin.orders-rent.*') }}">
                             <i class="far fa-circle nav-icon"></i>
                             <p>@lang('dashboard.orders for rent')</p>
                         </a>
                     </li>
                 </ul>
             </li>
         @endif


         @if (auth()->user()->can('faq-type-read') || auth()->user()->can('faq-read'))
             <li class="nav-item has-treeview {{ openTab('admin.faq-types.*') }} {{ openTab('admin.faqs.*') }} ">
                 <a href="#" class="nav-link {{ activeTab('admin.faq-types.*') }} {{ activeTab('admin.faqs.*') }}">
                     <i class="nav-icon fas fa-question-circle"></i>
                     <p>
                         @lang('dashboard.FAQs')
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">

                     <li class="nav-item">
                         <a href="{{ route('admin.faq-types.index') }}"
                             class="nav-link {{ activeTab('admin.faq-types.*') }}">
                             <i class="fas fa-tags"></i>

                             <p>@lang('dashboard.FAQs type')</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ activeTab('admin.faqs.*') }}">
                             <i class="fas fa-key"></i>
                             <p>@lang('dashboard.FAQs')</p>
                         </a>
                     </li>

                 </ul>
             </li>
         @endif



         @if (auth()->user()->can('service-type-read') || auth()->user()->can('contact-service-read'))
             <li
                 class="nav-item has-treeview {{ openTab('admin.service-types.*') }} {{ openTab('admin.contact-services.*') }}">
                 <a href="#"
                     class="nav-link {{ activeTab('admin.service-types.*') }} {{ activeTab('admin.contact-services.*') }}">
                     <i class="nav-icon fas fa-headset"></i> <!-- Updated icon -->
                     <p>
                         @lang('dashboard.contact services')
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('admin.service-types.index') }}"
                             class="nav-link {{ activeTab('admin.service-types.*') }}">
                             <i class="fas fa-layer-group"></i> <!-- Updated icon -->
                             <p class="text">@lang('dashboard.service types')</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.contact-services.index') }}"
                             class="nav-link {{ activeTab('admin.contact-services.*') }}">
                             <i class="fas fa-user-headset"></i> <!-- Updated icon -->
                             <p class="text">@lang('dashboard.contact services')</p>
                         </a>
                     </li>
                 </ul>
             </li>
         @endif
         @if (auth()->user()->can('contact-read') || auth()->user()->can('contact-type-read'))
             <li class="nav-item has-treeview {{ openTab('admin.contacts.*') }} {{ openTab('admin.contact-types.*') }}">
                 <a href="#"
                     class="nav-link {{ activeTab('admin.contacts.*') }} {{ activeTab('admin.contact-types.*') }}">
                     <i class="nav-icon fas fa-headset"></i> <!-- Updated icon -->
                     <p>
                         <i class="right fas fa-angle-left"></i>
                         @lang('dashboard.contacts')

                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('admin.contacts.index') }}"
                             class="nav-link {{ activeTab('admin.contacts.*') }}">
                             <i class="fas fa-layer-group"></i> <!-- Updated icon -->
                             <p class="text">@lang('dashboard.contacts')</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.contact-types.index') }}"
                             class="nav-link {{ activeTab('admin.contact-types.*') }}">
                             <i class="fas fa-address-book"></i> <!-- Best for contact types -->
                             <p class="text">@lang('dashboard.contact types')</p>
                         </a>
                     </li>
                 </ul>
             </li>
         @endif
         @can('page-read')
             <li
                 class="nav-item has-treeview {{ openTab('admin.page.*') }} {{ openTab('admin.faq_categories.*') }} {{ openTab('admin.faq.*') }}">
                 <a href="#"
                     class="nav-link {{ activeTab('admin.page.*') }} {{ activeTab('admin.faq_categories.*') }} {{ activeTab('admin.faq.*') }}">
                     <i class="nav-icon fas fa-file"></i>
                     <p>
                         @lang('dashboard.pages')
                         <i class="right fas fa-angle-left"></i>
                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                     @foreach (pages() as $page)
                         <li class="nav-item">
                             <a href="{{ route('admin.page.index', $page->key) }}"
                                 class="nav-link {{ activeTab('admin.page.' . $page->key) }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>{{ $page['title_' . myLang()] }}</p>
                             </a>
                         </li>
                     @endforeach

                 </ul>
             </li>
         @endcan

         @if (auth()->user()->can('article-read'))
             <li class="nav-item has-treeview {{ openTab('admin.articles.*') }} {{ openTab('admin.cities-articles.*') }}">
                 <a href="#"
                     class="nav-link {{ activeTab('admin.articles.*') }} {{ activeTab('admin.cities-articles.*') }}">
                     <i class="nav-icon fas fa-newspaper"></i> <!-- Updated icon -->
                     <p>
                         <i class="right fas fa-angle-left"></i>
                         @lang('dashboard.articles')

                     </p>
                 </a>
                 <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.articles.index') }}" class="nav-link {{ activeTab('admin.articles.*') }}">
                            <i class="nav-icon fas fa-newspaper"></i>

                            <p class="text">@lang('dashboard.articles')</p>
                        </a>
                    </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.cities-articles.index') }}"
                             class="nav-link {{ activeTab('admin.cities-articles.*') }}">
                             <i class=" nav-icon nav-icon fas fa-city"></i> <!-- Best for contact types -->
                             <p class="text">@lang('dashboard.articles cities')</p>
                         </a>
                     </li>
                 </ul>
             </li>
         @endif

         @can('random-message-read')
             <li class="nav-item">
                 <a href="{{ route('admin.random-messages.index') }}"
                     class="nav-link {{ activeTab('admin.random-messages.index') }}">
                     <i class="nav-icon fas fa-comments"></i>

                     <p class="text">@lang('dashboard.random-messages')</p>
                 </a>
             </li>
         @endcan
         @can('notification-read')
             <li class="nav-item">
                 <a href="{{ route('admin.notifications.index') }}"
                     class="nav-link {{ activeTab('admin.notifications.index') }}">
                     <i class="nav-icon fas fa-bell"></i>

                     <p class="text">@lang('dashboard.notifications')</p>
                 </a>
             </li>
         @endcan
         @can('city-read')
             <li class="nav-item">
                 <a href="{{ route('admin.cities.index') }}" class="nav-link {{ activeTab('admin.cities.index') }}">
                     <i class="nav-icon fas fa-city"></i>

                     <p class="text">@lang('dashboard.cities')</p>
                 </a>
             </li>

         @endcan

         @can('license-read')
             <li class="nav-item">
                 <a href="{{ route('admin.licenses.index') }}" class="nav-link {{ activeTab('admin.licenses.index') }}">
                     <i class="nav-icon fas fa-id-card"></i>

                     <p class="text">@lang('dashboard.licenses')</p>
                 </a>
             </li>
         @endcan

         @can('category-read')
             <li class="nav-item">
                 <a href="{{ route('admin.categories.index') }}" class="nav-link {{ activeTab('admin.categories.index') }}">
                     <i class="nav-icon fas fa-folder"></i>


                     <p class="text">@lang('dashboard.categories')</p>
                 </a>
             </li>
         @endcan


         @can('setting-read')
             <li class="nav-item">
                 <a href="{{ route('admin.settings.index') }}" class="nav-link {{ activeTab('admin.settings.index') }}">
                     <i class="nav-icon fas fa-cog"></i>


                     <p class="text">@lang('dashboard.settings')</p>
                 </a>
             </li>
         @endcan


         @can('statistic-read')
             <li class="nav-item">
                 <a href="{{ route('admin.statistics.index') }}" class="nav-link {{ activeTab('admin.statistics.index') }}">
                    <i class="nav-icon fas fa-chart-bar"></i>  <!-- Bar Chart -->


                     <p class="text">@lang('dashboard.statistics')</p>
                 </a>
             </li>
         @endcan


         @can('service-provider-read')
             <li class="nav-item">
                 <a href="{{ route('admin.service-providers.index') }}" class="nav-link {{ activeTab('admin.service-providers.index') }}">
                    <i class="nav-icon fas fa-globe"></i>  <!-- Bar Chart -->


                     <p class="text">@lang('dashboard.service-providers')</p>
                 </a>
             </li>
         @endcan

         @can('report-ad-read')
             <li class="nav-item">
                 <a href="{{ route('admin.report-ads.index') }}" class="nav-link {{ activeTab('admin.report-ads.*') }}">
                    <i class="nav-icon fas fa-flag"></i>  <!-- Bar Chart -->
                     <p class="text">@lang('dashboard.reports ads')</p>
                 </a>
             </li>
         @endcan

         @can('report-order-read')
             <li class="nav-item">
                 <a href="{{ route('admin.report-orders.index') }}" class="nav-link {{ activeTab('admin.report-orders.*') }}">
                    <i class="nav-icon fas fa-exclamation-triangle "></i>  <!-- Bar Chart -->
                     <p class="text">@lang('dashboard.reports orders')</p>
                 </a>
             </li>
         @endcan


         @can('partner-read')
             <li class="nav-item">
                 <a href="{{ route('admin.partners.index') }}" class="nav-link {{ activeTab('admin.partners.*') }}">
                    <i class="nav-icon  fas fa-handshake "></i>  <!-- Bar Chart -->
                     <p class="text">@lang('dashboard.partners')</p>
                 </a>
             </li>
         @endcan


         <li class="nav-item">
            <a href="{{ route('chatify') }}"
                class="nav-link {{ activeTab('chatify') }}">
                <i class="nav-icon fas fa-comments"></i>

                <p class="text">@lang('dashboard.chat')</p>
            </a>
        </li>
         {{-- <li class="nav-item">
            <a href="{{ route('chatify') }}" class="nav-link">
               <i class="nav-icon fas fa-comments"></i>
                <p class="text">@lang('dashboard.chat')</p>
            </a>
        </li> --}}

         </ul>
