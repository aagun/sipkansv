<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav"
    id="drawer-navigation"
>
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <x-sidebar.list.item label="Beranda">
                <svg
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 sidebar__item__icon-hover"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                </svg>
            </x-sidebar.list.item>
            <x-sidebar.list.item label="Pengguna">
                <svg
                    aria-hidden="true"
                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 sidebar__item__icon-hover"
                    fill="currentColor"
                    viewBox="0 0 22 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                          clip-rule="evenodd"/>
                </svg>
            </x-sidebar.list.item>
            <li>
                <x-sidebar.nested.toggle target="dropdown-master-data" active="{{request()->routeIs('dashboard.data.*')}}">
                    <svg
                        aria-hidden="true"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 sidebar__item__icon-hover"
                        fill="currentColor"
                        viewBox="0 2.1 20 22"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 7.205c4.418 0 8-1.165 8-2.602C20 3.165 16.418 2 12 2S4 3.165 4 4.603c0 1.437 3.582 2.602 8 2.602ZM12 22c4.963 0 8-1.686 8-2.603v-4.404c-.052.032-.112.06-.165.09a7.75 7.75 0 0 1-.745.387c-.193.088-.394.173-.6.253-.063.024-.124.05-.189.073a18.934 18.934 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.073a10.143 10.143 0 0 1-.852-.373 7.75 7.75 0 0 1-.493-.267c-.053-.03-.113-.058-.165-.09v4.404C4 20.315 7.037 22 12 22Zm7.09-13.928a9.91 9.91 0 0 1-.6.253c-.063.025-.124.05-.189.074a18.935 18.935 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.074a10.163 10.163 0 0 1-.852-.372 7.816 7.816 0 0 1-.493-.268c-.055-.03-.115-.058-.167-.09V12c0 .917 3.037 2.603 8 2.603s8-1.686 8-2.603V7.596c-.052.031-.112.059-.165.09a7.816 7.816 0 0 1-.745.386Z"/>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Data Master</span>
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6 sidebar__item__icon-hover"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </x-sidebar.nested.toggle>
                <x-sidebar.nested.list id="dropdown-master-data">
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.grade-level')}}"
                        active="{{request()->routeIs('dashboard.data.grade-level')}}">
                        Golongan
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.institution')}}"
                        active="{{request()->routeIs('dashboard.data.institution')}}">
                        Instansi
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.position')}}"
                        active="{{request()->routeIs('dashboard.data.position')}}">
                        Jabatan
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.investment-type')}}"
                        active="{{request()->routeIs('dashboard.data.investment-type')}}">
                        Jenis Penanaman Modal
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.observation')}}"
                        active="{{request()->routeIs('dashboard.data.observation')}}">
                        Jenis Pengawasan
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.kbli')}}"
                        active="{{request()->routeIs('dashboard.data.kbli')}}">
                        KBLI
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.activity')}}"
                        active="{{request()->routeIs('dashboard.data.activity')}}">
                        Kegiatan
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.rank')}}"
                        active="{{request()->routeIs('dashboard.data.rank')}}">
                        Pangkat
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.education')}}"
                        active="{{request()->routeIs('dashboard.data.education')}}">
                        Pendidikan
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.recommendation')}}"
                        active="{{request()->routeIs('dashboard.data.recommendation')}}">
                        Rekomendasi
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.business-scale')}}"
                        active="{{request()->routeIs('dashboard.data.business-scale')}}">
                        Skala Bisnis
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.business-entity-type')}}"
                        active="{{request()->routeIs('dashboard.data.business-entity-type')}}">
                        Status Badan Usaha
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.sub-sector')}}"
                        active="{{request()->Is('dashboard.data.sub-sector')}}">
                        Sub Sektor
                    </x-sidebar.nested.list.item>
                    <x-sidebar.nested.list.item
                        href="{{route('dashboard.data.department')}}"
                        active="{{request()->routeIs('dashboard.data.department')}}">
                        Unit Kerja
                    </x-sidebar.nested.list.item>
                </x-sidebar.nested.list>
            </li>
            <x-sidebar.list.item label="Laporan Kegiatan">
                <svg
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 sidebar__item__icon-hover"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke="white" stroke-linecap="round" stroke-width="1" d="M7.111 20A3.111 3.111 0 0 1 4 16.889v-12C4 4.398 4.398 4 4.889 4h4.444a.89.89 0 0 1 .89.889v12A3.111 3.111 0 0 1 7.11 20Zm0 0h12a.889.889 0 0 0 .889-.889v-4.444a.889.889 0 0 0-.889-.89h-4.389a.889.889 0 0 0-.62.253l-3.767 3.665a.933.933 0 0 0-.146.185c-.868 1.433-1.581 1.858-3.078 2.12Zm0-3.556h.009m7.933-10.927 3.143 3.143a.889.889 0 0 1 0 1.257l-7.974 7.974v-8.8l3.574-3.574a.889.889 0 0 1 1.257 0Z"/>
                </svg>
            </x-sidebar.list.item>
        </ul>
    </div>
</aside>
