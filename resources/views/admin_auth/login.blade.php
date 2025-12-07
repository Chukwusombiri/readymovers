<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/images/favicon-16x16.png')}}">
    <title>{{ config('app.name') }} | Sign-in your account</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('myassets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('myassets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('myassets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
    <!-- Main Styling -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500 dark:bg-gray-900 dark:text-white">
    <div class="container sticky top-0 z-sticky">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 flex-0">
                <!-- Navbar -->
                <nav class="absolute top-0 left-0 right-0 z-30 flex flex-wrap items-center px-4 py-2 m-6 mb-0 shadow-sm rounded-xl bg-white/80 backdrop-blur-2xl backdrop-saturate-200 lg:flex-nowrap lg:justify-start dark:bg-gray-700 dark:shadow-none dark:text-gray-100">
                    <div class="flex items-center justify-between w-full p-0 mx-auto flex-wrap-inherit">
                        <a class="text-sm mr-4 whitespace-nowrap font-bold text-slate-700 lg:ml-0" href="{{ route('guest_home') }}">
                            <x-application-logo class="ml-0 h-16 w-auto"/>
                        </a>
                        <button navbar-trigger class="px-3 py-1 ml-2 leading-none transition-all ease-in-out bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-lg lg:hidden dark:text-white" type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6 h-6 bg-none">
                                <span bar1 class="w-5.5 rounded-xs relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                                <span bar2 class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                                <span bar3 class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                            </span>
                        </button>
                        <div navbar-menu class="items-center flex-grow transition-all duration-500 lg-max:overflow-hidden ease lg-max:max-h-0 basis-full lg:flex lg:basis-auto">
                            <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
                                <li>
                                    <a class="flex items-center px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2 dark:text-gray-100" aria-current="page" href="{{route('guest_home')}}">
                                        <i class="mr-1 fa fa-home opacity-60"></i>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a class="flex items-center px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2 dark:text-gray-100" aria-current="page" href="{{route('admin_home')}}">
                                        <i class="mr-1 fa fa-chart-pie opacity-60"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2 dark:text-gray-100" href="{{route('admin_profile')}}">
                                        <i class="mr-1 fa fa-user opacity-60"></i>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2 dark:text-gray-100" href="{{route('contact')}}">
                                        <i class="mr-1 fas fa-user-circle opacity-60"></i>
                                        Contact
                                    </a>
                                </li>                                
                            </ul>
                            <ul class="pl-0 mb-4 lg:mb-0 list-none lg:block lg:flex-row">
                                <li class="flex">
                                    <a href="{{config('app.socials.whatsapp')}}" target="_blank" class="inline-flex w-full lg:w-auto px-8 py-2 mb-0 mr-1 font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-emerald-500 border-0 rounded-lg shadow-md cursor-pointer hover:-translate-y-px hover:shadow-xs active:opacity-85 text-xs tracking-tight-rem bg-orange-500/95 hover:bg-orange-500/95 border-orange-500/95 dark:text-white dark:hover:text-white dark:hover:border-white dark:active:border-white">
                                        <svg class="w-4 h-4 mr-2 text-white"  fill="#ffffff" stroke="#ffffff" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>WhatsApp</title><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                        whatsapp    
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <main class="mt-16 lg:mt-10 transition-all duration-200 ease-in-out">
        <section>
            <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover dark:bg-gray-900">
                <div class="container z-1">
                    <div class="flex flex-wrap -mx-3">
                        <div class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                            <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 rounded-2xl bg-clip-border dark:bg-transparent">
                                <div class="p-6 pb-0 mb-0">
                                    <h4 class="font-bold dark:text-gray-100">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                @if (session('status'))
                                    <div class="p-6 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <x-validation-errors class="p-4" />
                                <div class="flex-auto p-6">
                                    <form role="form" method="POST" action="{{ route('admin.login.store') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                                        </div>
                                        <div class="mb-4">
                                            <input type="password" name="password" placeholder="Password" class="focus:shadow-primary-outline dark:bg-gray-950 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                                        </div>
                                        <div class="flex items-center pl-12 mb-2 text-left min-h-6">
                                            <input id="rememberMe" name="remember" class="mt-2 rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left -ml-12 w-10 cursor-pointer appearance-none border border-solid border-gray-200 rounded-full bg-zinc-700/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
                                            <label class="ml-2 font-normal cursor-pointer select-none text-sm text-slate-700 dark:text-gray-300" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Sign in</button>
                                        </div>
                                    </form>
                                    <div class="flex items-center justify-center mt-4">
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.forgot') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex">
                            <div class="relative flex flex-col justify-center h-full bg-cover px-24 m-4 overflow-hidden rounded-xl" style="background-image: url('/images/landing/trucks.jpg')">
                                <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-blue-500 to-violet-500 opacity-60"></span>
                                <h4 class="z-20 mt-12 font-bold text-white">"Where Every Step is a Milestone"</h4>
                                <p class="z-20 text-white font-semibold">As you log in today, remember that you are an integral part of our journey towards success. Your dedication, hard work, and commitment drive us forward every day.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="py-12 dark:bg-gray-900">
        <div class="container">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
                    <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">Company</a>
                    <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">Services</a>
                    <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Contact</a>
                    <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">Track</a>
                </div>
                <div class="flex-shrink-0 w-full max-w-full mx-auto mt-2 mb-6 text-center lg:flex-0 lg:w-8/12">
                    <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                        <span class="text-lg fab fa-twitter"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                        <span class="text-lg fab fa-facebook"></span>
                    </a>
                    <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                        <span class="text-lg fab fa-linkedin"></span>
                    </a>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
                    <p class="mb-0 text-slate-400">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        {{config('app.name')}}
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
<!-- plugin for scrollbar  -->
<script src="{{ asset('myassets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<!-- main script file  -->
<script src="{{ asset('myassets/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>

</html>
