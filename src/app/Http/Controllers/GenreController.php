<?php

namespace App\Http\Controllers;

use Log;
use Throwable;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Services\GenreService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Genres\CreateGenreRequest;
use App\Http\Requests\Genres\UpdateGenreRequest;

class GenreController extends Controller
{
    public function __construct(
        protected readonly GenreService $genreService,
    )
    {
    }

    public function index(Request $request): View
    {
        return view('genres.index', [
            'genres' => $this->genreService->paginated(),
        ]);
    }

    public function create() {
        return view('genres.form');
    }

    public function store(CreateGenreRequest $request): RedirectResponse
    {
        try {
            $this->genreService->create($request->all());

            return redirect()
                ->route('genres.index')
                ->with('success', "Genre \"{$request->get('name')}\" has been created.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while creating the genre. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function show(Genre $genre): View
    {
        return view('genres.show', [
            'genre' => $genre,
        ]);
    }

    public function edit(Genre $genre) {
        return view('genres.form', [
            'genre' => $genre,
        ]);
    }

    public function update(UpdateGenreRequest $request, Genre $genre): RedirectResponse
    {
        try {
            $this->genreService->update($genre, $request->all());

            return redirect()
                ->route('genres.show', ['genre' => $genre])
                ->with('success', "Genre updated.");
        } catch(Throwable $e) {
            Log::error($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => 'Error occurred while updating the genre. Try again, or check the logs if this persists.',
                ]);
        }
    }

    public function destroy(Request $request, Genre $genre): RedirectResponse
    {
        try {
            $this->genreService->delete($genre);
        } catch (Throwable $e) {
            Log::error($e);
        }

        return redirect()->route('genres.index');
    }
}
