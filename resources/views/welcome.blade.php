<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
            <a
                href="{{ url('/dashboard') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Admin Dashboard
            </a>
            @else
            <a
                href="{{ route('login') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                Log in as Admin
            </a>

            @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Register as Admin
            </a>
            @endif
            @endauth
        </nav>
        @endif
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="text-center mb-12">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl p-8 text-white">
                <h2 class="text-4xl font-bold mb-4">Welcome!</h2>
                <p class="text-xl text-indigo-100">Choose from the forms below to get started</p>
            </div>
        </div>

        <!-- Forms List Section -->
        <div class="mb-6">
            <h3 class="text-2xl font-semibold text-gray-900 text-center mb-2">
                <i class="fas fa-list mr-2 text-indigo-600"></i>
                Select a Form
            </h3>
            <p class="text-gray-600 text-center mb-8">Click on any form below to fill it out</p>
        </div>

        @if($forms->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Sample Form 1 -->
            @foreach($forms as $form)
            <div class="group">
                <a href="#" class="block">
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200 overflow-hidden">
                        <!-- Form Header -->
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <h4 class="text-xl font-bold text-white">{{ $form->name }}</h4>
                                    </div>
                                </div>
                                <i class="fas fa-arrow-right text-white text-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                        </div>

                        <!-- Form Body -->
                        <div class="p-6">
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($form->description, 50) }}</p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    <span>Added {{ $form->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Footer -->
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                            <a href="{{ route('fill-form',['slug'=>$form->slug]) }}">
                                <div class="flex items-center justify-center">
                                    <span class="text-indigo-600 font-medium group-hover:text-indigo-700 transition-colors duration-200">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        Fill Out Form
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-file-alt text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Forms Found</h3>
            <p class="text-gray-500 mb-6">You haven't created any forms yet. Get started by creating your first form!</p>
            <a href="{{ route('forms.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md font-medium transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Create Your First Form
            </a>
        </div>
        @endif
    </main>
    @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>