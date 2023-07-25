<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use Illuminate\Database\Eloquent\Builder;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $q = null): InertiaResponse
    {
        return Inertia::render('Admin/Contacts/Index', [
            'contacts' => Contact::when($q ==! null, function (Builder $query, int $q) {
                                        $query->where('status', $q);
                                    })
                                    ->orderBy('created_at', 'DESC')
                                    ->get(),
            'statuses' => Contact::STATUS
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Contacts/Create', [
            'user_email' => Auth::check() ? Auth()->user()->email : null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $contact = Contact::create($request->only(['text', 'email']));
        return back()->with('succeed', 'Vaša správa bola odoslaná.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): InertiaResponse
    {
        return Inertia::render('Admin/Contacts/Show', [
            'contact' => $contact,
            'statuses' => Contact::STATUS
        ]);
    }


    public function saveStatus(Request $request, Contact $contact): RedirectResponse
    {
        $contact->update($request->only(['status']));
        return back()->with('succeed', 'Status právy bol uložený.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        return redirect()->route('admin.contacts')->with('succeed', 'Správa od užívateľa bola vymazaná.');
    }
}
