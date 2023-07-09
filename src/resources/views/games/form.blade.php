@extends('base')

@section('content')
    <h1 class="display-2">Add Game</h1>

    <form action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="storefronts" class="form-label">Storefront</label>
            <select id="storefronts" name="storefronts[]" class="form-select">
                <option value="">Select</option>
                <option value="1">Hello</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="platforms" class="form-label">Platforms</label>
            <select id="platforms" name="platforms[]" class="form-select">
                <option value="">Select</option>
                <option value="1">Hello</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="">Select</option>
                <option value="1">Hello</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input id="purchase_date" name="purchase_date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date</label>
            <input id="release_date" name="release_date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <select id="genre" name="genre" class="form-select">
                <option value="">Select</option>
                <option value="1">Hello</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="developer" class="form-label">Developer</label>
            <select id="developer" name="developer" class="form-select">
                <option value="">Select</option>
                <option value="1">Hello</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="publisher" class="form-label">Publisher</label>
            <select id="publisher" name="publisher" class="form-select">
                <option value="">Select</option>
                <option value="1">Hello</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="hero_image" class="form-label">Cover</label>
            <input type="file" name="hero_image" id="hero_image" class="form-control">
        </div>
    </form>
@endsection
