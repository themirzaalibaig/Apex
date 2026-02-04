<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Upload::query();

        $status = $request->get('status', 'active');
        if ($status === 'deleted') {
            $query->where('is_deleted', true);
        } else {
            $query->where('is_deleted', false);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('file_name', 'like', "%{$search}%")
                    ->orWhere('url', 'like', "%{$search}%")
                    ->orWhere('seo_alt_text', 'like', "%{$search}%");
            });
        }

        $uploads = $query->orderBy('created_at', 'desc')->get();

        return view('admin.media.index', compact('uploads', 'status', 'search'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'uploads.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'external_urls' => 'nullable|string',
            'file_name' => 'nullable|string|max:255',
            'seo_alt_text' => 'nullable|string|max:255',
            'seo_meta_title' => 'nullable|string|max:255',
            'seo_meta_description' => 'nullable|string',
            'seo_meta_keywords' => 'nullable|string',
        ]);

        $created = [];

        if ($request->hasFile('uploads')) {
            foreach ($request->file('uploads') as $file) {
                $filename = Str::uuid()->toString();
                $ext = $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads', "{$filename}.{$ext}", 'public');
                $url = Storage::url($path);

                $created[] = Upload::create([
                    'file_name' => $request->input('file_name') ?: $file->getClientOriginalName(),
                    'public_id' => $filename,
                    'url' => $url,
                    'resource_type' => 'image',
                    'seo_alt_text' => $request->input('seo_alt_text'),
                    'seo_meta_title' => $request->input('seo_meta_title'),
                    'seo_meta_description' => $request->input('seo_meta_description'),
                    'seo_meta_keywords' => $this->parseKeywords($request->input('seo_meta_keywords')),
                ]);
            }
        }

        $externalUrls = $this->parseExternalUrls($request->input('external_urls'));
        foreach ($externalUrls as $url) {
            $publicId = 'ext_' . md5($url);
            $fileName = basename(parse_url($url, PHP_URL_PATH) ?: '') ?: 'external';

            $created[] = Upload::create([
                'file_name' => $request->input('file_name') ?: $fileName,
                'public_id' => $publicId,
                'url' => $url,
                'resource_type' => 'image',
                'seo_alt_text' => $request->input('seo_alt_text'),
                'seo_meta_title' => $request->input('seo_meta_title'),
                'seo_meta_description' => $request->input('seo_meta_description'),
                'seo_meta_keywords' => $this->parseKeywords($request->input('seo_meta_keywords')),
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'uploads' => collect($created)->map(fn ($upload) => $this->formatUpload($upload)),
            ]);
        }

        return redirect()->route('media.index')->with('success', 'Media uploaded successfully.');
    }

    public function edit(string $id)
    {
        $upload = Upload::findOrFail($id);
        return view('admin.media.edit', compact('upload'));
    }

    public function update(Request $request, string $id)
    {
        $upload = Upload::findOrFail($id);

        $request->validate([
            'file_name' => 'required|string|max:255',
            'url' => 'required|string|max:2048',
            'seo_alt_text' => 'nullable|string|max:255',
            'seo_meta_title' => 'nullable|string|max:255',
            'seo_meta_description' => 'nullable|string',
            'seo_meta_keywords' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $upload->update([
            'file_name' => $request->input('file_name'),
            'url' => $request->input('url'),
            'seo_alt_text' => $request->input('seo_alt_text'),
            'seo_meta_title' => $request->input('seo_meta_title'),
            'seo_meta_description' => $request->input('seo_meta_description'),
            'seo_meta_keywords' => $this->parseKeywords($request->input('seo_meta_keywords')),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('media.index')->with('success', 'Media updated successfully.');
    }

    public function destroy(string $id)
    {
        $upload = Upload::findOrFail($id);
        $upload->update([
            'is_deleted' => true,
            'deleted_at' => now(),
        ]);

        return redirect()->route('media.index')->with('success', 'Media deleted successfully.');
    }

    private function parseExternalUrls(?string $input): array
    {
        if (!$input) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $input);
        $urls = array_values(array_filter(array_map('trim', $lines)));
        return $urls;
    }

    private function parseKeywords(?string $input): array
    {
        if (!$input) {
            return [];
        }

        $decoded = json_decode($input, true);
        if (is_array($decoded)) {
            return array_values(array_filter(array_map('trim', $decoded)));
        }

        return array_values(array_filter(array_map('trim', explode(',', $input))));
    }

    private function formatUpload(Upload $upload): array
    {
        return [
            'id' => $upload->id,
            'file_name' => $upload->file_name,
            'url' => $upload->url,
            'seo_alt_text' => $upload->seo_alt_text,
        ];
    }
}
