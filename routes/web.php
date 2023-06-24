<?php

use App\Http\Controllers\AppointmentAssistanceContrpller;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SpecialitieController;
use App\Http\Controllers\BackhandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorDashbord;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\DoctorDetielController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TimeDurationController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\VonderssController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutContentController;


use App\Http\Controllers\Auth\AuthenticatedSessionController;



Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/doctors/{specialistId?}', [FrontendController::class, 'getDoctors'])->name('getDoctors');

Route::get('searc', [FrontendController::class, 'searchs'])->name('searc');
Route::get('autocomplete', [FrontendController::class, 'autocomplete'])->name('autocomplete')->middleware('auth');


Route::post('custom/login', [FrontendController::class, 'custom_login'])->name('custom.login');

Route::get('Doctor/patient/invoices/download/{P_id}', [DoctorDashbord::class, 'Doctor_patient_invoices_download'])->name('Doctor.patient.invoices.download')->middleware(['auth']);

Route::get('patient/medical/record/download/{id}', [PatientController::class, 'patient_medical_record_download'])->name('patient.medical.record.download');
Route::get('Doctor/patient/invoices/{P_id}', [DoctorDashbord::class, 'patient_invoices'])->name('patient.invoices');
Route::get('profile/details/{id}', [FrontendController::class, 'profile_detals'])->name('profile.details');
Route::get('patient/medical/record/{id}', [PatientController::class, 'patient_medical_record'])->name('patient.medical.record');
Route::get('patient/prescription/{id}', [PatientController::class, 'patient_prescription'])->name('patient.prescription');
Route::get('patient/prescription/download/{id}', [PatientController::class, 'patient_prescription_download'])->name('patient.prescription.download');

Route::middleware(['auth', 'verified', 'role:patient'])->group(function () {
    // Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('patient/dashboard', [PatientController::class, 'patient_dashboard'])->name('patient.dashboard');
    Route::post('profile/create', [PatientController::class, 'store'])->name('profile.store');
    Route::get('profile/details/edit/{id}', [PatientController::class, 'edit'])->name('profile.details.edit');
    Route::post('profile/details/update/{id}', [PatientController::class, 'update'])->name('profile.details.update');
    Route::get('profile/change/password', [PatientController::class, 'profile_change_password'])->name('profile.change.password');
    Route::get('patient/invoice', [PatientController::class, 'patient_invoice'])->name('patient.invoice');

//please


    Route::post('patient/medical/record/add', [PatientController::class, 'patient_medical_record_add'])->name('patient.medical.record.add');
    Route::get('patient/medical/record/edit/{id}', [PatientController::class, 'patient_medical_record_edit'])->name('patient.medical.record.edit');
    Route::post('patient/medical/record/edit/add', [PatientController::class, 'patient_medical_record_edit_add'])->name('patient.medical.record.edit.add');
    Route::get('patient/medical/record/delete/{id}', [PatientController::class, 'patient_medical_record_delete'])->name('patient.medical.record.delete');



    Route::get('patient/medical/deatiles/{id}', [PatientController::class, 'patient_medical_deatiles'])->name('patient.medical.deatiles');
    Route::post('patient/medical/deatiles/add', [PatientController::class, 'patient_medical_deatiles_add'])->name('patient.medical.deatiles.add');
    Route::get('patient/medical/deatiles/delete/{id}', [PatientController::class, 'patient_medical_deatiles_delete'])->name('patient.medical.deatiles.delete');


    Route::get('patient/review/{id}', [PatientController::class, 'patient_review'])->name('patient.review');
    Route::post('profile/review/add', [PatientController::class, 'profile_review_add'])->name('profile.review.add');


    Route::get('favourit/details', [FavouriteController::class, 'favourit'])->name('favourit.details');
    Route::get('doctor/profile/{id}', [FrontendController::class, 'doctor_profile'])->name('doctor.profile');
   Route::get('add/to/favourite/{id}', [FrontendController::class, 'add_favourite'])->name('add.favourite');

//please
   Route::get('doctor/book/now/{id}', [FrontendController::class, 'doctor_book_now'])->name('doctor.book.now');



    Route::post('add/adderess', [FrontendController::class, 'add_adderess'])->name('add.adderess');
    //prfileConter
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/change/password', [ProfileController::class, 'change_password'])->name('change.password');
    Route::post('/change/information', [ProfileController::class, 'change_information'])->name('change.information');

    Route::get('patient/appointment', [PatientController::class, 'patient_appointments'])->name('patient.appointments');
    Route::get('patient/invoices/{id}', [PatientController::class, 'patient_invoices'])->name('patient.invoices');

    //cheackoutController
    Route::post('patient/Check/out', [CheckoutController::class, 'check_out'])->name('patient.Check.out');
});


