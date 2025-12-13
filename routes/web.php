<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProxyController;
use Illuminate\Auth\Middleware\Authenticate;

Route::post('/proxy/oauth-token', [ProxyController::class, 'oauthToken'])
    ->withoutMiddleware([Authenticate::class])
    ->name('proxy.oauthToken');


// Routes for Rostering
Route::post('/proxy/oneRosterGetAllUsers', [ProxyController::class, 'oneRosterGetAllUsers'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllAcademicSessions', [ProxyController::class, 'oneRosterGetAllAcademicSessions'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAcademicSession', [ProxyController::class, 'oneRosterGetAcademicSession'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllOrgs', [ProxyController::class, 'oneRosterGetAllOrgs'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetOrg', [ProxyController::class, 'oneRosterGetOrg'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetUser', [ProxyController::class, 'oneRosterGetUser'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllCourses', [ProxyController::class, 'oneRosterGetAllCourses'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetCourse', [ProxyController::class, 'oneRosterGetCourse'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllClasses', [ProxyController::class, 'oneRosterGetAllClasses'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetClass', [ProxyController::class, 'oneRosterGetClass'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllEnrollments', [ProxyController::class, 'oneRosterGetAllEnrollments'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetEnrollment', [ProxyController::class, 'oneRosterGetEnrollment'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllGradingPeriods', [ProxyController::class, 'oneRosterGetAllGradingPeriods'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetGradingPeriod', [ProxyController::class, 'oneRosterGetGradingPeriod'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllTerms', [ProxyController::class, 'oneRosterGetAllTerms'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetTerm', [ProxyController::class, 'oneRosterGetTerm'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllSchools', [ProxyController::class, 'oneRosterGetAllSchools'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetSchool', [ProxyController::class, 'oneRosterGetSchool'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllTeachers', [ProxyController::class, 'oneRosterGetAllTeachers'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetTeacher', [ProxyController::class, 'oneRosterGetTeacher'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllStudents', [ProxyController::class, 'oneRosterGetAllStudents'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetStudent', [ProxyController::class, 'oneRosterGetStudent'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllDemographics', [ProxyController::class, 'oneRosterGetAllDemographics'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetDemographics', [ProxyController::class, 'oneRosterGetDemographics'])
    ->withoutMiddleware([Authenticate::class]);

// Routes for Gradebook

Route::post('/proxy/oneRosterGetAllCategories', [ProxyController::class, 'oneRosterGetAllCategories'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllLineItems', [ProxyController::class, 'oneRosterGetAllLineItems'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllResults', [ProxyController::class, 'oneRosterGetAllResults'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetAllScoreScales', [ProxyController::class, 'oneRosterGetAllScoreScales'])
    ->withoutMiddleware([Authenticate::class]);



// Routes for Resources


Route::post('/proxy/oneRosterGetAllResources', [ProxyController::class, 'oneRosterGetAllResources'])
    ->withoutMiddleware([Authenticate::class]);

Route::post('/proxy/oneRosterGetResource', [ProxyController::class, 'oneRosterGetResource'])
    ->withoutMiddleware([Authenticate::class]);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/api-dashboard', function () {
    return view('api-dashboard');
});


Route::get('/debug-mw', function () {
    return response()->json([
        'route_middleware' => Route::current()?->gatherMiddleware(),
    ]);
});
