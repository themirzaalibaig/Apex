@extends('components.layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <flux:button
                    variant="ghost"
                    icon="arrow-left"
                    href="{{ route('faqs.index') }}"
                    wire:navigate
                >
                    Back
                </flux:button>
                <div>
                    <flux:heading size="xl">FAQ Details</flux:heading>
                </div>
            </div>
            <div class="flex gap-2">
                <flux:button
                    variant="outline"
                    icon="pencil"
                    href="{{ route('faqs.edit', $faq->id) }}"
                >
                    Edit
                </flux:button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Question & Answer Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="question-mark-circle" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Question</h3>
                        </div>
                    </div>

                    <div class="p-6">
                        <p class="text-lg font-medium text-zinc-900 dark:text-white mb-6">
                            {{ $faq->question }}
                        </p>

                        <div class="mt-6 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                            <div class="flex items-center gap-2 mb-4">
                                <flux:icon name="chat-bubble-left-right" class="w-5 h-5 text-green-600 dark:text-green-400" />
                                <h4 class="text-md font-semibold text-zinc-900 dark:text-white">Answer</h4>
                            </div>
                            <p class="text-zinc-600 dark:text-zinc-400 whitespace-pre-line leading-relaxed">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="cog-6-tooth" class="w-5 h-5 text-green-600 dark:text-green-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Status</h3>
                        </div>
                    </div>

                    <div class="p-6">
                        @if($faq->status === 'active')
                            <div class="flex items-center gap-2 px-4 py-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                <flux:icon name="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400" />
                                <span class="text-green-800 dark:text-green-200 font-medium">Active</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 px-4 py-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <flux:icon name="x-circle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                                <span class="text-red-800 dark:text-red-200 font-medium">Inactive</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Metadata Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="calendar" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Metadata</h3>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Created On</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $faq->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Last Updated</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $faq->updated_at->format('M d, Y h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="bolt" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Quick Actions</h3>
                        </div>
                    </div>

                    <div class="p-6 space-y-3">
                        <flux:button
                            variant="outline"
                            icon="pencil"
                            href="{{ route('faqs.edit', $faq->id) }}"
                            class="w-full justify-center"
                        >
                            Edit FAQ
                        </flux:button>

                        <flux:button
                            variant="danger"
                            icon="trash"
                            onclick="confirmDelete({{ $faq->id }}, '{{ addslashes(Str::limit($faq->question, 50)) }}')"
                            class="w-full justify-center"
                        >
                            Delete FAQ
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <flux:heading size="lg">Confirm Delete</flux:heading>
                </div>

                <div class="flex items-start gap-3 mb-6">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                    </div>
                    <div class="flex-1">
                        <p class="text-zinc-900 dark:text-white mb-2">
                            Are you sure you want to delete the FAQ
                            <span class="font-semibold" id="faqQuestion"></span>?
                        </p>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            This action cannot be undone.
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button variant="ghost" onclick="closeDeleteModal()">
                        Cancel
                    </flux:button>
                    <flux:button variant="danger" onclick="deleteFaq()">
                        Delete FAQ
                    </flux:button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let faqToDelete = null;

        function confirmDelete(faqId, faqQuestion) {
            faqToDelete = faqId;
            document.getElementById('faqQuestion').textContent = `"${faqQuestion}"`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            faqToDelete = null;
        }

        function deleteFaq() {
            if (faqToDelete) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/faqs/${faqToDelete}`;

                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfMeta) {
                    console.error('CSRF token not found');
                    alert('Error: CSRF token not found. Please refresh the page.');
                    return;
                }

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfMeta.getAttribute('content');
                form.appendChild(csrfInput);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        }

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</div>
@endsection

