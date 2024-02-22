<x-layout titre="Modifier filier">
    
    <form action="{{ route('filier.update',$filier->id) }}" method="POST" class="shadow border mt-5 p-3 ">
        @method('put')
        @csrf
        <div class="d-flex justify-content-between align-items-center">
            <h1>Modifier Filier</h1>
            <a href="{{ route('filier.index') }}" class="btn btn-outline-success">Afficher Filiers</a>    
        </div>
       <hr>
        <div class="form-group">
            <label for="nom">Nom de filier</label>
            <input value="{{ old('nom',$filier->nom) }}" type="text" name="nom" class="form-control" id="nom">
            @error('nom')
                <p class="text-danger"> {{ $errors->first('nom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-outline-primary" value="Modifier Filier">
        </div>
    </form>
</x-layout>