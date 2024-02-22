<x-layout titre="ajouter Salle">
    
    <form action="{{ route('salles.store') }}" method="post" class="shadow border mt-5 p-3 w-75"  style="margin-top: 7rem !important">
        @csrf
        <div class="d-flex justify-content-between align-items-center">
            <h1>Ajouter Salle</h1>
            <a href="{{ route('salles.index') }}" class="btn btn-outline-success">Afficher Salles</a>    
        </div>
       <hr>
        <div class="form-group">
            <label for="nom">Nom de Salle</label>
            <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom">
            @error('nom')
                <p class="text-danger"> {{ $errors->first('nom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <input type="text" name="description" value="{{ old('description') }}" class="form-control" id="description">
            @error('nom')
                <p class="text-danger"> {{ $errors->first('description') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="espace">espace</label>
            <input type="number" name="espace" value="{{ old('espace') }}" class="form-control" id="espace">
            @error('espace')
                <p class="text-danger"> {{ $errors->first('espace') }}</p>
            @enderror
        </div>
       
        <div class="form-group">
            <input type="submit" class="btn btn-outline-primary" value="Ajouter Salle">
        </div>
    </form>

</x-layout>