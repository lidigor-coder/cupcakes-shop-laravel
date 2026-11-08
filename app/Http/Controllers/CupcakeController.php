<?php

namespace App\Http\Controllers;

use App\Models\Cupcake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CupcakeController extends Controller
{
    /**
     * C - Create: Сохранение нового кекса в базу данных
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Валидация картинки
        ]);

        // Профессиональное сохранение файла на диск в storage/app/public/cupcakes
        if ($request->hasFile('image')) {
            // Сохраняем и получаем чистое имя файла
            $path = $request->file('image')->store('cupcakes', 'public');
            // Перезаписываем путь для базы данных
            $validated['image'] = basename($path);
        }

        Cupcake::create($validated);

        return redirect()->back()->with('success_cupcake', '🧁 Новый кекс успешно добавлен в каталог!');
    }

    /**
     * U - Update: Обновление данных существующего кекса
     */
    public function update(Request $request, $id)
    {
        $cupcake = Cupcake::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Картинка не обязательна при обновлении
        ]);

        if ($request->hasFile('image')) {
            // Удаляем старую картинку с диска, чтобы не засорять сервер
            Storage::disk('public')->delete('cupcakes/' . $cupcake->image);

            // Сохраняем новую
            $path = $request->file('image')->store('cupcakes', 'public');
            $validated['image'] = basename($path);
        }

        $cupcake->update($validated);

        return redirect()->back()->with('success_cupcake', '🔄 Данные кекса успешно обновлены!');
    }

    /**
     * D - Delete: Удаление кекса из магазина
     */
    public function destroy($id)
    {
        $cupcake = Cupcake::findOrFail($id);

        // Удаляем файл картинки с диска
        Storage::disk('public')->delete('cupcakes/' . $cupcake->image);

        // Удаляем запись из MySQL
        $cupcake->delete();

        return redirect()->back()->with('success_cupcake', '🗑️ Кекс полностью удален из каталога!');
    }
}
