{{-- resources/views/api-dashboard.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Dashboard</title>
{{--    <script src="https://code.jquery.com/jquery-3.7.1.min.js"--}}
{{--            crossorigin="anonymous"></script>--}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

</head>
<body class="bg-gray-100 min-h-screen p-8">

<h1 class="text-2xl font-semibold mb-6">OneRoster API Dashboard</h1>

<div class="grid grid-cols-5 gap-4">
    @php
        $buttons = [
            'Retrieve OAuth2 Token',

            'getAllUsers',
            'getAllAcademicSessions',
            'getAcademicSession',
            'getAllOrgs',
            'getOrg',

            'getUser',
            'getAllCourses',
            'getCourse',
            'getAllClasses',
            'getClass',

            'getAllEnrollments',
            'getEnrollment',
            'getAllGradingPeriods',
            'getGradingPeriod',
            'getAllTerms',

            'getTerm',
            'getAllSchools',
            'getSchool',
            'getAllTeachers',
            'getTeacher',

            'getAllStudents',
            'getStudent',
            'getAllDemographics',
            'getDemographics',
        ];
    @endphp

    @foreach ($buttons as $button)
        <button
            class="bg-white border border-gray-300 rounded-lg p-4 text-sm font-medium text-gray-700 hover:bg-blue-600 hover:text-white transition shadow-sm"
        >
            {{ $button }}
        </button>
    @endforeach
</div>

</body>
</html>
