<x-layout titre="ajouter Groupe">
    
    <form action="{{ route('groups.store') }}" method="post" class="shadow border mt-5 p-3 w-75"  style="margin-top: 7rem !important">
        @csrf
        <div class="d-flex justify-content-between align-items-center">
            <h2>Ajouter Groupe</h2>
            <a href="{{ route('groups.index') }}" class="btn btn-outline-success">Afficher Groupes</a>    
        </div>
       <hr>
        <div class="form-group">
            <label for="nom">Nom de Groupe</label>
            <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom">
            @error('nom')
                <p class="text-danger"> {{ $errors->first('nom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="filier_id">filiere</label>
            <select class="form-control" name="filier_id">
                <option value="">Selectionnez la filier</option>
            @foreach ($filiers as $filier)
                <option value="{{ $filier->id }}">{{ $filier->nom }}</option>
            @endforeach
            </select>
            @error('filier_id')
            <p class="text-danger"> {{ $errors->first('filier_id') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-outline-primary" value="Ajouter Group">
        </div>
    </form>

</x-layout>