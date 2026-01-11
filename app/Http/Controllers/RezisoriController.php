<?php

namespace App\Http\Controllers;
use App\Models\Rezisori;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class RezisoriController extends Controller implements HasMiddleware
{
    public function list(): View {

    $items = Rezisori::orderBy('name', 'asc')->get();
        return view(
        'rezisori.list',
        [
        'title' => 'Rezisori',
        'items' => $items,
            ]
        );
    }
    // display new Rezisori form
    public function create(): View
    {
        return view(
        'rezisori.form',
        [
        'title' => 'Pievienot režisoru',
        'rezisori' => new Rezisori()
        ]
        );
    }

    // create new Rezisors
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        ]);
        $author = new Rezisori();
        $author->name = $validatedData['name'];
        $author->save();
        return redirect('/rezisori');
    }

    // display Author editing form
    public function update(Rezisori $rezisori): View
    {
        return view(
        'rezisori.form',
        [
        'title' => 'Rediģēt režisoru',
        'rezisori' => $rezisori
        ]
        );
    }

    // update existing Author data
    public function patch(Rezisori $rezisori, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        ]);
        $rezisori->name = $validatedData['name'];
        $rezisori->save();
        return redirect('/rezisori');
    }

    public function delete(Rezisori $rezisori): RedirectResponse
    {
        // šeit derētu pārbaude, kas neļauj dzēst autoru, ja tas piesaistīts eksistējošām grāmatām
        $rezisori->delete();
        return redirect('/rezisori');
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
