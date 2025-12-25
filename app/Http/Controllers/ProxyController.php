<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProxyController extends Controller
{


    public function oauthToken(Request $request)
    {
        $baseUrl = config('services.oneroster.remote_base_url'); // e.g. https://oneroster.myscuta.com
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oauthToken baseUrl=' . ($baseUrl ?? 'NULL'));

        if (! $baseUrl) {
            return response()->json([
                'message' => 'Missing OneRoster base URL. Check ONEROSTER_REMOTE_BASE_URL and config cache.',
            ], 500);
        }

        $response = Http::asForm()
            ->timeout(30)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetNewOauth2Token', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response()->json($response->json(), $response->status());
    }


//Proxy Functions for Rostering
    public function oneRosterGetAllUsers()
    {
       $baseUrl = config('services.oneroster.remote_base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');
        log::info('in  oneRosterGetAllUsers baseUrl=' . $baseUrl);


        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ident 727 ONEROSTER_REMOTE_BEARER=' . $token);

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllUsers', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ]);
        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllAcademicSessions()
    {
        $baseUrl = config('services.oneroster.remote_base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');
        log::info('in  oneRosterGetAllUsers baseUrl=' . $baseUrl);


        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllAcademicSessions', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
            ]);
        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAcademicSession()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAcademicSession', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllOrgs()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllOrgs', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetOrg()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = '00000000-0000-0000-0000-000000000002';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetOrg', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetUser()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = '9ea819f9-d1b7-48e6-a869-2742d2d5527c';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetUser', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllCourses()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllCourses', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetCourse()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = '561279a5-75a0-4f43-ad02-77c8229bb786';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetCourse', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllClasses()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllClasses', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetClass()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = '8b91e50d-4ce1-4810-8a91-2ad55c10e3c0';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetClass', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllEnrollments()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllEnrollments', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetEnrollment()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'b9421388-73fa-474c-b0f9-751a2495201c';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetEnrollment', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllGradingPeriods()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllGradingPeriods', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetGradingPeriod()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetGradingPeriod', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllTerms()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllTerms', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetTerm()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = '273765d9-7955-496c-aeeb-3e8b7cb4f5b4';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetTerm', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllSchools()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllSchools', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetSchool()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'ca6a7605-b0f7-4852-9b9a-bc8b586bf737';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetSchool', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllTeachers()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllTeachers', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetTeacher()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'ce080009-6406-4137-9abf-b88987ea317d';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetTeacher', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllStudents()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllStudents', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetStudent()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = '9ea819f9-d1b7-48e6-a869-2742d2d5527c';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetStudent', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetAllDemographics()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllDemographics', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetDemographics()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAcademicSession baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'f2bc0255-a13a-48d5-ac17-251789092850';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetDemographics', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

//Proxy Functions for Rostering

    public function oneRosterGetAllCategories()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAllCategories baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'f2bc0255-a13a-48d5-ac17-251789092850';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllCategories', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }


    public function oneRosterGetAllLineItems()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAllLineItems baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'f2bc0255-a13a-48d5-ac17-251789092850';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllLineItems', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }


    public function oneRosterGetAllResults()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAllResults baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'f2bc0255-a13a-48d5-ac17-251789092850';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllResults', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }


    public function oneRosterGetAllScoreScales()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAllScoreScales baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'f2bc0255-a13a-48d5-ac17-251789092850';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllScoreScales', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }


//Proxy Functions for Rostering

    public function oneRosterGetAllResources()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetAllResources baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);
        // The sourcedId you want to send
        $sourcedId = 'f2bc0255-a13a-48d5-ac17-251789092850';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetAllResources', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

    public function oneRosterGetResource()
    {
        $baseUrl = config('services.oneroster.base_url');
        $clientId = config('services.oneroster.client_id');
        $clientSecret = config('services.oneroster.client_secret');

        Log::info('in oneRosterGetResource baseUrl=' . $baseUrl);

        $token = config('services.oneroster.remote_bearer');
        Log::info('in oneRosterGetAllResources ONEROSTER_REMOTE_BEARER=' . $token);

        // The sourcedId you want to send
        $sourcedId = 'e443ec03-6129-43c7-a12c-6c9db31f1b4f';

        $res = Http::withToken($token)
            ->acceptJson()
            ->timeout(120)
            ->post(rtrim($baseUrl, '/') . '/api/oneRosterGetResource', [
                'sourcedId'     => $sourcedId,
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
            ]);

        return response($res->body(), $res->status())
            ->header('Content-Type', $res->header('Content-Type') ?? 'application/json');
    }

}
