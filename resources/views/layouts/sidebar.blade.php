<nav id="sidebar" class="col-lg-2 p-3 d-lg-block bg-light sidebar collapse border">
    <ul class="list-unstyled ps-0">
        
        <x-sidebar.menu-item id="devices">
            <x-slot name="title">{{ __('Devices') }}</x-slot>
            <x-slot name="submenu">
                    <li><a href="#" class="link-dark rounded">{{ __('Brief info') }}</a></li>
                    <li><a href="#" class="link-dark rounded">{{ __('Movements') }}</a></li>
                    <li><a href="#" class="link-dark rounded">{{ __('Hardware') }}</a></li>
                    <li><a href="#" class="link-dark rounded">{{ __('Software') }}</a></li>
                    <li><a href="#" class="link-dark rounded">{{ __('Repairs') }}</a></li>
            </x-slot>
        </x-sidebar.menu-item>

    </ul>
</nav>