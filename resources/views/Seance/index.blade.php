<x-layout titre="Seances">
   <div class="table-responsive ff">
    <table class="table table-bordered" >
        <thead class="bg-light ptt">
            <tr>
                <th>Jour</th>
                <th>Heure</th>
                @foreach ($seances['salles'] as $salle)
                    <th style="width: 300px !important" >{{ $salle['nom'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach(['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi','samedi'] as $jour)
                @foreach([1, 2, 3, 4] as $periode)
                    <tr class="border border-bottom ">
                        @if ($loop->first)
                            <td   class="bg-light text-center" rowspan="4">{{ ucfirst($jour) }}</td>
                        @endif
                        <td class="font-weight-bold bg-light">{{ ($periode == 1 ? '8H30 - 11H' : ($periode == 2 ? '11H - 1H3' : ($periode == 3 ? '1H30 - 4H' : ' 4H - 6H30 '))) }}</td>
                        @foreach ($seances['salles'] as $salle)
                            <td  class="text-center" >
                                @php
                                    $seanceExist = false;
                                @endphp
                                @foreach ($seances[$jour][$periode] ?? [] as $cours)
                                    @if ($cours['salle']['id'] == $salle['id'])
                                        <form action="{{ route('seances.destroy',$cours->id) }}" method="POST" class="">
                                            @method('DELETE')
                                            @csrf  
                                            <input  type="submit" value="{{ $cours['group']['nom'] }} - {{ $cours['formateur']['prenom'] }} {{ $cours['formateur']['nom'] }}" class="btn w-100 text-white p-3" onclick="return confirm('Are you sure?')" style="background-color:{{$cours->color}}">
                                        </form>
                                        {{-- <button  class="btn w-100 text-white p-3" style="background-color:{{$cours->color}}">{{ $cours['group']['nom'] }} - {{ $cours['formateur']['prenom'] }} {{ $cours['formateur']['nom'] }}</button> --}}
                                        @php
                                        $seanceExist = true;
                                        @endphp
                                        
                                    @endif
                                    
                                @endforeach
                                @if (!$seanceExist)
                                    <a  style="width: 200px !important;"  href="{{ route('seances.created',[$salle['id'],$periode,$jour]) }}" class="btn w-100 p-3 btn-primary">+</a>   
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
   </div>

</x-layout>