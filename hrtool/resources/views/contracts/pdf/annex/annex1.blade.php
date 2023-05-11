<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aneks promene radne pozicije</title>

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
        <p>1. Privrednog društva <strong>“SELLERS ALLEY”</strong> d.o.o. Beograd, ul. Makedonska 12, MB: 21647900, PIB:
            112312839 (u daljem tekstu: Poslodavac) i</p><br>
    </div>

    <div class="contract-section">
        <p>2. <strong>{{$first_name}} {{$last_name}}</strong> iz <strong>{{$town}}</strong> ul. <strong>{{$street}}</strong>, JMBG:
            <strong>{{$jmbg}}</strong> koji radi na poslovima: <strong>{{$old_value}}</strong>.
        </p><br>
    </div>

    <div class="contract-section">
        <p style="text-align: center;">Menja se član 1. Ugovora o radu, koji sada glasi:</p><br>
    </div>

    <div class="contract-section">
        <p style="text-align: center;">1. za obavljanje poslova: <strong>{{$new_value}}</strong>.</p><br>
    </div>

    <div class="contract-section">
        <p>Zaposleni obavlja poslove i ima dužnosti koje su određene ovim ugovorom i to:</p><br>
    </div>

    <div class="contract-section">
        <strong>
            <p class="pos-desc">{!! $position_description !!}</p><br>
        </strong>
    </div>

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
            <tr>
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