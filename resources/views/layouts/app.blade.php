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
                            <h5 class="capitalize">{{ auth()->user()->first_name_th }} {{ auth()->user()->last_name_th }}</h5>
                            <p class="capitalize">
                                @if (auth()->user()->role->value === Role::TEACHER)
                                    อาจารย์
                                @elseif (auth()->user()->role->value === Role::STUDENT)
                                    นักศึกษา
                                @else
                                    ผู้ดูแลระบบ
                                @endif
                            </p>
                        </div>
                        <hr />

                        <div class="p-5">
                            <a href="{{ route('profile') }}" class="flex items-center text-gray-700 hover:text-primary">
                                <span class="la la-user-circle text-2xl leading-none mr-2"></span>
                                ดูโปรไฟล์
                            </a>

                            <a href="{{ route('profile') }}" class="flex items-center text-gray-700 hover:text-primary mt-5">
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
                        {{-- {{ substr(auth()->user()->first_name_en, 0, 1) }} --}}
                        {{ mb_substr(auth()->user()->first_name_th, 0, 1, 'UTF-8') }}
                    </span>
                </button>
            </div>
        </header>

        <aside id="menuBar" class="menu-bar menu-sticky menu-wide">
            <div class="menu-items">
                <div class="menu-header">
                    <a href="{{ route('profile') }}" class="flex items-center mx-8 mt-8">
                        <span class="avatar w-16 h-16 text-2xl uppercase">
                            {{-- {{ substr(auth()->user()->first_name_th, 0, 1) }} --}}
                        </span>

                        <div class="ml-4 text-left">
                            <h5 class="capitalize">{{ auth()->user()->first_name_en }} {{ auth()->user()->last_name_en }}</h5>
                            <p class="mt-2 capitalize">{{ strtolower(auth()->user()->role->value) }}</p>
                        </div>
                    </a>
                    <hr class="mx-8 my-4" />
                </div>

                @if (auth()->user()->role->value === Role::TEACHER)
                    {{-- Teacher --}}
                    <a href="{{ route('dashboard') }}" class="link">
                        <span class="icon la la-chalkboard"></span>
                        <span class="title">Dashboard</span>
                    </a>

                    <a href="{{ route('student_management') }}" class="link">
                        <span class="icon la la-user"></span>
                        <span class="title">Student Management</span>
                    </a>
                @elseif (auth()->user()->role->value === Role::STUDENT)
                    {{-- Student --}}
                    <a href="{{ route('student_information') }}" class="link">
                        <span class="icon la la-user"></span>
                        <span class="title">Student Information</span>
                    </a>

                    <a href="{{ route('personal_information') }}" class="link">
                        <span class="icon la la-address-card"></span>
                        <span class="title">Personal Information</span>
                    </a>

                    <a href="{{ route('family_information') }}" class="link">
                        <span class="icon la la-user-friends"></span>
                        <span class="title">Family Information</span>
                    </a>

                    <a href="{{ route('education_information') }}" class="link">
                        <span class="icon la la-university"></span>
                        <span class="title">Education Information</span>
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
                    const path = "{{ url()->current() }}";
                    
                    $(`#menuBar a[href="${path}"]`).addClass('active');
                })();
            });
        </script>

        @yield('scripts')
    </body>
</html>
