<x-layout titre="ajouter Salle">
    
    <form action="{{ route('seances.store') }}" method="post" class="shadow border mt-5 p-3 ">
        @csrf
        <div class="d-flex justify-content-between align-items-center">
            <h1>Ajouter Seance</h1>
            <a href="{{ route('seances.index') }}" class="btn btn-outline-success">Annuler</a>
        </div>
       <hr>
        <div class="form-group">
            <label for="nom">Nom de Salle</label>
            <input type="hidden" name="salle_id" value="{{ $salle->id }}">
            <input type="text" disabled class="form-control" value="{{ $salle->nom }}">
            @error('salle_id')
                <p class="text-danger"> {{ $errors->first('salle_id') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="nom">Nom de Formateur</label>
            
            <select class="form-control" name="formateur_id" id="">
                @foreach ($formateurs as $formateur )
                <option value="{{ $formateur->id }}">{{ $formateur->nom }}</option>
                @endforeach
            </select>
            @error('formateur_id')
                <p class="text-danger"> {{ $errors->first('formateur_id') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="nom">Nom de Group</label>
            <select class="form-control" name="group_id" id="">
                @foreach ($groups as $group )
                <option  @selected( old('group_id') == $group->id) value="{{ $group->id }}">{{ $group->nom }}</option>
                @endforeach
            </select>
            @error('group_id')
                <p class="text-danger"> {{ $errors->first('group_id') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Color</label>
            <input value="{{ old('color') }}" type="color" name="color" class="form-control" id="">
            @error('color')
                <p class="text-danger"> {{ $errors->first('color') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">periode</label>
            <input type="text" disabled class="form-control" value="{{ $periode }}">
            <input type="hidden" name="periode" value="{{ $periode }}">
        </div>
        <div class="form-group">
            <label for="">Jour</label>
            <input type="text" disabled class="form-control" value="{{ $jour }}">
            <input type="hidden" name="jour" value="{{ $jour }}">
        </div>
       
        <div class="form-group">
            <input type="submit" class="btn btn-outline-primary" value="Ajouter Seance">
        </div>
    </form>

</x-layout>