//doctor
Route::middleware(['auth', 'verified', 'role:doctor'])->group(function () {

    Route::get('doctor/dashboard', [DoctorDashbord::class, 'index'])->name('doctor.dash');
    Route::get('doctor/time/schedules', [DoctorDashbord::class, 'doctor_time_schedule'])->name('doctor.time.schedules');
    Route::get('doctor/change/password', [DoctorDashbord::class, 'doctor_change_password'])->name('doctor.change.password');
    Route::post('doctor/time/schedules/add', [DoctorDashbord::class, 'doctor_time_schedule_add'])->name('doctor.time.schedules.add');
    Route::get('doctor/patient/invoices/list', [DoctorDashbord::class, 'doctor_patient_invoices'])->name('doctor.patient.invoices.list');
    Route::get('doctor/patient/list', [DoctorDashbord::class, 'doctor_patient_list'])->name('doctor.patient.list');
    Route::get('doctor/patient/prescription/{id}', [DoctorDashbord::class, 'doctor_patient_prescription'])->name('doctor.patient.prescription');
    Route::post('doctor/patient/prescription/add', [DoctorDashbord::class, 'doctor_patient_prescription_add'])->name('doctor.patient.prescription.add');

    Route::get('doctor/patient/review', [DoctorDashbord::class, 'doctor_patient_review'])->name('doctor.patient.review');
    Route::get('doctor/patient/review/replay/{id}', [DoctorDashbord::class, 'doctor_patient_review_replay'])->name('patient.review.replay');
    Route::post('doctor/patient/review/replay/add', [DoctorDashbord::class, 'doctor_patient_review_replay_add'])->name('patient.review.replay.add');
    //TimeDurationController
    Route::post('doctor/time/schedules/duartion', [TimeDurationController::class, 'index'])->name('doctor.time.schedules.duartion');
    Route::get('doctor/time/schedules/added', [TimeDurationController::class, 'show'])->name('doctor.time.schedules.added');

  //prfileConter
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::post('/change/password', [ProfileController::class, 'change_password'])->name('change.password');
  Route::post('/change/information', [ProfileController::class, 'change_information'])->name('change.information');
  Route::get('doctor/patient/prescription/view/{id}', [DoctorDashbord::class, 'patient_prescription_view'])->name('doctor.patient.prescription.view');
    // Route::get('patient/medical/record/{id}', [PatientController::class, 'patient_medical_record'])->name('patient.medical.record');

    Route::get('doctor/time/schedules/edit/{id}', [DoctorDashbord::class, 'doctor_time_schedule_edit'])->name('doctor.time.schedules.edit');
    Route::post('doctor/time/schedules/changes/{id}', [DoctorDashbord::class, 'doctor_time_schedule_changes'])->name('doctor.time.schedules.changes');
    Route::get('doctor/delete/schedules/{id}', [DoctorDashbord::class, 'doctor_delete_schedules'])->name('doctor.delete.schedules');
});



// For admins only
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('/dashboard', [BackhandController::class, 'dashboard'])->name('dashboard');

    Route::get('/admin/patient/reviews/delete/{review_id}', [BackhandController::class, 'patient_reviews_delete'])->name('admin.patient.reviews.delete');
    Route::get('/admin/patient/reviews', [BackhandController::class, 'patient_reviews'])->name('admin.patient.reviews');
    Route::get('/admin/tranjection', [BackhandController::class, 'tranjection'])->name('admin.tranjection');
    Route::get('/admin/tranjection/delete/{t_id}', [BackhandController::class, 'tranjection_delete'])->name('admin.tranjection.delete');
    Route::get('/admin/patient_list', [BackhandController::class, 'patient_list'])->name('admin.patient_list');
    Route::get('/admin/appointment_list', [BackhandController::class, 'appointment_list'])->name('admin.appointment_list');
    Route::get('/search', [BackhandController::class, 'search'])->name('search');
    Route::get('/autocomplete', [BackhandController::class, 'autocomplete'])->name('autocomplete');
    //spelistContr0ller
    Route::get('Specialitie', [SpecialitieController::class, 'special'])->name('specialitie');
    // Route::get('Add',[SpecialitieController::class,'add'])->name('add');
    Route::get('special/update/{special_id}', [SpecialitieController::class, 'edit']);
    Route::post('supdate/special_update/{spec_id}', [SpecialitieController::class, 'Updates']);
    Route::get('special/delete/{special_id}', [SpecialitieController::class, 'delete']);
    Route::post('special/insert', [SpecialitieController::class, 'insert'])->name('insert');
