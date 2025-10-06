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
                        <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Edit About Section</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Update the information below for your about section</p>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <form action="{{ route('abouts.update', $about) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
                @csrf
                @method('PUT')

                @if (session()->has('error'))
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                        <span class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
                @endif

                <!-- Current Video -->
                @if($about->video)
                    <div class="space-y-2">
                        <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Current Video</flux:label>
                        <div class="w-full max-w-md">
                            <video controls class="w-full h-48 bg-zinc-100 dark:bg-zinc-800 rounded-lg">
                                <source src="{{ Storage::url($about->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                @endif

                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Basic Information</h4>
                    </div>

                    <!-- Video Upload -->
                    <div class="space-y-2">
                        <flux:label for="video" class="text-zinc-700 dark:text-zinc-300 font-medium">{{ $about->video ? 'Replace Video' : 'Video' }}</flux:label>
                        <flux:input
                            type="file"
                            id="video"
                            name="video"
                            accept="video/*"
                            class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-200"
                        />
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Upload a video file (MP4, AVI, MOV, WMV, FLV, WebM). Max size: 100MB</p>
                        @error('video')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="title" required class="text-zinc-700 dark:text-zinc-300 font-medium">Title</flux:label>
                            <flux:input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $about->title) }}"
                                placeholder="Enter about section title"
                                required
                                class="w-full"
                            />
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <flux:label for="subtitle" required class="text-zinc-700 dark:text-zinc-300 font-medium">Subtitle</flux:label>
                            <flux:input
                                type="text"
                                id="subtitle"
                                name="subtitle"
                                value="{{ old('subtitle', $about->subtitle) }}"
                                placeholder="Enter about section subtitle"
                                required
                                class="w-full"
                            />
                            @error('subtitle')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="description" required class="text-zinc-700 dark:text-zinc-300 font-medium">Description</flux:label>
                        <flux:textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Enter about section description"
                            required
                            class="w-full"
                        >{{ old('description', $about->description) }}</flux:textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="chart-bar" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Skills</h4>
                    </div>

                    <div id="skills-container" class="space-y-3">
                        @php
                            $skills = $about->skills ?? [];
                        @endphp
                        @if(count($skills) > 0)
                            @foreach($skills as $index => $skill)
                                <div class="skill-item flex items-center space-x-3 p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                                    <div class="flex-1">
                                        <input
                                            type="text"
                                            name="skills[{{ $index }}][name]"
                                            placeholder="Skill name"
                                            value="{{ old("skills.{$index}.name", $skill['name'] ?? '') }}"
                                            required
                                            class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        />
                                    </div>
                                    <div class="w-24">
                                        <input
                                            type="number"
                                            name="skills[{{ $index }}][percentage]"
                                            placeholder="%"
                                            min="0"
                                            max="100"
                                            value="{{ old("skills.{$index}.percentage", $skill['percentage'] ?? '') }}"
                                            required
                                            class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        />
                                    </div>
                                    <flux:button type="button" variant="ghost" size="sm" onclick="removeSkill(this)">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:button>
                                </div>
                            @endforeach
                        @else
                            <div class="skill-item flex items-center space-x-3 p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                                <div class="flex-1">
                                    <input
                                        type="text"
                                        name="skills[0][name]"
                                        placeholder="Skill name"
                                        value="{{ old('skills.0.name') }}"
                                        required
                                        class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                    />
                                </div>
                                <div class="w-24">
                                    <input
                                        type="number"
                                        name="skills[0][percentage]"
                                        placeholder="%"
                                        min="0"
                                        max="100"
                                        value="{{ old('skills.0.percentage') }}"
                                        required
                                        class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                    />
                                </div>
                                <flux:button type="button" variant="ghost" size="sm" onclick="removeSkill(this)">
                                    <flux:icon name="trash" class="w-4 h-4" />
                                </flux:button>
                            </div>
                        @endif
                    </div>
                    <flux:button type="button" variant="outline" size="sm" onclick="addSkill()">
                        <flux:icon name="plus" class="w-4 h-4" />
                        Add Skill
                    </flux:button>
                    @error('skills')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- CTA Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="cursor-arrow-rays" class="w-5 h-5 text-green-600 dark:text-green-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Call to Action</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="cta" required class="text-zinc-700 dark:text-zinc-300 font-medium">CTA Text</flux:label>
                            <flux:input
                                type="text"
                                id="cta"
                                name="cta"
                                value="{{ old('cta', $about->cta) }}"
                                placeholder="Enter CTA text"
                                required
                                class="w-full"
                            />
                            @error('cta')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <flux:label for="cta_url" required class="text-zinc-700 dark:text-zinc-300 font-medium">CTA URL</flux:label>
                            <flux:input
                                type="text"
                                id="cta_url"
                                name="cta_url"
                                value="{{ old('cta_url', $about->cta_url) }}"
                                placeholder="/contact or https://example.com"
                                required
                                class="w-full"
                            />
                            @error('cta_url')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="chart-pie" class="w-5 h-5 text-orange-600 dark:text-orange-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Statistics</h4>
                    </div>

                    <div id="statistics-container" class="space-y-3">
                        @php
                            $statistics = $about->statistics ?? [];
                        @endphp
                        @if(count($statistics) > 0)
                            @foreach($statistics as $index => $statistic)
                                <div class="statistic-item flex items-center space-x-3 p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                                    <div class="flex-1">
                                        <input
                                            type="text"
                                            name="statistics[{{ $index }}][number]"
                                            placeholder="Number/Value"
                                            value="{{ old("statistics.{$index}.number", $statistic['number'] ?? '') }}"
                                            required
                                            class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        />
                                    </div>
                                    <div class="flex-1">
                                        <input
                                            type="text"
                                            name="statistics[{{ $index }}][label]"
                                            placeholder="Label"
                                            value="{{ old("statistics.{$index}.label", $statistic['label'] ?? '') }}"
                                            required
                                            class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                        />
                                    </div>
                                    <flux:button type="button" variant="ghost" size="sm" onclick="removeStatistic(this)">
                                        <flux:icon name="trash" class="w-4 h-4" />
                                    </flux:button>
                                </div>
                            @endforeach
                        @else
                            <div class="statistic-item flex items-center space-x-3 p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                                <div class="flex-1">
                                    <input
                                        type="text"
                                        name="statistics[0][number]"
                                        placeholder="Number/Value"
                                        value="{{ old('statistics.0.number') }}"
                                        required
                                        class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                    />
                                </div>
                                <div class="flex-1">
                                    <input
                                        type="text"
                                        name="statistics[0][label]"
                                        placeholder="Label"
                                        value="{{ old('statistics.0.label') }}"
                                        required
                                        class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                                    />
                                </div>
                                <flux:button type="button" variant="ghost" size="sm" onclick="removeStatistic(this)">
                                    <flux:icon name="trash" class="w-4 h-4" />
                                </flux:button>
                            </div>
                        @endif
                    </div>
                    <flux:button type="button" variant="outline" size="sm" onclick="addStatistic()">
                        <flux:icon name="plus" class="w-4 h-4" />
                        Add Statistic
                    </flux:button>
                    @error('statistics')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Images Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="photo" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Images</h4>
                    </div>

                    <x-image-uploader
                        name="images"
                        :existingImages="$about->images->map(function($img) { return ['id' => $img->id, 'url' => Storage::url($img->image), 'alt' => $img->alt, 'name' => $img->name, 'title' => $img->title, 'caption' => $img->caption, 'keywords' => $img->keywords]; })->toArray()"
                        componentId="about-images-edit"
                    />
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
                            href="{{ route('abouts.index') }}"
                            wire:navigate
                            class="px-6"
                        >
                            <flux:icon name="x-mark" class="w-4 h-4 mr-2" />
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary" class="px-6 flex items-center flex-row gap-2">
                            Update About Section
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let skillIndex = {{ count($about->skills ?? []) }};
let statisticIndex = {{ count($about->statistics ?? []) }};

