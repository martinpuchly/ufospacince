<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    
    
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Settings/Index', [
            'settings' => Setting::orderBy('title', 'ASC')->get()
        ]);
    }


    public function edit(Setting $setting): InertiaResponse
    {
        return Inertia::render('Admin/Settings/Edit', [
            'setting' => $setting
        ]); 
    }

    public function update(SettingRequest $request,Setting $setting): RedirectResponse
    {
        $setting->update($request->only(['value']));
        return back()->with('succeed', 'Nastavenie bolo uložené.');
    }



}
