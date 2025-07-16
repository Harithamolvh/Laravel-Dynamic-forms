<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Form Builder -->
                    <div class="bg-white rounded-lg shadow-sm p-6" x-data="formBuilder()">
                        <form @submit.prevent="submitForm">
                            <!-- Form Basic Info -->
                            <div class="mb-8">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Form Information</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Form Name *</label>
                                        <input type="text"
                                            x-model="form.name"
                                            @input="generateSlug"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="Contact Form"
                                            required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                                        <input type="text"
                                            x-model="form.slug"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            placeholder="contact-form"
                                            required>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea x-model="form.description"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Brief description of this form"></textarea>
                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="mb-8">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold text-gray-900">Form Fields</h2>
                                    <button type="button"
                                        @click="addField"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Add Field
                                    </button>
                                </div>

                                <div class="space-y-4">
                                    <template x-for="(field, index) in form.fields" :key="field.id">
                                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                            <div class="flex justify-between items-center mb-3">
                                                <h3 class="font-medium text-gray-900">Field <span x-text="index + 1"></span></h3>
                                                <button type="button"
                                                    @click="removeField(index)"
                                                    class="text-red-600 hover:text-red-800">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Label *</label>
                                                    <input type="text"
                                                        x-model="field.label"
                                                        @input="generateFieldName(index)"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        placeholder="Full Name"
                                                        required>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Field Name *</label>
                                                    <input type="text"
                                                        x-model="field.name"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        placeholder="full_name"
                                                        required>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Field Type *</label>
                                                    <select x-model="field.type"
                                                        @change="updateFieldType(index)"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        required>
                                                        <option value="">Select Type</option>
                                                        <option value="text">Text Input</option>
                                                        <option value="email">Email</option>
                                                        <option value="number">Number</option>
                                                        <option value="password">Password</option>
                                                        <option value="textarea">Textarea</option>
                                                        <option value="select">Select Dropdown</option>
                                                        <option value="radio">Radio Buttons</option>
                                                        <option value="checkbox">Checkbox</option>
                                                        <option value="date">Date</option>
                                                        <option value="file">File Upload</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Options for select, radio, checkbox -->
                                            <div x-show="['select', 'radio', 'checkbox'].includes(field.type)" class="mt-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Options</label>
                                                <div class="space-y-2">
                                                    <template x-for="(option, optIndex) in field.options" :key="optIndex">
                                                        <div class="flex items-center space-x-2">
                                                            <input type="text"
                                                                x-model="option.value"
                                                                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                placeholder="Option value">
                                                            <input type="text"
                                                                x-model="option.label"
                                                                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                placeholder="Option label">
                                                            <button type="button"
                                                                @click="removeOption(index, optIndex)"
                                                                class="text-red-600 hover:text-red-800">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                    <button type="button"
                                                        @click="addOption(index)"
                                                        class="text-blue-600 hover:text-blue-800 text-sm">
                                                        + Add Option
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Validation Rules -->
                                            <div class="mt-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Validation Rules</label>
                                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                                    <label class="flex items-center space-x-2">
                                                        <input type="checkbox"
                                                            x-model="field.rules.required"
                                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                                        <span class="text-sm">Required</span>
                                                    </label>
                                                    <div x-show="field.type === 'text' || field.type === 'textarea'">
                                                        <input type="number"
                                                            x-model="field.rules.min_length"
                                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                                            placeholder="Min length">
                                                    </div>
                                                    <div x-show="field.type === 'text' || field.type === 'textarea'">
                                                        <input type="number"
                                                            x-model="field.rules.max_length"
                                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                                            placeholder="Max length">
                                                    </div>
                                                    <div x-show="field.type === 'number'">
                                                        <input type="number"
                                                            x-model="field.rules.min"
                                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                                            placeholder="Min value">
                                                    </div>
                                                    <div x-show="field.type === 'number'">
                                                        <input type="number"
                                                            x-model="field.rules.max"
                                                            class="w-full px-2 py-1 border border-gray-300 rounded text-sm"
                                                            placeholder="Max value">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Order -->
                                            <div class="mt-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                                                <input type="number"
                                                    x-model="field.order"
                                                    class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    min="0">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end space-x-4">
                                <button type="button"
                                    @click="previewForm"
                                    class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Preview
                                </button>
                                <button type="submit"
                                    class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Create Form
                                </button>
                            </div>
                        </form>

                        <!-- Preview Modal -->
                        <div x-show="showPreview"
                            x-cloak
                            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 max-h-96 overflow-y-auto">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">Form Preview</h3>
                                    <button @click="showPreview = false" class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="space-y-4">
                                    <h4 class="font-medium text-gray-900" x-text="form.name"></h4>
                                    <p class="text-gray-600" x-text="form.description"></p>
                                    <template x-for="field in form.fields.sort((a, b) => a.order - b.order)" :key="field.id">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1" x-text="field.label"></label>
                                            <div x-show="field.type === 'text' || field.type === 'email' || field.type === 'number' || field.type === 'password'">
                                                <input :type="field.type" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                                            </div>
                                            <div x-show="field.type === 'textarea'">
                                                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="3" disabled></textarea>
                                            </div>
                                            <div x-show="field.type === 'select'">
                                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                                                    <option>Select an option</option>
                                                    <template x-for="option in field.options" :key="option.value">
                                                        <option x-text="option.label"></option>
                                                    </template>
                                                </select>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