function addSkill() {
    const container = document.getElementById('skills-container');
    const skillItem = document.createElement('div');
    skillItem.className = 'skill-item flex items-center space-x-3 p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg';
    skillItem.innerHTML = `
        <div class="flex-1">
            <input type="text" name="skills[${skillIndex}][name]" placeholder="Skill name" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
        </div>
        <div class="w-24">
            <input type="number" name="skills[${skillIndex}][percentage]" placeholder="%" min="0" max="100" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
        </div>
        <button type="button" class="p-2 text-zinc-400 hover:text-red-600 transition-colors" onclick="removeSkill(this)">
            <flux:icon name="trash" class="w-4 h-4" />
        </button>
    `;
    container.appendChild(skillItem);
    skillIndex++;
}

function removeSkill(button) {
    button.closest('.skill-item').remove();
}

function addStatistic() {
    const container = document.getElementById('statistics-container');
    const statisticItem = document.createElement('div');
    statisticItem.className = 'statistic-item flex items-center space-x-3 p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg';
    statisticItem.innerHTML = `
        <div class="flex-1">
            <input type="text" name="statistics[${statisticIndex}][number]" placeholder="Number/Value" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
        </div>
        <div class="flex-1">
            <input type="text" name="statistics[${statisticIndex}][label]" placeholder="Label" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
        </div>
        <button type="button" class="p-2 text-zinc-400 hover:text-red-600 transition-colors" onclick="removeStatistic(this)">
            <flux:icon name="trash" class="w-4 h-4" />
        </button>
    `;
    container.appendChild(statisticItem);
    statisticIndex++;
}

function removeStatistic(button) {
    button.closest('.statistic-item').remove();
}
</script>
@endsection
