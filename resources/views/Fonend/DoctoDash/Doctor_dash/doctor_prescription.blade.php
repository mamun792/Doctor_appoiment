<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLPCMS</title>

    <link rel="stylesheet" href="{{ asset('frontend_assets/css/pre.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.0.1/mustache.min.js"
        integrity="sha256-srhz/t0GOrmVGZryG24MVDyFDYZpvUH2+dnJ8FbpGi0=" crossorigin="anonymous"></script>
</head>

<body>
    <form action="{{ route('doctor.patient.prescription.add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="p_id" value="{{ $p_id }}">
        <div class="wrapper">
            <div class="prescription_form">



                <table class="prescription" border="1" style="width: 60%">
                    <tbody>
                        <tr height="15%">
                            <td colspan="2">
                                <div class="header">
                                    <div class="logo">
                                        <img
                                            src="https://seeklogo.com/images/H/hospital-clinic-plus-logo-7916383C7A-seeklogo.com.png" />



                                    </div>

                                    <div class="credentials">
                                        @foreach ($doctor as $doctors)
                                            <h4>{{ $doctors->fname }} {{ $doctors->lname }}</h4>
                                            <p>{{ $doctors->hospital_name }}</p>
                                            <small>{{ $doctors->hospital_address }}</small>
                                            <br />
                                            <small>Mb. {{ $doctors->phone_number }}</small>
                                        @endforeach


                                        @if (session('suc'))
                                            <div class="alert alert-success">
                                                {{ session('suc') }}
                                            </div>
                                        @endif


                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%">
                                <div class="desease_details">
                                    <div class="symptoms">
                                        <h4 class="d-header">Symptoms</h4>
                                        <div class="form-group">

                                            <textarea class="form-control" name="Symptoms" rows="5"></textarea>
                                        </div>

                                    </div>
                                    <div class="tests">
                                        <h4 class="d-header">Tests</h4>
                                        <div class="form-group">

                                            <textarea class="form-control" name="tests" rows="7"></textarea>
                                        </div>
                                    </div>
                                    <div class="advice">
                                        <h4 class="d-header">Advice</h4>
                                        <div class="form-group">

                                            <textarea class="form-control" name="Advice" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td width="60%" valign="top">
                                <span style="font-size: 3em;">R<sub>x</sub></span>
                                <hr />
                                <div class="medicine">
                                    <section class="med_list">
                                    </section>
                                    <div id="add_med" data-toggle="tooltip" data-placement="right"
                                        title="Click anywhere on the blank space to add more.">Click
                                        to add...</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>



        <div class="button_group">
            <button class="issue_prescription btn btn-success">Issue</button>
            <!-- <button class="pdf_prescription btn btn-danger">PDF</button> -->
        </div>

    </form>
    <script id="new_medicine" type="text/template">
    <div class="med">


          &#9899; <input class="med_name" name="medicine_name[]"
          placeholder="Enter medicine name"/>
             <br>
        <label for="cars">Medicine Time</label>
            <select class="p_t" name="medicine_time[]">
                <option value="1+1+1" selected>1+1+1</option>
                <option value="1+0+1">1+0+1</option>
                <option value="0+1+1">1+1+1</option>
                <option value="1+0+0">1+1+1</option>
                <option value="0+0+1">1+1+1</option>
                <option value="1+1+1+1">1+1+1+1</option>
              </select>
<br>
              <label for="cars">Medicine Meal</label>
              <select class="p_t" name="meal[]">
                <option value="1" selected>After Meal</option>
                <option value="2">Before Meal</option>
                <option value="3">Take any time</option>
            </select>
<br>
            <label for="cars">Medicine day</label>
            <input class="med_period p_t" type="text" name="days[]"
            placeholder=" days/weeks..." />


<div>
    <div class="del_action">
        <button data-med_id="@{{med_id}}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"
                aria-hidden="true"></i></button>
    </div>
        <hr />
    </div>
