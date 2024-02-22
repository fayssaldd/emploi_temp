<x-layout titre="ajouter filier">
    
    <form action="{{ route('filier.store') }}" method="post" class="shadow border mt-5 p-3 w-75" style="margin-top: 10rem !important">
        @csrf
        <div class="d-flex justify-content-between align-items-center">
            <h1>Ajouter Filier</h1>
            <a href="{{ route('filier.index') }}" class="btn btn-outline-success">Afficher Filiers</a>    
        </div>
       <hr>
        <div class="form-group">
            <label for="nom">Nom de filier</label>
            <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom">
            @error('nom')
                <p class="text-danger"> {{ $errors->first('nom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="formateurs">formateurs</label>
            <select class="form-control" multiple name="formateurs_ids[]" id="formateurs_ids">
            @foreach ($formateurs as $formateur)
                <option value="{{ $formateur->id }}">{{ $formateur->nom }}</option>
            @endforeach
            </select>
            @error('formateurs_ids')
            <p class="text-danger"> {{ $errors->first('formateurs_ids') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-outline-primary" value="Ajouter Filier">
        </div>
    </form>

</x-layout>