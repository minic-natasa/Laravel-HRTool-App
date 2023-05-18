<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aneks ugovora o radu</title>

</head>

<body>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.3;
            margin-left: 13px;
            margin-right: 13px;
        }

        h1 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 1px;
        }

        .contract-section p {
            margin: 0;
            text-align: justify;
        }

        .pos-desc {
            font-size: 10.5px !important;
        }

        table {
            border-collapse: collapse;
            margin: auto;
            width: 100%;
            line-height: 2;
        }

        td {
            border: none;
        }
    </style>

    <div class="contract-section">
        <p>Na osnovu člana 33. i 171. stav 1. Zakona o radu (&quot;Sl. glasnik RS&quot;, br. 24/2005, 61/2005, 54/2009, 32/2013,
            75/2014, 13/2017 - odluka US, 113/2017 i 95/2018 - autentično tumačenje, u daljem tekstu: Zakon), pristupa se
            zaključenju:</p><br>
    </div>

    <h1>ANEKS {{$annex_number}} <br>UGOVORA O RADU</h1><br>

    <div class="contract-section">
        <p style="text-align: center;">Ovim Aneksom se menja Ugovor o radu zaključen između:</p><br>
    </div>

    <div class="contract-section">
        <p>1. Privrednog društva <strong>“SELLERS ALLEY”</strong> d.o.o. {{$employerTown}}, ul. {{$employerStreet}}, MB: 21647900, PIB:
            112312839 (u daljem tekstu: Poslodavac) i</p><br>
    </div>

    <div class="contract-section">
        <p>2. <strong>{{$first_name}} ({{$name_of_one_parent}}) {{$last_name}}</strong> iz <strong>{{$town}}</strong> ul. <strong>{{$street}}</strong>, JMBG:
            <strong>{{$jmbg}}</strong> koji radi na poslovima: <strong>{{$position}}</strong>.
        </p><br>
    </div>

    @if($annexGrossSalary && $annexGrossSalary != '0,00')
    <div class="contract-section">
        <p style="text-align: center;">Menja se član 6. Ugovora o radu, koji sada glasi:</p><br>
    </div>

    <div class="contract-section">
        <p>Visina osnovne zarade zaposlenog za pun
            mesečni fond časova rada i standardni učinak svakog meseca iznosi <strong>{{$annexGrossSalary}}</strong> dinara u bruto I iznosu.</p><br>
    </div>

    @endif

    @if($annexPosition)
    @php

    @endphp

    <div class="contract-section">
        <p style="text-align: center;">Menja se član 1. Ugovora o radu, koji sada glasi:</p><br>
    </div>

    <div class="contract-section">
        <p>Za obavljanje poslova: <strong>{{$annexPosition}}</strong>. Zaposleni obavlja poslove i ima dužnosti koje su određene ovim ugovorom i to:</p><br>
    </div>

    <div class="contract-section">
        <strong>
            <p class="pos-desc">{!! $position_description !!}</p><br>
        </strong>
    </div>
    @endif


    @if($annexWorkingAddress)
    @if($annexWorkingAddress == $current_address)
    <!-- REMOTE -->
    <div class="contract-section">
        <p style="text-align: center;">Menja se član 2. Ugovora o radu, koji sada glasi:</p><br>
    </div>

    <div class="contract-section">
        <p>Zaposleni će obavljati poslove <strong>od kuće, van prostorija poslodavca, i to na adresi: {{$current_address}}</strong>.</p><br>
    </div>

    <div class="contract-section">
        <p style="text-align: center;">Menja se član 11. Ugovora o radu tako što se dodaje:</p><br>
    </div>

    <div class="contract-section">
        <p><strong>Zaposleni ostvaruje pravo i na dodatnu naknadu troškova u iznosu od 3.000 RSD neto na
                mesečnom nivou na ime troškova rada od kuće (korišćenje ličnih resursa rada - struja, internet,
                lična sredstva rada i slično).</strong></p><br>
    </div>

    @else
    <!-- HYBRID -->
    <div class="contract-section">
        <p style="text-align: center;">Menja se član 2. Ugovora o radu, koji sada glasi:</p><br>
    </div>

    <div class="contract-section">
        <p>Zaposleni će obavljati poslove <strong>iz kancelarije, i to na adresi: {{$employer}}.</strong></p><br>
    </div>

    @endif
    @endif

   
    @if($annexEmployerAddress)
    @php
    $data = [];
    if ($annexEmployerAddress) {
    $workingAddress_parts = explode(',', $annexEmployerAddress);
    $workingStreet = trim($workingAddress_parts[0]);
    $workingTown = trim($workingAddress_parts[1]);

    $data['workingStreet'] = $workingStreet;
    $data['workingTown'] = $workingTown;
    }
    @endphp

    <div class="contract-section">
        <p style="text-align: center;">Menja se član 1. Ugovora o radu, koji sada glasi:</p><br>
    </div>

    <div class="contract-section">
        <p>Poslodavac - Privredno društvo “SELLERS ALLEY” d.o.o. <strong>{{ $data['workingTown'] }}, ul. {{ $data['workingStreet'] }}</strong>, MB: 21647900, PIB: 112312839 (u daljem tekstu: Poslodavac),</p><br>
    </div>
    @endif


    @if($annexWorkingHours)
    @if($annexWorkingHours == 40)
    <div class="contract-section">
        <p style="text-align: center;">Menja se član 5. Ugovora o radu, koji sada glasi:</p><br>
    </div>

    <div class="contract-section">
        <p><strong>Zaposleni zasniva radni odnos sa punim radnim vremenom u trajanju od 8 časova dnevno i 40 časova
                nedeljno.</strong></p><br>
    </div>

    @else
    <div class="contract-section">
        <p style="text-align: center;">Menja se član 5. Ugovora o radu, koji sada glasi:</p><br>
    </div>

    <div class="contract-section">
        <p><strong>Zaposleni zasniva radni odnos sa nepunim radnim vremenom u trajanju {{$annexWorkingHours}} časova
                nedeljno.</strong></p><br>
    </div>
    @endif
    @endif

    <div class="contract-section">
        <p>Sve ostale odredbe osnovnog ugovora o radu ostaju na snazi i nepromenjene.</p><br>
    </div>

    <div class="contract-section">
        <p>Ovaj Aneks ugovora o radu stupa na snagu datumom potpisa ugovornih strana, a počinje važiti od
            <strong>{{$annex_date}}</strong>
        </p><br>
    </div>

    <div class="contract-section">
        <p>Ovaj Aneks ugovora o radu je sačinjen u 3 (slovima: tri) istovetna primerka, od kojih je 2 (slovima: dva)
            za poslodavca i 1 (slovima: jedan) za zaposlenog.</p><br>
    </div>

    <div class="contract-section">
        <p>Sastavni deo ovog Aneksa ugovora o radu je Obaveštenje o ponudi za zaključenje ugovora o radu.</p><br>
    </div>

    <div class="contract-section">
        <p>U Beogradu dana: <strong>{{$annex_created_date}}</strong></p><br>
    </div>

    <div class="contract-section" style="padding-top: 20px;">
        <table>
            <tr>
                <td>ZAPOSLENI</td>
                <td>POSLODAVAC</td>
            </tr>
            <tr>
                <td>________________________________</td>
                <td>________________________________</td>
            </tr>
            <tr>0
                <td><strong>{{$first_name}} {{$last_name}}</strong></td>
                <td class="italic">Marija Kosanović, </td>
            </tr>
            <tr>
                <td></td>
                <td class="italic">Direktorka ljudskih resursa</td>
            </tr>
        </table>
    </div><br><br><br>

</body>

</html>