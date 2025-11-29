<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\PublicationTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $sort = $request->sort ?? 10;
        $type = $request->type ?? null;
        $status = $request->status ?? null;

        $publications = Publication::with(['authors', 'tags'])
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('abstract', 'like', "%{$search}%")
                    ->orWhere('venue', 'like', "%{$search}%");
            })
            ->when($type, function ($query, $type) {
                $query->where('publication_type', $type);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate($sort)
            ->appends(request()->query());

        return view('admin.publication.index', compact('publications'));
    }

    public function store(Request $request)
    {
        try {
            // Log request untuk debug
            Log::info('Publication Store Request:', $request->all());

            $validation = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'publication_type' => 'required|in:journal,conference,preprint,thesis,book_chapter,workshop',
                'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
                'month' => 'nullable|integer|min:1|max:12',
                'abstract' => 'required|string',
                'venue' => 'nullable|string|max:255',
                'doi' => 'nullable|string|max:100',
                'url' => 'nullable|url',
                'pdf_url' => 'nullable|url',
                'status' => 'required|in:published,accepted,under_review,preprint',
                'is_featured' => 'nullable|boolean',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'content' => 'nullable|string',
                'authors' => 'required|array|min:1',
                'authors.*.id' => 'required|exists:authors,id',
                'authors.*.order' => 'required|integer|min:1',
                'tags' => 'nullable|array',
                'tags.*' => 'exists:publication_tags,id',
            ]);

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('publications', 'public');
            }

            // Create publication
            $publication = Publication::create([
                'title' => $request->title,
                'publication_type' => $request->publication_type,
                'venue' => $request->venue,
                'year' => $request->year,
                'month' => $request->month,
                'abstract' => $request->abstract,
                'content' => $request->content,
                'featured_image' => $imagePath,
                'doi' => $request->doi,
                'url' => $request->url,
                'pdf_url' => $request->pdf_url,
                'status' => $request->status,
                'is_featured' => $request->boolean('is_featured'),
                'citation_count' => $request->citation_count ?? 0,
            ]);

            Log::info('Publication created:', ['id' => $publication->id]);

            // Attach authors
            if ($request->has('authors') && is_array($request->authors)) {
                foreach ($request->authors as $author) {
                    Log::info('Attaching author:', $author);

                    $publication->authors()->attach($author['id'], [
                        'author_order' => $author['order']
                    ]);
                }
            }

            // Attach tags
            if ($request->has('tags') && is_array($request->tags)) {
                Log::info('Attaching tags:', $request->tags);

                $publication->tags()->attach($request->tags);

                foreach ($request->tags as $tagId) {
                    $tag = PublicationTag::find($tagId);
                    if ($tag) {
                        $tag->incrementCount();
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menyimpan publikasi.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Publication Store Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $data = Publication::with(['authors', 'tags'])->find($id);

        if (!$data) {
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true, 'data' => $data]);
    }

    public function update(Request $request, $id)
    {
        try {
            Log::info('Publication Update Request:', $request->all());

            $validation = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'publication_type' => 'required|in:journal,conference,preprint,thesis,book_chapter,workshop',
                'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
                'month' => 'nullable|integer|min:1|max:12',
                'abstract' => 'required|string',
                'venue' => 'nullable|string|max:255',
                'doi' => 'nullable|string|max:100',
                'url' => 'nullable|url',
                'pdf_url' => 'nullable|url',
                'status' => 'required|in:published,accepted,under_review,preprint',
                'is_featured' => 'nullable|boolean',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'content' => 'nullable|string',
                'authors' => 'required|array|min:1',
                'authors.*.id' => 'required|exists:authors,id',
                'authors.*.order' => 'required|integer|min:1',
                'tags' => 'nullable|array',
                'tags.*' => 'exists:publication_tags,id',
            ]);

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            $publication = Publication::find($id);
            if (!$publication) {
                return response()->json([
                    'success' => false,
                    'message' => 'Publikasi tidak ditemukan.'
                ], 404);
            }

            // Handle image
            $imagePath = $publication->featured_image;
            if ($request->hasFile('featured_image')) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file('featured_image')->store('publications', 'public');
            }

            // Update publication
            $publication->update([
                'title' => $request->title,
                'publication_type' => $request->publication_type,
                'venue' => $request->venue,
                'year' => $request->year,
                'month' => $request->month,
                'abstract' => $request->abstract,
                'content' => $request->content,
                'featured_image' => $imagePath,
                'doi' => $request->doi,
                'url' => $request->url,
                'pdf_url' => $request->pdf_url,
                'status' => $request->status,
                'is_featured' => $request->boolean('is_featured'),
                'citation_count' => $request->citation_count ?? 0,
            ]);

            // Sync authors
            $authorsData = [];
            foreach ($request->authors as $author) {
                $authorsData[$author['id']] = ['author_order' => $author['order']];
            }
            $publication->authors()->sync($authorsData);

            // Sync tags
            $oldTags = $publication->tags->pluck('id')->toArray();
            $newTags = $request->tags ?? [];

            foreach ($oldTags as $tagId) {
                if (!in_array($tagId, $newTags)) {
                    $tag = PublicationTag::find($tagId);
                    $tag?->decrementCount();
                }
            }

            foreach ($newTags as $tagId) {
                if (!in_array($tagId, $oldTags)) {
                    $tag = PublicationTag::find($tagId);
                    $tag?->incrementCount();
                }
            }

            $publication->tags()->sync($newTags);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui publikasi.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Publication Update Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $publication = Publication::find($id);

        if (!$publication) {
            return response()->json(['status' => false, 'message' => 'Publikasi tidak ditemukan.'], 404);
        }

        foreach ($publication->tags as $tag) {
            $tag->decrementCount();
        }

        if ($publication->featured_image) {
            Storage::disk('public')->delete($publication->featured_image);
        }

        $publication->delete();

        return response()->json(['message' => 'Berhasil menghapus publikasi.']);
    }
}
