
<nav x-data="{ open: false }" class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="justify-content-between flex-grow-1 pe-3">
          <div class="flex justify-end h-16">
              {{-- <div class="flex">
                  <!-- Logo -->
                  <div class="m-3 shrink-0 flex items-center">
                      <a href="{{ route('dashboard') }}">
                          <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                      </a>
                  </div>
              </div> --}}

              <!-- Settings Dropdown -->
              <div class="hidden sm:flex sm:items-center sm:ms-6">
                  <x-dropdown align="right" width="48">
                      <x-slot name="trigger">
                          <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-dark dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                              <div>{{ Auth::user()->name }}</div>

                              <div class="ms-1">
                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                  </svg>
                              </div>
                          </button>
                      </x-slot>

                      <x-slot name="content">
                          <x-dropdown-link :href="route('profile.edit')">
                              {{ __('Profile') }}
                          </x-dropdown-link>

                          <!-- Authentication -->
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf

                              <x-dropdown-link :href="route('logout')"
                                      onclick="event.preventDefault();
                                                  this.closest('form').submit();">
                                  {{ __('Log Out') }}
                              </x-dropdown-link>
                          </form>
                      </x-slot>
                  </x-dropdown>
              </div>

              <!-- Hamburger -->
              <div class="-me-2 flex items-center sm:hidden">
                  <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                      <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                          <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                          <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
              </div>
          </div>
      </div>
      <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          {{-- <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5> --}}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </li>
            @role('Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('roles') }}">Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users') }}">Users</a>
                </li>
            @endrole 

            @role('Admin|Staff|Resident')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notices.index') }}">Notices</a>
                </li>
            @endrole   

            @role('Admin|Staff')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('staff.index') }}">Staff</a>
                </li>
            @endrole

            @role('Admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="propertyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Property
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="propertyDropdown" data-bs-auto-close="outside">
                        <li><a class="dropdown-item " href="{{ route('building') }}">Building</a></li>
                        <li><a class="dropdown-item " href="{{ route('floor.index') }}">Floor</a></li>
                        <li><a class="dropdown-item " href="{{ route('units.index') }}">Unit</a></li>
                        <li><a class="dropdown-item " href="{{ route('residents.index') }}">Resident</a></li>
                    </ul>
                </li>
            @endrole

            @role('Admin|Resident')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="facilityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Facility
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="facilityDropdown" data-bs-auto-close="outside">
                        <li><a class="dropdown-item " href="{{ route('facilities.index') }}">Facilities</a></li>
                        <li><a class="dropdown-item " href="{{ route('bookings.bookings') }}">Bookings</a></li>
                    </ul>
                </li>
            @endrole

            @role('Admin|Resident')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="complaintsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Complaints
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="complaintsDropdown" data-bs-auto-close="outside">
                        @role('Admin')
                            <li>
                                <a class="dropdown-item " href="{{ route('complaints.index') }}">Complaints</a>
                            </li>
                        @endrole
                        @role('Admin')
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('complaints.user') }}">All Complaints</a>
                            </li>
                        @endrole
                    </ul>
                </li>
            @endrole

            @role('Admin|Resident')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="billsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Bills
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="billsDropdown" data-bs-auto-close="outside">
                        <li><a class="dropdown-item" href="{{ route('bills.index') }}">Maintenance</a></li>
                    </ul>
                </li>
            @endrole

            @role('Admin|Staff')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Reports
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reportsDropdown" data-bs-auto-close="outside">
                        <li><a class="dropdown-item" href="{{ route('reports.index') }}">Financial Reports</a>
                    </ul>
                </li>
            @endrole

            @role('Admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Settings
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="settingsDropdown" data-bs-auto-close="outside">
                        <li><a class="dropdown-item " href="{{ route('permissions.manage') }}">Role And Permission Settings</a></li>
                    </ul>
                </li>
            @endrole

          <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
              <div class="pt-2 pb-3 space-y-1">
                  <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                      {{ __('Dashboard') }}
                  </x-responsive-nav-link>
              </div>
      
              <!-- Responsive Settings Options -->
              <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                  <div class="px-4">
                      <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                      <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                  </div>
      
                  <div class="mt-3 space-y-1">
                      <x-responsive-nav-link :href="route('profile.edit')">
                          {{ __('Profile') }}
                      </x-responsive-nav-link>
      
                      <!-- Authentication -->
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
      
                          <x-responsive-nav-link :href="route('logout')"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Log Out') }}
                          </x-responsive-nav-link>
                      </form>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </nav>



  <!-- JavaScript to Prevent Dropdown from Closing -->
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.dropdown-menu').forEach(function (dropdown) {
        dropdown.addEventListener('click', function (e) {
            e.stopPropagation(); // Prevent Bootstrap from closing the dropdown
        });
    });
}); --}}
</script>

