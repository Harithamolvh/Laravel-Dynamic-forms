<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <form action="{{ route('forms.update', $form->id) }}" method="POST">
                            @csrf
                            @method('PUT') {{-- Use PUT method for updates --}}

                            <div class="mb-8">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Form Information</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="form_name" class="block text-sm font-medium text-gray-700 mb-2">Form Name *</label>
                                        <input type="text"
                                            name="name"
                                            id="form_name"
                                            value="{{ old('name', $form->name) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Contact Form"
                                            required>
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="form_slug" class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                                        <input type="text"
                                            name="slug"
                                            id="form_slug"
                                            value="{{ old('slug', $form->slug) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="contact-form"
                                            required>
                                        @error('slug')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label for="form_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea name="description"
                                        id="form_description"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Brief description of this form">{{ old('description', $form->description) }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-8">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold text-gray-900">Form Fields</h2>
                                    {{-- Add Field button in traditional Laravel would typically lead to adding a new field row via JavaScript or a separate page/modal --}}
                                    {{-- For a pure Blade form without JS, you'd pre-render a certain number of empty fields or handle this with dynamic JavaScript separately if needed. --}}
                                    {{-- Here, we'll just show the existing fields. --}}
                                    <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-md cursor-not-allowed opacity-50">
                                        Add Field (Requires JavaScript)
                                    </button>
                                </div>

                                <div class="space-y-4">
                                    @forelse($form->fields as $index => $field)
                                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                            <div class="flex justify-between items-center mb-3">
                                                <h3 class="font-medium text-gray-900">Field {{ $index + 1 }}</h3>
                                                {{-- Remove Field button also typically requires JavaScript to remove the element dynamically. --}}
                                                {{-- In a pure Blade form, you'd need to handle deletions via a separate form submission or a checkbox for "mark for deletion". --}}
                                                <button type="button" class="text-red-600 hover:text-red-800 cursor-not-allowed opacity-50">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div>
                                                    <label for="fields[{{ $index }}][label]" class="block text-sm font-medium text-gray-700 mb-1">Label *</label>
                                                    <input type="text"
                                                        name="fields[{{ $index }}][label]"
                                                        id="fields[{{ $index }}][label]"
                                                        value="{{ old('fields.' . $index . '.label', $field->label) }}"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        placeholder="Full Name"
                                                        required>
                                                    @error('fields.' . $index . '.label')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="fields[{{ $index }}][name]" class="block text-sm font-medium text-gray-700 mb-1">Field Name *</label>
                                                    <input type="text"
                                                        name="fields[{{ $index }}][name]"
                                                        id="fields[{{ $index }}][name]"
                                                        value="{{ old('fields.' . $index . '.name', $field->name) }}"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        placeholder="full_name"
                                                        required>
                                                    @error('fields.' . $index . '.name')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="fields[{{ $index }}][type]" class="block text-sm font-medium text-gray-700 mb-1">Field Type *</label>
                                                    <select name="fields[{{ $index }}][type]"
                                                        id="fields[{{ $index }}][type]"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        required>
                                                        <option value="">Select Type</option>
                                                        <option value="text" {{ old('fields.' . $index . '.type', $field->type) == 'text' ? 'selected' : '' }}>Text Input</option>
                                                        <option value="email" {{ old('fields.' . $index . '.type', $field->type) == 'email' ? 'selected' : '' }}>Email</option>
                                                        <option value="number" {{ old('fields.' . $index . '.type', $field->type) == 'number' ? 'selected' : '' }}>Number</option>
                                                        <option value="password" {{ old('fields.' . $index . '.type', $field->type) == 'password' ? 'selected' : '' }}>Password</option>
                                                        <option value="textarea" {{ old('fields.' . $index . '.type', $field->type) == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                                        <option value="select" {{ old('fields.' . $index . '.type', $field->type) == 'select' ? 'selected' : '' }}>Select Dropdown</option>
                                                        <option value="radio" {{ old('fields.' . $index . '.type', $field->type) == 'radio' ? 'selected' : '' }}>Radio Buttons</option>
                                                        <option value="checkbox" {{ old('fields.' . $index . '.type', $field->type) == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                                                        <option value="date" {{ old('fields.' . $index . '.type', $field->type) == 'date' ? 'selected' : '' }}>Date</option>
                                                        <option value="file" {{ old('fields.' . $index . '.type', $field->type) == 'file' ? 'selected' : '' }}>File Upload</option>
                                                    </select>
                                                    @error('fields.' . $index . '.type')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            @php
                                                $fieldOptions = json_decode($field->options, true);
                                                $fieldType = old('fields.' . $index . '.type', $field->type);
                                            @endphp
                                            @if(in_array($fieldType, ['select', 'radio', 'checkbox']))
                                                <div class="mt-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Options</label>
                                                    <div class="space-y-2">
                                                        @forelse($fieldOptions as $optIndex => $option)
                                                            <div class="flex items-center space-x-2">
                                                                <input type="text"
                                                                    name="fields[{{ $index }}][options][{{ $optIndex }}][value]"
                                                                    value="{{ old('fields.' . $index . '.options.' . $optIndex . '.value', $option['value']) }}"
                                                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                    placeholder="Option value">
                                                                <input type="text"
                                                                    name="fields[{{ $index }}][options][{{ $optIndex }}][label]"
                                                                    value="{{ old('fields.' . $index . '.options.' . $optIndex . '.label', $option['label']) }}"
                                                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                    placeholder="Option label">
                                                                <button type="button" class="text-red-600 hover:text-red-800 cursor-not-allowed opacity-50">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        @empty
                                                            {{-- If no options, you might want to display a blank one or a message --}}
                                                            <p class="text-gray-600 text-sm">No options defined. Add options with JavaScript.</p>
                                                        @endforelse
                                                        <button type="button" class="text-blue-600 hover:text-blue-800 text-sm cursor-not-allowed opacity-50">
                                                            + Add Option (Requires JavaScript)
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif

                                            @php
                                                $fieldRules = json_decode($field->rules, true);
                                            @endphp
                                            <div class="mt-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Validation Rules</label>
                                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                                    <label class="flex items-center space-x-2">
                                                        <input type="checkbox"
                                                            name="fields[{{ $index }}][rules][required]"
                                                            value="1"
                                                            {{ old('fields.' . $index . '.rules.required', $fieldRules['required'] ?? false) ? 'checked' : '' }}
                                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                                        <span class="text-sm">Required</span>
                                                    </label>
                                                    {{-- These inputs would also typically require JavaScript to show/hide based on field type --}}
                                                    {{-- For a pure Blade form, you'd show them all and rely on server-side validation to ignore irrelevant rules. --}}
                                                    <div>
                                                        <input type="number"
                                                            name="fields[{{ $index }}][rules][min_length]"
                                                            value="{{ old('fields.' . $index . '.rules.min_length', $fieldRules['min_length'] ?? '') }}"
                                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                                            placeholder="Min length">
                                                    </div>
                                                    <div>
                                                        <input type="number"
                                                            name="fields[{{ $index }}][rules][max_length]"
                                                            value="{{ old('fields.' . $index . '.rules.max_length', $fieldRules['max_length'] ?? '') }}"
                                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                                            placeholder="Max length">
                                                    </div>
                                                    <!-- <div>
                                                        <input type="number"
                                                            name="fields[{{ $index }}][rules][min]"
                                                            value="{{ old('fields.' . $index . '.rules.min', $fieldRules['min'] ?? '') }}"
                                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                                            placeholder="Min value">
                                                    </div>
                                                    <div>
                                                        <input type="number"
                                                            name="fields[{{ $index }}][rules][max]"
                                                            value="{{ old('fields.' . $index . '.rules.max', $fieldRules['max'] ?? '') }}"
                                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                                            placeholder="Max value">
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <label for="fields[{{ $index }}][order]" class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                                <input type="number"
                                                    name="fields[{{ $index }}][order]"
                                                    id="fields[{{ $index }}][order]"
                                                    value="{{ old('fields.' . $index . '.order', $field->order) }}"
                                                    class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    min="0">
                                                @error('fields.' . $index . '.order')
                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-600">No fields added yet. Add new fields.</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('forms.index') }}"
                                    class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Cancel
                                </a>
                                {{-- Preview button is purely a frontend feature and would require JavaScript. Removed for pure Blade. --}}
                                {{-- <button type="button" class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Preview
                                </button> --}}
                                <button type="submit"
                                    class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Update Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>