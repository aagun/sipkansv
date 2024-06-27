@aware([
    'photo',
    'fullName',
    'position',
])

<!-- Toggle Dropdown -->
<button
    type="button"
    class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-600"
    id="user-menu-button"
    aria-expanded="false"
    data-dropdown-toggle="dropdown"
>
    <span class="sr-only">Open user menu</span>
    <img
        class="w-8 h-8 rounded-full"
        src="{{$photo}}"
        alt="{{$fullName}}_photo"
    />
</button>

<!-- Dropdown menu -->
<div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl" id="dropdown">
    <div class="py-3 px-4">
        <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{$fullName}}</span>
        <span class="block text-sm text-gray-900 truncate dark:text-white">{{$position}}</span>
    </div>
    <x-navbar.user.profile.menu.list>
        <x-navbar.user.profile.menu.item label="My Profile"/>
    </x-navbar.user.profile.menu.list>
    <x-navbar.user.profile.menu.list>
        <x-navbar.user.profile.menu.item label="Sign Out"/>
    </x-navbar.user.profile.menu.list>

</div>
