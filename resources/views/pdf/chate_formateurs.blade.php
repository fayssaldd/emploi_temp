<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
    
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
        }
        .annee-formation table{
            border: 1px black solid;
            border-collapse: collapse;
    
        }
        .emploi {
            border: 3.5px black solid;
            border-collapse: collapse;
            width: 100%;
    
            margin-top: 30px;
        }
        .emploi th {
            border: 3.5px black solid;
            border-collapse: separate;
            padding:  16px;
            font-size: 16px;
        }
        .emploi td {
            border: 3.5px black solid;
            text-align: center;
            height: 64px;
            font-size: 14px;
        }
    
        .groupe {
    
            font-weight: bold;
            margin: 0;
            margin-bottom: 4px;
            font-size: 16px;
        }
        .salle {
            margin: 0;
            font-weight: bold;
    
            font-size: 16px;
        }
        
    </style>
</head>
<body class="d-flex flex-column justify-content-center align-items-center">
   
    <htmlpageheader name="page-header" class="text-center">
        <div class="header" style="display: flex;justify-content:center;margin-top: -45px" >
           <table
           cellpadding="0"
           cellspacing="0"
           >
               <tr>
                   <td class="header-left"
                      style="width: 320px;"
                   >
                   
                       
                       <div class="description" style="padding-top: 2px;margin-top: 4px">
                           <h5 style="padding: 0; margin: 0">DRO/CF TAOURIRT - GUERCIF </h5>
                           <h5 style="padding: 0; margin:2px 0;">ISTA  TAOURIRT</h5>
                           <h5 style="padding: 0; margin:0">Formatuer : <span style="text-transform: capitalize;border: 1px black solid;padding: 2px 6px;margin-left: 24px;font-size: 14px"> {{$formateur}} </span></h5>
  
  
                       </div>
                   </td>
  
                   <td class="header-middle"
                   style="width: 516px;text-align: center;padding-top:111px;"
                   >
                       <h2
                           style="margin: 0; padding: 0; font-size: 24px;text-align: center;padding-bottom: 32px;"
                       >
                           Emploi du temps du formateur
                       </h2>
                       <span style="text-align: center;border: 1.5px solid black; padding: 4px 40px">
                           Masse Horaire hebdomadaire : <span>
                              {{$masse_horaire}} heures
                          </span>
                       </span>
                       
                   </td>
  
                  <td class="header-right"
                  style="width: 180px;padding-top: 95px;"
                  >
                      <div class="annee-formation" >
                          <table
                          width="132" class="ml-4"
                          >
                              <tr
                              style="background: #edf2f7;border: 1px solid #000000;"
                              >
                                  <td>
                                      <h4 style="padding: 0; margin: 0;text-align: center">Année de formation  </h4>
                                  </td>
                              </tr>
                              <tr>
                                  <h3 style="padding: 0; margin: 0; text-align: center">{{$annee_formation}}</h3>
                              </tr>
                          </table>
                          <h4
                              style="padding: 0; margin: 0;text-align: center;margin-top: 12px"
                          >
                              {{Carbon\Carbon::now()->format('d/m/Y')}}
                          </h4>
                      </div>
                  </td>
               </tr>
  
           </table>
        </div>
      </htmlpageheader>
    <table class="emploi">
        <thead>
            <tr>
                <th style="border-top: white 3.5px solid; border-left: white 3.5px solid"></th>
                <th>8H ----------> 11H</th>
                <th style="border-left: 3.5px solid black;">11H ----------> 13H30</th>
                <th style="border-left: 3.5px solid black;">13H30 ----------> 16H</th>
                <th style="border-left: 3.5px solid black;">16H ----------> 18H30</th>
            </tr>
        </thead>
        <tbody>
            @foreach(['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'] as $jour)
            <tr>
                <td>{{ ucfirst($jour) }}</td>
                @for($i = 1; $i <= 4; $i++)
                <td style="border-left:3.5px solid black;">
                    @if(isset($data[$jour][$i][0]))
                        <h5 class="groupe">
                            <span style="font-size: 13px">Formateur :</span> {{ $data[$jour][$i][0]->group->nom ?? '' }} 
                        </h5>
                        <h5 class="salle">
                            <span style="font-size: 13px">Salle :</span> {{ $data[$jour][$i][0]->salle->nom ?? '' }}
                        </h5>
                    @endif
                </td>
            @endfor
            </tr>
            @endforeach
            {{-- @foreach($data as $jour => $periodes)
                <tr>
                    <td>{{ ucfirst($jour) }}</td>
                    @foreach($periodes as $periode => $activites)
                        <td style="border-left: {{ $periode > 1 ? '3.5' : '1' }}px solid black;">
                            @if(isset($activites[0]))
                                <h5 class="groupe">
                                    <span style="font-size: 13px">Groupe :</span> {{ $activites[0]->group->nom ?? '' }}
                                </h5>
                                <h5 class="salle">
                                    <span style="font-size: 13px">Salle :</span> {{ $activites[0]->salle->nom ?? '' }}
                                </h5>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach --}}
        </tbody>
    </table>
    
    
  
      <htmlpagefooter name="page-footer">
      <div class="footer">
          N.B/ Le présent emploi du temps peut subir un changement, si nécessaire par la direction de l’établissement.
      </div>
  </htmlpagefooter>
  

</body>
</html>