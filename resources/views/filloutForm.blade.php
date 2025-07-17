<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $form->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-lg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-6">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-700 mr-4">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $form->name }}</h1>
                        @if($form->description)
                            <p class="text-gray-600 mt-1">{{ $form->description }}</p>
                        @endif
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if($form->estimated_time)
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $form->estimated_time }} min
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 rounded-t-xl">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-alt text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold text-white">Fill Out Form</h2>
                        <p class="text-indigo-100">Please complete all required fields</p>
                    </div>
                </div>
            </div>

            <!-- Form Body -->
            <div class="p-8">
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <h3 class="text-red-800 font-medium">Please fix the following errors:</h3>
                        </div>
                        <ul class="text-red-700 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <p class="text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('forms.submit',['id'=> $form->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                  
                    @foreach($form->fields->sortBy('order') as $field)
                    @php
                        \Illuminate\Support\Facades\Log::info($form);
                    @endphp
                        <div class="form-group">
                            <label for="{{ $field->name }}" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $field->label }}
                                @if(!empty($field->rules['required']))
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>

                            @switch($field->type)
                                @case('text')
                                    <input type="text" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           value="{{ old($field->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror"
                                           @if($field->options && is_array($field->options) && isset($field->options['placeholder']))
                                               placeholder="{{ $field->options['placeholder'] }}"
                                           @endif>
                                    @break

                                @case('email')
                                    <input type="email" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           value="{{ old($field->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror"
                                           @if($field->options && is_array($field->options) && isset($field->options['placeholder']))
                                               placeholder="{{ $field->options['placeholder'] }}"
                                           @endif>
                                    @break

                                @case('number')
                                    <input type="number" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           value="{{ old($field->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror"
                                           @if($field->options && is_array($field->options))
                                               @if(isset($field->options['min'])) min="{{ $field->options['min'] }}" @endif
                                               @if(isset($field->options['max'])) max="{{ $field->options['max'] }}" @endif
                                               @if(isset($field->options['step'])) step="{{ $field->options['step'] }}" @endif
                                               @if(isset($field->options['placeholder'])) placeholder="{{ $field->options['placeholder'] }}" @endif
                                           @endif>
                                    @break

                                @case('textarea')
                                    <textarea id="{{ $field->name }}" 
                                              name="{{ $field->name }}" 
                                              rows="{{ ($field->options && is_array($field->options) && isset($field->options['rows'])) ? $field->options['rows'] : 4 }}"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror"
                                              @if($field->options && is_array($field->options) && isset($field->options['placeholder']))
                                                  placeholder="{{ $field->options['placeholder'] }}"
                                              @endif>{{ old($field->name) }}</textarea>
                                    @break

                                @case('select')
                                <select id="{{ $field->name }}"
                                        name="{{ $field->name }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror">
                                    <option value="">Select an option</option>
                                    @php
                                        $decodedOptions = json_decode($field->options, true);
                                    @endphp

                                    @if($decodedOptions && is_array($decodedOptions))
                                        @foreach($decodedOptions as $option)
                                            <option value="{{ $option['value'] }}" {{ old($field->name) == $option['value'] ? 'selected' : '' }}>
                                                {{ $option['label'] }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @break

                                @case('radio')
                                <div>
                                    <div class="mt-1 space-y-2">
                                        @php
                                           $decodedOptions = json_decode($field->options, true);
                                        @endphp
                                        @if($decodedOptions && is_array($decodedOptions)) 
                                            @foreach($decodedOptions as $option)
                                                <label class="flex items-center">
                                                    <input type="radio"
                                                        name="{{ $field->name }}"
                                                        value="{{ $option['value'] }}" 
                                                        {{ old($field->name) == $option['value'] ? 'checked' : '' }}
                                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                                    <span class="ml-2 text-sm text-gray-700">{{ $option['label'] }}</span> 
                                                </label>
                                            @endforeach
                                        @else
                                            <p class="text-red-500 text-xs">Error: Radio options are not correctly defined or are missing.</p>
                                        @endif
                                    </div>
                                    @error($field->name)
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                @break

                                @case('checkbox')
                                    <div class="space-y-2">
                                        @php
                                           $decodedOptions = json_decode($field->options, true);
                                        @endphp
                                        @if($decodedOptions && is_array($decodedOptions))
                                            @foreach($decodedOptions as $option)
                                                <label class="flex items-center">
                                                    <input type="checkbox" 
                                                           name="{{ $field->name }}[]" 
                                                           value="{{ $option['value'] }}" 
                                                           {{ in_array($option, old($field->name, [])) ? 'checked' : '' }}
                                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                    <span class="ml-2 text-sm text-gray-700">{{ $option['label'] }}</span>
                                                </label>
                                            @endforeach
                                        @endif
                                    </div>
                                    @break

                                @case('file')
                                    <input type="file" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror"
                                           @if($field->options && is_array($field->options))
                                               @if(isset($field->options['accept'])) accept="{{ $field->options['accept'] }}" @endif
                                               @if(isset($field->options['multiple']) && $field->options['multiple']) multiple @endif
                                           @endif>
                                    @if($field->options && is_array($field->options) && isset($field->options['help']))
                                        <p class="text-xs text-gray-500 mt-1">{{ $field->options['help'] }}</p>
                                    @endif
                                    @break

                                @case('date')
                                    <input type="date" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           value="{{ old($field->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror"
                                           @if($field->options && is_array($field->options))
                                               @if(isset($field->options['min'])) min="{{ $field->options['min'] }}" @endif
                                               @if(isset($field->options['max'])) max="{{ $field->options['max'] }}" @endif
                                           @endif>
                                    @break

                                @case('time')
                                    <input type="time" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           value="{{ old($field->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror">
                                    @break

                                @case('url')
                                    <input type="url" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           value="{{ old($field->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror"
                                           @if($field->options && is_array($field->options) && isset($field->options['placeholder']))
                                               placeholder="{{ $field->options['placeholder'] }}"
                                           @endif>
                                    @break

                                @case('tel')
                                    <input type="tel" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           value="{{ old($field->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror"
                                           @if($field->options && is_array($field->options) && isset($field->options['placeholder']))
                                               placeholder="{{ $field->options['placeholder'] }}"
                                           @endif>
                                    @break

                                @default
                                    <input type="text" 
                                           id="{{ $field->name }}" 
                                           name="{{ $field->name }}" 
                                           value="{{ old($field->name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error($field->name) border-red-500 @enderror">
                            @endswitch

                            @error($field->name)
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            @if($field->options && is_array($field->options) && isset($field->options['help']))
                                <p class="text-gray-500 text-sm mt-1">{{ $field->options['help'] }}</p>
                            @endif
                        </div>
                    @endforeach

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-700 font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Forms
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Submit Form
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Info -->
        <div class="mt-6 bg-white rounded-lg shadow-md p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Form Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div class="flex items-center">
                    <i class="fas fa-file-alt text-indigo-600 mr-2"></i>
                    <span class="text-gray-600">Total Fields: <strong>{{ $form->fields->count() }}</strong></span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>
                    <span class="text-gray-600">Created: <strong>{{ $form->created_at->format('M d, Y') }}</strong></span>
                </div>
                @if($form->estimated_time)
                    <div class="flex items-center">
                        <i class="fas fa-clock text-indigo-600 mr-2"></i>
                        <span class="text-gray-600">Est. Time: <strong>{{ $form->estimated_time }} minutes</strong></span>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center">
                <p class="text-gray-500 text-sm">Having trouble with this form? <a href="#" class="text-indigo-600 hover:text-indigo-700">Contact Support</a></p>
            </div>
        </div>
    </footer>
</body>
</html>