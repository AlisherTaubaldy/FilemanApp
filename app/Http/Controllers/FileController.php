<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(Request $request)
    {
        // Получение списка файлов с пагинацией
        $files = File::paginate(50);
        return response()->json($files);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:8192', // Максимум 8 MB
        ]);

        // Загрузка файла
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public');
            $fileModel = File::create([
                'name' => $request->input('name', $file->getClientOriginalName()),
                'file_path' => $filePath,
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
            ]);

            return response()->json($fileModel, 201);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }

    public function show(File $file)
    {
        return response()->json($file);
    }

    public function update(Request $request, File $file)
    {
        // Обновление информации о файле
        $file->update($request->only('name'));
        return response()->json($file);
    }

    public function destroy(File $file)
    {
        // Удаление файла и записи из БД
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
        return response()->json(null, 204);
    }
}
