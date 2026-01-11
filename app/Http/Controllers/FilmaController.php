<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rezisori;
use App\Models\Filma;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class FilmaController extends Controller implements HasMiddleware
{
    // call auth middleware
    public static function middleware(): array
    {
        return [
        'auth',
        ];
    }
    // display all Filmas
    public function list(): View
    {
        $items = Filma::orderBy('name', 'asc')->get();
        return view(
        'filmas.list',
        [
        'title' => 'Filmas',
        'items' => $items
        ]
        );
    }
    // display new Filma form
    public function create(): View
    {
        $rezisori = Rezisori::orderBy('name', 'asc')->get();
        return view(
        'filmas.form',
        [
        'title' => 'Pievienot filmu',
        'filmas' => new Filma(),
        'rezisori' => $rezisori,
        ]
        );
    }

    // create new Filmas entry
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
            'rezisors_id' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ]);
        $filmas = new Filma();
        $filmas->name = $validatedData['name'];
        $filmas->rezisors_id = $validatedData['rezisors_id'];
        $filmas->description = $validatedData['description'];
        $filmas->price = $validatedData['price'];
        $filmas->year = $validatedData['year'];
        $filmas->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            // šeit varat pievienot kodu, kas nodzēš veco bildi, ja pievieno jaunu
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $filmas->image = $uploadedFile->storePubliclyAs(
            '/',
            $name . '.' . $extension,
            'uploads'
            );
        }


        $filmas->save();
        return redirect('/filmas');
    }
    // display Filmas edit form
    public function update(Filma $filmas): View
    {
        $rezisori = Rezisori::orderBy('name', 'asc')->get();
        return view(
        'filmas.form',
        [
        'title' => 'Rediģēt filmu',
        'filmas' => $filmas,
        'rezisori' => $rezisori,
        ]
        );
    }
    // update Filmas data
    public function patch(Filma $filmas, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'name' => 'required|min:3|max:256',
        'rezisors_id' => 'required',
        'description' => 'nullable',
        'price' => 'nullable|numeric',
        'year' => 'numeric',
        'image' => 'nullable|image',
        'display' => 'nullable',
        ]);
        $filmas->name = $validatedData['name'];
        $filmas->rezisors_id = $validatedData['rezisors_id'];
        $filmas->description = $validatedData['description'];
        $filmas->price = $validatedData['price'];
        $filmas->year = $validatedData['year'];
        $filmas->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            // šeit varat pievienot kodu, kas nodzēš veco bildi, ja pievieno jaunu
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $filmas->image = $uploadedFile->storePubliclyAs(
            '/',
            $name . '.' . $extension,
            'uploads'
            );
        }


        $filmas->save();
        return redirect('/filmas');
    }
    // delete Filmas
    public function delete(Filma $filmas): RedirectResponse
    {
        if ($filmas->image) {
            unlink(getcwd() . '/images/' . $filmas->image);
        }
        // dzēšam arī filmas
        $filmas->delete();
        return redirect('/filmas');
    }

}
