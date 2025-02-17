<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        try {
            $data['image'] = $this->processImage($request->file('image'));

            Category::create($data);

            return redirect()->route('admin.categories.index')->with('success', 'Categoria creada con éxito');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al crear la categoría: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        try {
            $category = Category::findOrFail($id);

            $category->update($data);

            return redirect()->route('admin.categories.index')->with('success', 'Categoria actualizada con éxito');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al actualizar la categoría: ' . $th->getMessage());
        }
    }

    public function updateImage(Request $request, Category $category)
    {
        $data = $request->validate([
            'image' => 'required|image',
        ]);

        //Eliminar archivo anterior
        Storage::disk('public')->delete($category->image);

        try {
            $data['image'] = $this->processImage($request->file('image'));

            $category->update($data);

            return redirect()->back()->with('success', 'Imagen actualizada con éxito');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al actualizar la imagen: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);

            $posts = $category->posts;
            if ($posts->count() > 0) {
                return redirect()->back()->with('error', 'No se puede eliminar la categoría porque tiene posts asociados');
            }

            //Eliminar archivo
            Storage::disk('public')->delete($category->image);

            $category->delete();

            return redirect()->back()->with('success', 'Categoria eliminada con éxito');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error al eliminar la categoría: ' . $th->getMessage());
        }
    }

    public function processImage($image)
    {
        try {
            // Verifica que la imagen sea válida
            if (!$image || !$image->isValid()) {
                return response()->json(['error' => 'Imagen no válida'], 400);
            }

            $resizedImage = ImageManager::imagick()->read($image->getPathname())
                ->scaleDown(width: 1200)
                ->toJpeg(80);

            $filename = 'images/' . uniqid() . '_' . '.jpg';

            Storage::disk('public')->put($filename, $resizedImage);
            return $filename;
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
