@extends('components.layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Media Library</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Manage your images, documents, and uploads.</p>
            </div>
            <flux:button variant="primary" icon="plus" href="{{ route('media.create') }}">
                Upload Media
            </flux:button>
        </div>

        {{-- Toolbar --}}
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between bg-white dark:bg-zinc-900 p-2 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm mb-8">
            <div class="flex items-center gap-1 bg-zinc-100 dark:bg-zinc-800 p-1 rounded-lg">
                <a href="{{ route('media.index', ['status' => 'active', 'search' => $search ?? '']) }}"
                   class="px-4 py-1.5 rounded-md text-sm font-medium transition-all {{ $status !== 'deleted' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                    Active
                </a>
                <a href="{{ route('media.index', ['status' => 'deleted', 'search' => $search ?? '']) }}"
                   class="px-4 py-1.5 rounded-md text-sm font-medium transition-all {{ $status === 'deleted' ? 'bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                    Deleted
                </a>
            </div>

            <form method="GET" class="w-full sm:w-72 relative">
                <input type="hidden" name="status" value="{{ $status }}">
                <flux:input 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    icon="magnifying-glass" 
                    placeholder="Search files..." 
                    class="w-full"
                />
            </form>
        </div>

        {{-- Grid --}}
        @if($uploads->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-center bg-zinc-50 dark:bg-zinc-900/50 rounded-xl border-2 border-dashed border-zinc-200 dark:border-zinc-800">
                <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-4">
                    <flux:icon name="photo" class="w-8 h-8 text-zinc-400" />
                </div>
                <h3 class="text-lg font-medium text-zinc-900 dark:text-white">No media found</h3>
                <p class="text-zinc-500 dark:text-zinc-400 mt-1 max-w-sm">
                    Upload some files to get started with your media library.
                </p>
                <div class="mt-6">
                    <flux:button variant="primary" size="sm" href="{{ route('media.create') }}">
                        Upload First File
                    </flux:button>
                </div>
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($uploads as $upload)
                    <div class="group relative bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col">
                        
                        {{-- Image / Preview --}}
                        <div class="relative aspect-[4/3] bg-zinc-100 dark:bg-zinc-950 overflow-hidden">
                            @if(preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $upload->url))
                                <img 
                                    src="{{ $upload->url }}" 
                                    alt="{{ $upload->seo_alt_text ?? $upload->file_name }}" 
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-400">
                                    <flux:icon name="document-text" class="w-12 h-12" />
                                </div>
                            @endif

                            {{-- Overlay Actions --}}
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 backdrop-blur-[2px]">
                                <a href="{{ $upload->url }}" target="_blank" class="p-2 bg-white/90 hover:bg-white text-zinc-900 rounded-full shadow-lg transition-transform hover:scale-110" title="View">
                                    <flux:icon name="eye" class="w-4 h-4" />
                                </a>
                                <a href="{{ route('media.edit', $upload->id) }}" class="p-2 bg-white/90 hover:bg-white text-blue-600 rounded-full shadow-lg transition-transform hover:scale-110" title="Edit">
                                    <flux:icon name="pencil-square" class="w-4 h-4" />
                                </a>
                                @if(!$upload->is_deleted)
                                    <button type="button"
                                        class="p-2 bg-white/90 hover:bg-white text-red-600 rounded-full shadow-lg transition-transform hover:scale-110"
                                        title="Delete"
                                        onclick="openMediaDelete('{{ $upload->id }}', '{{ addslashes($upload->file_name) }}')"
                                    >
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </button>
                                @endif
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-3 flex-1 flex flex-col">
                            <div class="flex items-start justify-between gap-2 mb-1">
                                <h4 class="text-sm font-medium text-zinc-900 dark:text-white truncate flex-1" title="{{ $upload->file_name }}">
                                    {{ $upload->file_name }}
                                </h4>
                                @if($upload->seo_alt_text)
                                    <flux:icon name="check-circle" class="w-3 h-3 text-green-500 shrink-0" title="SEO Optimized" />
                                @endif
                            </div>
                            
                            <div class="mt-auto pt-2 flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400 border-t border-zinc-100 dark:border-zinc-800">
                                <span class="uppercase tracking-wider font-medium text-[10px]">{{ pathinfo($upload->url, PATHINFO_EXTENSION) }}</span>
                                <span>{{ $upload->created_at->diffForHumans(null, true) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination (if available) --}}
            @if(method_exists($uploads, 'links'))
                <div class="mt-8">
                    {{ $uploads->withQueryString()->links() }}
                </div>
            @endif
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="mediaDeleteModal" class="fixed inset-0 bg-black/50 hidden z-50 items-center justify-center">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <flux:heading size="lg">Confirm Delete</flux:heading>
                    <button type="button" class="text-zinc-400 hover:text-zinc-600" onclick="closeMediaDelete()">×</button>
                </div>
                <div class="flex items-start gap-3 mb-6">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                    </div>
                    <div class="flex-1">
                        <p class="text-zinc-900 dark:text-white mb-2">
                            Are you sure you want to delete
                            <span class="font-semibold" id="mediaDeleteName"></span>?
                        </p>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            This will soft-delete the media item and keep the file on disk.
                        </p>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3">
                    <flux:button variant="ghost" onclick="closeMediaDelete()">Cancel</flux:button>
                    <flux:button variant="danger" onclick="confirmMediaDelete()">Delete</flux:button>
                </div>
            </div>
        </div>
    </div>

    <form id="mediaDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        let mediaDeleteId = null;

        function openMediaDelete(id, name) {
            mediaDeleteId = id;
            document.getElementById('mediaDeleteName').textContent = `"${name}"`;
            const modal = document.getElementById('mediaDeleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeMediaDelete() {
            mediaDeleteId = null;
            const modal = document.getElementById('mediaDeleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function confirmMediaDelete() {
            if (!mediaDeleteId) return;
            const form = document.getElementById('mediaDeleteForm');
            form.action = `/admin/media/${mediaDeleteId}`;
            form.submit();
        }

        document.getElementById('mediaDeleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMediaDelete();
            }
        });
    </script>
@endsection