</script>

    <script>
        $(document).ready(function() {
            Date.prototype.calcDate = function(days) {
                let date = new Date(this.valueOf());
                date.setDate(date.getDate() + days);
                return `(Untill ${date.getUTCDate()}-${date.getUTCMonth() +
			1}-${date.getUTCFullYear()})`;
            };
            let timeout;

            function snackSaving() {
                let snack = document.getElementById("snacking");
                snack.className = "show";
                timeout = setTimeout(() => {
                    alert('ERR: Conection timeout.')
                }, 8000);
            }

            function snackSaved() {
                clearTimeout(timeout);
                let snack = document.getElementById("snacking");
                snack.className = snack.className.replace("show", "");
                let snacked = document.getElementById("snacked");
                snacked.className = "show";
                setTimeout(function() {
                    snacked.className = snacked.className.replace("show", "");
                }, 1500);
            }
            $("[data-toggle=tooltip]").tooltip("show");
            setTimeout(function() {
                $("[data-toggle=tooltip]").tooltip("hide");
            }, 5000); //hide tooltips after 5sec
            $(document).keyup(function() {
                $("[data-toggle=tooltip]").tooltip("hide");
            }); //hide tooltip while typing
            $(document).on("focusin keypress", ".med_name", function(e) {
                let x = $(this).siblings("div.med_name_action");
                if (e.type == "focusin") {
                    x.css("display", "block");
                }
                if (e.type == "keypress") {
                    if (e.keyCode == 13) x.children("button.save").click();
                }
            });

            $(document).on("click", ".cancel-btn", function() {
                $(this)
                    .parent()
                    .css("display", "none"); //hides save/cancel btn
            });
            $(document).on("click", ".med_name_action button.save", function() {
                $(this)
                    .parent()
                    .css("display", "none");
                $(".sc_time").removeClass("folded");
            });
            $(".med_name").keypress(function(e) {
                if (e.which == 13) {
                    $("#symp_save").click();
                }
            });

            $(document).on("mousedown", ".sc", function(e) {
                let x = $(this).siblings("div.med_when_action");
                x.css("display", "block");
            });
            $(document).on("click", ".med_when_action button.save", function() {
                $(this)
                    .parent()
                    .css("display", "none");
                $(".select").removeClass("folded");
            });
            $("select.sc").change(function() {
                let x = $(this).siblings("div.med_when_action");
                x.css("display", "none");
            });

            $(document).on("mousedown", ".meal", function() {
                let x = $(this).siblings("div.med_meal_action");
                x.css("display", "block");
            });
            $(document).on("click", ".med_meal_action button.save", function() {
                $(this)
                    .parent()
                    .css("display", "none");
                $(".period").removeClass("folded");
            });

            $(document).on("focusin keypress", ".med_period", function(e) {
                let x = $(this).siblings("div.med_period_action");
                if (e.type == "focusin") {
                    x.css("display", "block");
                }
                if (e.type == "keypress") {
                    if (e.keyCode == 13) x.children("button.save").click();
                }
            });
            $(document).on("click", ".med_period_action button.save", function() {
                $(this)
                    .parent()
                    .css("display", "none");
            });
            $(document).on("keyup", ".med_period", function() {
                let period = $(this).val();
                let num = +period.match(/\d+/g)[0];
                let type = period.match(/\b(\w)/g)[1];
                let days = null;
                if (type == "d") days = num;
                else if (type == "w") days = num * 7;
                else if (type == "m") days = num * 30;
                else if (type == "y") days = num * 365;
                let span = $(this).siblings("span.date");
                if (days) {
                    let date = new Date().calcDate(days);
                    span.html(date);
                } else {
                    span.html("(Invalid time period)");
                }
            });

            $(".sc").keyup(function(e) {
                if (isNaN(e.key)) return;
                let el = $(this);
                el = el
                    .val()
                    .split("-")
                    .join("");
                let finalVal = el.match(/.{1,1}/g).join("-");
                $(this).val(finalVal);
            });

            function initLi(e) {
                let txt = e.target.innerHTML;
                if (!txt.includes("<li>")) {
                    let el = "<li></li>";
                    $(this).append(el);
                }
            }
            $(".symptoms ul").focusin(initLi);
            $(".symptoms ul").keyup(function(e) {
                let fl = $(this)
                    .children()
                    .first();
                let el = `<li>${e.target.textContent}</li>`;
                if (fl.text().length < 1) {
                    $(this).html("");
                    $(this).append(el);
                }
            });
            $("#symp_save").click(function() {
                $(".symp_action").css("display", "none");
            });

            $(".tests ul").focusin(initLi);
            $(".tests ul").keyup(function() {
                let fl = $(this)
                    .children()
                    .first();
                let el = "<li></li>";
                if (fl.text().length < 1) {
                    $(this).html("");
                    $(this).append(el);
                }
            });
            $("#test_save").click(function() {
                $(".test_action").css("display", "none");
            });

            $(".symptoms ul").focusin(function() {
                $(".symp_action").css("display", "block");
            });

            $(".tests ul").focusin(function() {
                $(".test_action").css("display", "block");
            });

            $(".advice p").focusin(function() {
                $(".adv_action").css("display", "block");
            });

            $("#adv_save").click(function() {
                $(".adv_action").css("display", "none");
            });

            $(document).on("click", ".delete", function() {
                let parent = $(this).closest(".med");
                parent.remove();
            });

            let med_id = 1;
            $("#add_med").click(function() {
                med_id++;
                let sourceTemplate = $("#new_medicine").html();
                Mustache.parse(sourceTemplate);
                let sourceHTML = Mustache.render(sourceTemplate, {
                    med_id
                });
                let medicine = $(".med_list");
                medicine.append(sourceHTML);
            })
        });
    </script>
</body>

</html>
