<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Zahtev za korišćenje godišnjeg odmora</title>

</head>

<body>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.2;
            margin-left: 13px;
            margin-right: 13px;
        }

        h1 {
            font-size: 12px;
            text-align: center;
            margin-bottom: 20px;
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

        td.italic {
            font-style: italic;
        }
    </style>

    <br><br>
    <div class="contract-section" style="margin-top:30px">
        <p>Ime i prezime: <strong>{{$first_name}} ({{$name_of_one_parent}}) {{$last_name}}</strong></p><br>
    </div>

    <div class="contract-section">
        <p>Adresa: <strong>{{$address_in_id}}</strong></p><br>
    </div><br>

    <h1 style="margin-bottom: 3px; font-size: 23px; margin-top:90px">„SELLERS ALLEY“ doo</h1><br>
    <h1>-SLUŽBI LJUDSKIH RESURSA-</h1><br>

    <div class="contract-section">
        <p>Predmet:</p><br>
    </div>

    <div class="contract-section">
        <p style="text-align: center; font-size:14px"><strong>Zahtev za korišćenje godišnjeg odmora.</strong></p><br><br>
    </div>

    <div class="contract-section">
        <p style="line-height: 1.9;">Ja, <strong>{{$first_name}} ({{$name_of_one_parent}}) {{$last_name}}</strong>, iz <strong>{{$town}}</strong> ul. <strong>{{$street}}</strong>, podnosim zahtev za korišćenje godišnjeg
            odmora za <strong>{{$current_year}}</strong>. godinu, a koji bih želeo da koristim u periodu od ______. do ______. godine.</p><br><br><br><br><br><br>
    </div>

    <div class="contract-section">
        <p>U Beogradu, _____________________ godine.
        </p><br><br><br><br>
    </div>

    <div class="contract-section" style="padding-top: 20px;">
        <table>
            <tr>
                <td>PODNOSILAC ZAHTEVA</td>
            </tr>
            <tr>
                <td>________________________________</td>
            </tr>
            <tr>
                <td><strong>{{$first_name}} {{$last_name}}</strong></td>
            </tr>
        </table>
    </div>

   

</body>

</html>