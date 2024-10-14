<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Student Management System">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | ICT-Information</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @yield('styles')

        @php
            use App\Enums\Role;
            use App\Helpers\Auth;
        @endphp
    </head>

    <body>
        <header class="top-bar">
            {{-- Left --}}
            <button id="menuBarToggle" class="menu-toggler la la-bars"></button>
            <span class="brand">ICT-Information</span>

            {{-- Right --}}
            <div class="flex items-center ml-auto">
                <div id="profileTooltip" class="hidden">
                    <div class="w-64">
                        <div class="p-5">
                            <h5 class="capitalize">
                                {{ Auth::getFullNameTH() }}
                            </h5>
                            <p class="capitalize">
                                {{ Auth::getRoleTH() }}
                            </p>
                        </div>
                        <hr />

                        <div class="p-5">
                            @if (Auth::getRoleEN() !== Role::STUDENT)
                                <a href="{{ route('profile.index') }}" class="flex items-center text-gray-700 hover:text-primary">
                                    <span class="la la-user-circle text-2xl leading-none mr-2"></span>
                                    ดูโปรไฟล์
                                </a>
                            @endif

                            <a href="{{ route('profile.index') }}" class="flex items-center text-gray-700 hover:text-primary @if (Auth::getRoleEN() !== Role::STUDENT) mt-5 @endif">
                                <span class="la la-key text-2xl leading-none mr-2"></span>
                                เปลี่ยนรหัสผ่าน
                            </a>
                        </div>
                        <hr />

                        <div class="p-5">
                            <a href="{{ route('logout') }}" class="flex items-center text-gray-700 hover:text-primary" onclick="event.preventDefault(); $('#logoutForm').submit();">
                                <span class="la la-power-off text-2xl leading-none mr-2"></span>
                                ออกจากระบบ
                            </a>

                            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

                <button id="profileButton" class="ml-4">
                    <span class="avatar uppercase">
                        {{ Auth::getFirstCharacterNameTH() }}
                    </span>
                </button>
            </div>
        </header>

        <aside id="menuBar" class="menu-bar menu-sticky menu-wide">
            <div class="menu-items">
                <div class="menu-header">
                    <a href="{{ route('profile.index') }}" class="flex items-center mx-8 mt-8">
                        <span class="avatar w-16 h-16 text-2xl uppercase">
                            {{ Auth::getFirstCharacterNameTH() }}
                        </span>

                        <div class="ml-4 text-left">
                            <h5 class="capitalize">
                                {{ Auth::getFullNameTH() }}
                            </h5>
                            <p class="mt-2 capitalize">
                                {{ Auth::getRoleTH() }}
                            </p>
                        </div>
                    </a>
                    <hr class="mx-8 my-4" />
                </div>

                @if (Auth::getRoleEN() === Role::TEACHER)
                    {{-- Teacher --}}
                    <a href="{{ route('dashboard.index') }}" class="link">
                        <span class="icon la la-chalkboard"></span>
                        <span class="title">แดชบอร์ด</span>
                    </a>

                    <a href="{{ route('student_management.index') }}" class="link">
                        <span class="icon la la-user"></span>
                        <span class="title">จัดการข้อมูลนักศึกษา</span>
                    </a>
                @elseif (Auth::getRoleEN() === Role::STUDENT)
                    {{-- Student --}}
                    <a href="{{ route('student_information.index') }}" class="link">
                        <span class="icon la la-user"></span>
                        <span class="title">ข้อมูลนักศึกษา</span>
                    </a>

                    <a href="{{ route('personal_information.index') }}" class="link">
                        <span class="icon la la-address-card"></span>
                        <span class="title">ประวัติส่วนตัว</span>
                    </a>

                    <a href="{{ route('family_information.index') }}" class="link">
                        <span class="icon la la-user-friends"></span>
                        <span class="title">ประวัติครอบครัว</span>
                    </a>

                    <a href="{{ route('education_information.index') }}" class="link">
                        <span class="icon la la-university"></span>
                        <span class="title">ประวัติการศึกษา</span>
                    </a>
                @else
                    {{-- Admin --}}
                    <a href="{{ route('dashboard.index') }}" class="link">
                        <span class="icon la la-chalkboard"></span>
                        <span class="title">แดชบอร์ด</span>
                    </a>

                    <a href="{{ route('student_management.index') }}" class="link">
                        <span class="icon la la-user"></span>
                        <span class="title">จัดการข้อมูลนักศึกษา</span>
                    </a>

                    <a href="{{ route('teacher_management.index') }}" class="link">
                        <span class="icon la la-user-tie"></span>
                        <span class="title">จัดการข้อมูลผู้สอน</span>
                    </a>
                @endif
            </div>
        </aside>

        <main class="workspace">
            @yield('content')
        </main>

        <script type="module">
            $(document).ready(function() {
                // Toggle MenuBar.
                $('#menuBarToggle').click(function(e) {
                    e.preventDefault();

                    $('#menuBar').toggleClass('menu-hidden');
                });

                // Initialize Toggle MenuBar.
                if ($(window).width() > 640) {
                    $('#menuBar').removeClass('menu-hidden');
                } else {
                    $('#menuBar').addClass('menu-hidden');
                }

                // Initialize Tippy.js Tooltip.
                tippy('#profileButton', {
                    content: $('#profileTooltip').html(),
                    trigger: 'click',
                    theme: 'light-border',
                    offset: [0, 8],
                    arrow: true,
                    placement: 'bottom-start',
                    interactive: true,
                    allowHTML: true,
                    animation: 'shift-toward-extreme',
                    appendTo: document.body
                });

                // Active Menu.
                (function() {
                    let path = "{{ url()->current() }}";
                    path = path.split("/").slice(0, 4).join("/");

                    $(`#menuBar a[href="${path}"]`).addClass('active');
                })();
            });
        </script>

        @yield('scripts')
    </body>
</html>
