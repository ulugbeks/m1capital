<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::ordered()->paginate(20);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string|in:partners,charity,hardware',
            'order' => 'nullable|integer'
        ]);

        $partner = new Partner();
        $partner->name = $request->input('name');
        $partner->category = $request->input('category', 'partners');
        $partner->order = $request->input('order', 0);
        $partner->is_active = $request->boolean('is_active');

        // Загружаем логотип
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partners', 'public');
            $partner->logo = $path;
        }

        $partner->save();

        return redirect()->route('admin.partners.index')->with('success', 'Partner created successfully!');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string|in:partners,charity,hardware',
            'order' => 'nullable|integer'
        ]);

        $partner->name = $request->input('name');
        $partner->category = $request->input('category', 'partners');
        $partner->order = $request->input('order', 0);
        $partner->is_active = $request->boolean('is_active');

        // Обновляем логотип
        if ($request->hasFile('logo')) {
            // Удаляем старый логотип
            if ($partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }
            
            $path = $request->file('logo')->store('partners', 'public');
            $partner->logo = $path;
        }

        $partner->save();

        return redirect()->route('admin.partners.index')->with('success', 'Partner updated successfully!');
    }

    public function destroy(Partner $partner)
    {
        // Удаляем логотип
        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully!');
    }
}