<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $form->name }}</h3>

                    <div class="mb-4">
                        <strong>ID:</strong> {{ $form->id }}
                    </div>
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $form->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Slug:</strong> {{ $form->slug }}
                    </div>
                    <div class="mb-4">
                        <strong>Description:</strong> {{ $form->description }}
                    </div>
                    <div class="mb-4">
                        <strong>Created At:</strong> {{ $form->created_at->format('M d, Y H:i A') }}
                    </div>
                    <div class="mb-4">
                        <strong>Updated At:</strong> {{ $form->updated_at->format('M d, Y H:i A') }}
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('forms.edit', $form) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            Edit
                        </a>
                        <form action="{{ route('forms.destroy', $form) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this form?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </form>
                        <a href="{{ route('forms.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 ml-auto">
                            Back to Forms
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>