//aboutcontroller

    Route::get('/about', [AboutContentController::class, 'index'])->name('about.index');
    Route::get('/about/show', [AboutContentController::class, 'show'])->name('about.show');
    Route::get('/about/{id}/edit', [AboutContentController::class, 'edit'])->name('about.edit');
    Route::post('/about/{id}', [AboutContentController::class, 'update'])->name('about.update');
    Route::delete('/about/{id}', [AboutContentController::class, 'destroy'])->name('about.destroy');
    Route::get('/about/create', [AboutContentController::class, 'create'])->name('about.create');
    Route::post('/about', [AboutContentController::class, 'store'])->name('about.store');

 //prfileConter
 Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
 Route::post('/change/password', [ProfileController::class, 'change_password'])->name('change.password');
 Route::post('/change/information', [ProfileController::class, 'change_information'])->name('change.information');
//userController
Route::get('user/role', [UsersController::class, 'users'])->name('user.role');
Route::get('add/user', [UsersController::class, 'add_user'])->name('add.user');
Route::post('user/insert', [UsersController::class, 'insert'])->name('user.insert');
Route::get('user/role/vendor/delete/{id}', [UsersController::class, 'vendor_delete'])->name('user.role.vendor.delete');
});




//For vendor only
Route::middleware(['auth', 'verified', 'role:vendor'])->group(function () {
//Vondores
Route::get('vendor/dashboard', [VonderssController::class, 'vondor_dashboard'])->name('vendor.dashboard');
Route::get('vendor/patient/list', [VonderssController::class, 'patient_list'])->name('vendor.patient.list');

Route::get('vendor/doctor/list', [VonderssController::class, 'doctor_list'])->name('vendor.doctor.list');
Route::get('vendor/appointment/list', [VonderssController::class, 'patient_appointment_list'])->name('vendor.patient.appointment.list');
Route::get('vendor/appointment/list/delete/{t_id}', [VonderssController::class, 'patient_appointment_list_delete'])->name('vendor.patient.appointment.list_delete');
Route::get('vendor/reviews/list', [VonderssController::class, 'patient_reviews_list'])->name('vendor.patient.reviews.list');
Route::get('vendor/tranjection/list', [VonderssController::class, 'patient_tranjection_list'])->name('vendor.tranjection.list');

//userController
Route::get('user/role/doctor/delete/{id}', [VonderssController::class, 'doctor_delete'])->name('user.role.doctor.delete');
});





Route::get('user/role', [UsersController::class, 'users'])->name('user.role');
 Route::get('add/user', [UsersController::class, 'add_user'])->name('add.user');
 Route::post('user/insert', [UsersController::class, 'insert'])->name('user.insert');

//   //prfileConter
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::post('/change/password', [ProfileController::class, 'change_password'])->name('change.password');
  Route::post('/change/information', [ProfileController::class, 'change_information'])->name('change.information');

Route::resource('doctorDetailes', DoctorDetielController::class);

//DoctorController
Route::resource('doctor', DoctorController::class);
Route::post('add/user', [UsersController::class, 'insert'])->name('doctor.regi');

// Route::get('booking/profile/{id}', [FrontendController::class, 'doctor_profile'])->name('doctor.profile');
Route::get('doctor/profile/{id}', [FrontendController::class, 'doctor_profile'])->name('doctor.profile');

Route::post('add/adderess', [FrontendController::class, 'add_adderess'])->name('add.adderess');


// For appoimentr only
Route::middleware(['auth', 'verified', 'role:appointment_assistance'])->group(function () {
    Route::get('Appointment/Assistance/dashboard', [AppointmentAssistanceContrpller::class, 'index'])->name('Appointment.Assistance.dashboard');
    Route::get('Appointment/Assistance/patient', [AppointmentAssistanceContrpller::class, 'patient_list'])->name('Appointment.Assistance.patient');
    Route::get('Appointment/Assistance/doctor', [AppointmentAssistanceContrpller::class, 'doctor_list'])->name('Appointment.Assistance.doctor');
    Route::get('Appointment/Assistance/Appointment', [AppointmentAssistanceContrpller::class, 'Appointment_list'])->name('Appointment.Assistance.Appointment');
    Route::get('vendor/patient/medical/report/{id}', [VonderssController::class, 'patient_medical_report'])->name('vendor.patient.medical.report');
     Route::post('vendor/patient/medical/report/add', [VonderssController::class, 'patient_medical_report_add'])->name('vendor.patient.medical.report.add');
  //  Route::get('vendor/patient/medical/report/{id}', [VonderssController::class, 'patient_medical_report'])->name('vendor.patient.medical.report');
    Route::get('Appointment/Assistance/Review', [AppointmentAssistanceContrpller::class, 'Review'])->name('Appointment.Assistance.Review');
});



//googleController
Route::get('google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('google/callback', [GoogleController::class, 'callback'])->name('google.callback');






// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::get('/successs', [SslCommerzPaymentController::class, 'successs'])->name('succ');
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

require __DIR__ . '/auth.php';
