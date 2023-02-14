<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lightning;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LightningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $lightnings = Lightning::query()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.lightning.index', compact('lightnings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.lightning.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
        ]);
        Lightning::create($validated);
        return redirect()->route('lightning.index')->with('success', "Молния успешно добавлена");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $lightning = Lightning::query()->where('id', '=', $id)->first();
        return view('admin.lightning.edit', compact('lightning'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $lightning = Lightning::query()->where('id', '=', $id)->first();
        $request->validate([
            'content' => 'required',
        ]);
        $lightning->update($request->all());
        return redirect()->route('lightning.index')->with('success', "Молния успешно изменена.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $lightning = Lightning::query()->where('id', '=', $id)->first();
        $lightning->delete();
        return redirect()->route('lightning.index')->with('success', "Удаление молнии завершено успешно.");
    }
}
