<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Form Example</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f1f1f1;
        }

        .prescription_form {
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 120px;
            height: 120px;
        }

        .credentials h4 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .credentials p {
            margin: 0;
            font-size: 16px;
        }

        .credentials small {
            margin: 0;
            font-size: 14px;
        }

        .d-header {
            margin: 0;
            padding: 10px 0;
            background-color: mediumseagreen;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .symptoms ul,
        .tests ul {
            list-style-type: square;
            margin: 0;
            padding-left: 20px;
        }

        .advice p {
            margin: 0;
            font-size: 16px;
        }

        .medicine .row {
            margin-bottom: 10px;
        }

        .medicine h4 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            /* // text-align: right; */
        }

        .medicine span,
        .medicine p {
            margin: 0;
            font-size: 14px;
            text-align: right;
        }

        /* Additional CSS */
        .medicine .row {
            display: flex;
            align-items: center;
        }

        .medicine h4 {
            flex-basis: 35%;
        }

        .medicine span,
        .medicine p {
            flex-basis: 20%;
            margin-right: 30px;
        }

        .desease_details td:first-child {
            width: 50%;
        }

        .desease_details td:last-child {
            width: 50%;
        }

        .grid-container {
            background-color: white;
            padding: 5px;
        }

        .grid-item {

            padding: 5px;

            text-align: start;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="prescription_form">
            <table class="prescription" style="width: 100%">
                <tbody>
                    <tr height="15%">
                        <td colspan="2">
                            <div class="header">
                                <div class="logo">
                                    <img
                                        src="https://seeklogo.com/images/H/hospital-clinic-plus-logo-7916383C7A-seeklogo.com.png" />

                                </div>

                                <div class="grid-container" width="100%">
                                    <table>
                                        <tr>
                                            <td class="grid-item">

                                                <h3>Doctor information</h3>
                                                @foreach ($prescprition as $prescpritions)
                                                    <h4>{{ $prescpritions->relationwithPatientTest->relationwithDoctor->fname }}
                                                        {{ $prescpritions->relationwithPatientTest->relationwithDoctor->lname }}
                                                    </h4>
                                                    <p>{{ $prescpritions->relationwithPatientTest->relationwithDoctor->hospital_name }}
                                                    </p>
                                                    <small>{{ $prescpritions->relationwithPatientTest->relationwithDoctor->hospital_address }}</small>
                                                    <br />
                                                    <small>Mb
                                                        {{ $prescpritions->relationwithPatientTest->relationwithDoctor->phone_number }}</small>
                                                @endforeach


                                            </td>
                                            <td class="grid-item">
                                                @if ($patient_cont == '0')
                                                    @foreach ($p_id as $p_ids)
                                                        <h3>patient information</h3>
                                                        <h4>{{ $p_ids->name }}</h4>

                                                        <p>{{ $p_ids->email }}</p>

                                                        <small>Mb {{ $p_ids->phone_number }}</small>
                                                    @endforeach
                                                @else
                                                    @foreach ($patient as $patients)
                                                        <h3>patient information</h3>
                                                        <h4>{{ $patients->fname }} {{ $patients->lname }}</h4>

                                                        <p>{{ $patients->adderss }}</p>
                                                        <small>
                                                            Age:
                                                            {{ Carbon\Carbon::parse($patients->date_of_birth)->diffInYears() }}
                                                            years</Age:>
                                                            <br>
                                                        </small>
                                                        <small>Mb {{ $patients->phone_number }}</small>
                                                    @endforeach
                                                @endif


                                            </td>

                                        </tr>

                                    </table>






                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="35%">

                            <div class="desease_details">
                                <div class="symptoms">
                                    <h4 class="d-header">Symptoms</h4>
                                    <ul>
                                        <li>{{ $prescprition[0]->Symptoms }}</li>

                                    </ul>
                                    <br>
                                </div>
                                <div class="tests">
                                    <h4 class="d-header">Tests</h4>
                                    <ul>
                                        <li>{{ $prescprition[0]->Tests }}</li>

                                    </ul>
                                    <br>
                                </div>
                                <div class="advice">
                                    <h4 class="d-header">Advice</h4>
                                    <br>
                                    <p> {{ $prescprition[0]->Advice }}</p>
                                </div>
                            </div>
                        </td>
                        <td width="60%" valign="top">
                            <span style="font-size: 3em;">R<sub>x</sub></span>
                            <hr />

                            <div class="medicine">
                                @foreach ($prescprition as $prescpritions)
                                    <div class="row">
                                        <br>
                                        <br>
                                        <div class="col-sm-5">


                                            <h4>Medicine Name</h4>

                                            <ul>
                                                @foreach ($prescpritions->relationwithPrescption->pluck('medicine_name')->filter() as $medicine)
                                                    <li>{{ $medicine }}</li>
                                                @endforeach
                                            </ul>


                                        </div>

                                    </div>
                                    <div class="col-sm-2">
                                        <h4>Time</h4>

                                        <ul>

                                            @foreach ($prescpritions->relationwithPrescption->pluck('medicine_time')->filter() as $medicine)
                                                <li> {{ $medicine }}</li>
                                            @endforeach


                                        </ul>
                                    </div>
                                    <div class="col-sm-2">
                                        <h4>Day</h4>

                                        <ul>
                                            <li>
                                                @foreach ($prescpritions->relationwithPrescption->pluck('days')->filter() as $medicine)
                                            <li> {{ $medicine }} </li>
                                @endforeach
                                </li>

                                </ul>

                            </div>
                            <div class="col-sm-2">
                                <h4> Meal</h4>
                                <ul>
                                    <li>After meal</li>
                                    <li>Cough</li>
                                </ul>

                            </div>
                            @endforeach
                        </td>
        </div>
    </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
</body>

</html>
