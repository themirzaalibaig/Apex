@extends('components.layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="m-6 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50 flex items-center gap-3">
                <div class="w-10 h-10 bg-zinc-100 dark:bg-zinc-900/30 rounded-lg flex items-center justify-center">
                    <flux:icon name="photo" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Media Library</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Manage uploads and reuse them across sections</p>
                </div>
                <div class="ml-auto">
                    <flux:button type="button" variant="primary" onclick="window.location.href='{{ route('media.create') }}'">
                        <flux:icon name="plus" class="w-4 h-4 mr-2" />
                        Upload Media
                    </flux:button>
                </div>
            </div>

            <div class="px-6 py-4 flex flex-col md:flex-row gap-4 items-start md:items-center">
                <div class="flex items-center gap-2">
                    <a href="{{ route('media.index', ['status' => 'active', 'search' => $search ?? '']) }}"
                       class="px-3 py-1 rounded-lg text-sm {{ $status !== 'deleted' ? 'bg-blue-600 text-white' : 'bg-zinc-100 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300' }}">
                        Active
                    </a>
                    <a href="{{ route('media.index', ['status' => 'deleted', 'search' => $search ?? '']) }}"
                       class="px-3 py-1 rounded-lg text-sm {{ $status === 'deleted' ? 'bg-blue-600 text-white' : 'bg-zinc-100 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300' }}">
                        Deleted
                    </a>
                </div>
                <form method="GET" class="ml-auto w-full md:w-auto">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Search by name, URL, alt text"
                        class="w-full md:w-80 px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white"
                    />
                </form>
            </div>

            <div class="p-6">
                @if($uploads->isEmpty())
                    <div class="text-center text-zinc-500 dark:text-zinc-400 py-10">No media found.</div>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($uploads as $upload)
                            <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden">
                                <div class="aspect-square bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center">
                                    <img src="{{ $upload->url }}" alt="{{ $upload->seo_alt_text ?? '' }}" class="object-cover w-full h-full" />
                                </div>
                                <div class="p-3 space-y-2">
                                    <div class="text-sm font-medium text-zinc-900 dark:text-white truncate">{{ $upload->file_name }}</div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $upload->url }}</div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('media.edit', $upload->id) }}" class="text-xs text-blue-600 hover:underline">Edit</a>
                                        @if(!$upload->is_deleted)
                                            <form method="POST" action="{{ route('media.destroy', $upload->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-600 hover:underline">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
