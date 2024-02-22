<x-layout titre="Update Groupe">
    
    <form action="{{ route('groups.update',$group->id) }}" method="post" class="shadow border mt-5 p-3 q-75"  style="margin-top: 7rem !important">
        @csrf
        @method('put')
        <div class="d-flex justify-content-between align-items-center">
            <h1>Modifier Groupe</h1>
            <a href="{{ route('groups.index') }}" class="btn btn-outline-success">Annuler</a>    
        </div>
       <hr>
        <div class="form-group">
            <label for="nom">Nom de Groupe</label>
            <input type="text" name="nom" value="{{ old('nom',$group->nom) }}" class="form-control" id="nom">
            @error('nom')
                <p class="text-danger"> {{ $errors->first('nom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="filier_id">filiere</label>
            <select class="form-control" name="filier_id">
                <option value="">Selectionnez la filier</option>
            @foreach ($filiers as $filier)
                <option @selected($group->filier_id === $filier->id) value="{{ $filier->id }}">{{ $filier->nom }}</option>
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