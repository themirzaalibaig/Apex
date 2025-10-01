@extends('components.layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-zinc-100 dark:bg-zinc-900/30 rounded-lg flex items-center justify-center">
                        <flux:icon name="question-mark-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Create New FAQ</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Add a frequently asked question</p>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <form action="{{ route('faqs.store') }}" method="POST" class="p-6 space-y-8">
                @csrf
                @if (session()->has('error'))
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                        <span class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
                @endif

                <!-- FAQ Content Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">FAQ Content</h4>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="question" required class="text-zinc-700 dark:text-zinc-300 font-medium">Question</flux:label>
                        <flux:input
                            id="question"
                            type="text"
                            name="question"
                            required
                            value="{{ old('question') }}"
                            placeholder="Enter the question"
                            class="w-full"
                        />
                        @error('question')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <flux:label for="answer" required class="text-zinc-700 dark:text-zinc-300 font-medium">Answer</flux:label>
                        <flux:textarea
                            id="answer"
                            name="answer"
                            required
                            value="{{ old('answer') }}"
                            placeholder="Enter the answer..."
                            class="w-full"
                            rows="6"
                        ></flux:textarea>
                        @error('answer')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Configuration Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="cog-6-tooth" class="w-5 h-5 text-green-600 dark:text-green-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Status</h4>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="status" required class="text-zinc-700 dark:text-zinc-300 font-medium">FAQ Status</flux:label>
                        <x-toggle-switch :status="$status" name="status" />
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <div class="text-sm text-zinc-500 dark:text-zinc-400">
                        <span class="inline-flex items-center gap-1">
                            <flux:icon name="exclamation-triangle" class="w-4 h-4" />
                            Required fields are marked with *
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <flux:button
                            type="button"
                            variant="outline"
                            href="{{ route('faqs.index') }}"
                            wire:navigate
                            class="px-6"
                        >
                            <flux:icon name="x-mark" class="w-4 h-4 mr-2" />
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary" class="px-6 flex items-center flex-row gap-2">
                            <flux:icon name="check" class="w-4 h-4" />
                            Create FAQ
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

