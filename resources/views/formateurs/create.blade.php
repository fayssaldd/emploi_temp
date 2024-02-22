<x-layout titre="ajouter Formateur">
    
    <form action="{{ route('formateurs.store') }}" method="post" class="shadow border mt-5 p-3 w-100"  style="margin-top: 7rem !important">
        @csrf
        <div class="d-flex justify-content-between align-items-center">
            <h1>Ajouter Formateur</h1>
            <a href="{{ route('formateurs.index') }}" class="btn btn-outline-success">Afficher Formateurs</a>    
        </div>
       <hr>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom">
            @error('nom')
                <p class="text-danger"> {{ $errors->first('nom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="prenom">prenom</label>
            <input type="text" name="prenom" class="form-control" id="prenom">
            @error('prenom')
                <p class="text-danger"> {{ $errors->first('prenom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="date_formation">date_formation</label>
            <input type="date" name="date_formation" class="form-control" id="date_formation">
            @error('date_formation')
                <p class="text-danger"> {{ $errors->first('date_formation') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="type">type</label>
            <select  class="form-control" name="type" id="type">
                <option value="">Selectionnez le type</option>
                <option value="permanent">permanent</option>
                <option value="vacataire">vacataire</option>
            </select>
            @error('type')
                <p class="text-danger"> {{ $errors->first('type') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="filiers_ids">filieres(opetionnel)</label>
            <select class="form-control" multiple name="filiers_ids[]" id="filiers_ids">

            @foreach ($filiers as $filier)
                <option value="{{ $filier->id }}">{{ $filier->nom }}</option>
            @endforeach
            </select>
            @error('filiers_ids')
            <p class="text-danger"> {{ $errors->first('filiers_ids') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-outline-primary" value="Ajouter Formateur">
        </div>
    </form>
</x-layout>