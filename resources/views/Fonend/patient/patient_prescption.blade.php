<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('frontend_assets/css/pre.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">


</head>

<body>

    <div class="wrapper">
        <div class="prescription_form">

            <table class="prescription" style="width: 70%">
                <tbody>
                    <tr height="15%">
                        <td colspan="2">
                            <div class="header">
                                <div class="logo">
                                    <img
                                        src="https://seeklogo.com/images/H/hospital-clinic-plus-logo-7916383C7A-seeklogo.com.png" />
                                </div>
                                <div class="credentials">
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
                                </div>
                            </div>
                        </td>
                    </tr>




                    <tr>
                        <td width="40%">
                            <div class="desease_details">
                                <div class="symptoms">
                                    <h4 class="d-header">Symptoms</h4>
                                    {{ $prescprition[0]->Symptoms }}
                                </div>
                                <div class="tests">
                                    <h4 class="d-header">Tests</h4>
                                    {{ $prescprition[0]->Tests }}

                                </div>
                                <div class="advice">
                                    <h4 class="d-header">Advice</h4>
                                    {{ $prescprition[0]->Advice }}
                                </div>
                            </div>
                        </td>
                        <td width="60%" valign="top">
                            <span style="font-size: 3em;">R<sub>x</sub></span>
                            <hr />

                            {{-- @endforeach --}}

                            <div>
                                <div class="row">
                                    @foreach ($prescprition as $prescpritions)
                                        <div class="col-sm-5">

                                            <h4>Medicine Name</h4>
                                            <span>
                                                @foreach ($prescpritions->relationwithPrescption->pluck('medicine_name')->filter() as $medicine)
                                                    {{ $medicine }}<br>
                                                @endforeach
                                            </span>
                                        </div>
                                        <div class="col-sm-2">
                                            <h4> Time</h4>

                                            <span>
                                                @foreach ($prescpritions->relationwithPrescption->pluck('medicine_time')->filter() as $medicine)
                                                    {{ $medicine }}<br>
                                                @endforeach
                                            </span>
                                        </div>
                                        <div class="col-sm-2">
                                            <h4>Day</h4>
                                            <p>
                                                @foreach ($prescpritions->relationwithPrescption->pluck('days')->filter() as $medicine)
                                                    {{ $medicine }}<br>
                                                @endforeach
                                            </p>
                                        </div>
                                        <div class="col-sm-2">
                                            <h4>Meal</h4>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>






</body>

</html>
