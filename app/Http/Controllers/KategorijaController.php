<?php

namespace App\Http\Controllers;

use App\Models\Kategorija;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KategorijaController extends Controller
{
    // display new kategorijas form
    public function create(): View
    {
        return view(
        'kategorijas.form',
        [
        'title' => 'Pievienot Kategoriju',
        'kategorijas' => new Kategorija()
        ]
        );
    }

    public function list(): View {

    $items = Kategorija::orderBy('name', 'asc')->get();
        return view(
        'kategorijas.list',
        [
        'title' => 'Kategorijas',
        'items' => $items,
            ]
        );
    }

    // create new Kategorija
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string'
        ]);
        $kategorijas = new Kategorija();
        $kategorijas->name = $validatedData['name'];
        $kategorijas->description = $validatedData['description'];

        $kategorijas->save();
        return redirect('/kategorijas');
    }

    // display kategorijas editing form
    public function update(Kategorija $kategorijas): View
    {
        return view(
        'kategorijas.form',
        [
        'title' => 'Rediģēt kategoriju',
        'kategorijas' => $kategorijas
        ]
        );
    }

    // update existing kategorijas data
    public function patch(Kategorija $kategorijas, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string'
        ]);
        $kategorijas->name = $validatedData['name'];
        $kategorijas->description = $validatedData['description'];
        $kategorijas->save();
        return redirect('/kategorijas');
    }

    public function delete(Kategorija $kategorijas): RedirectResponse
    {
        $kategorijas->delete();
        return redirect('/kategorijas');
    }
    /**
    * Get the middleware that should be assigned to the controller.
    */
    public static function middleware(): array
    {
        return [
        'auth',
        ];
    }

}
