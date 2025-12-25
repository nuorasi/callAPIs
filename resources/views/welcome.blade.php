{{-- resources/views/api-dashboard.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OneRoster/SCUTA API Dashboard</title>

    <style>
        body { font-family: Arial, sans-serif; background:#f3f4f6; padding:32px; }
        h1 { margin-bottom:16px; }
        .grid { display:grid; grid-template-columns:repeat(5, 1fr); gap:12px; }

        button {
            background:#fff; border:1px solid #d1d5db; border-radius:10px;
            padding:14px; cursor:pointer; font-weight:600; color:#374151;
        }
        button:hover { background:#2563eb; color:#fff; border-color:#2563eb; }

        .api-btn { position: relative; }
        .status-icon {
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 24px;
            display: none;
        }
        .status-success { color: #22c55e; } /* green */

        .status-fail {
            color: #c28f05;
            margin-right: 15px; /* moves left without transform */
        }

        .status-icon.spinner {
            width: 14px;
            height: 14px;
            border: 2px solid #d1d5db;
            border-top-color: #2563eb;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: block;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<h1 style="margin-top: -30px;">OneRoster/SCUTA API Dashboard</h1>

<!--
######
#     #  ####   ####  ##### ###### #####  # #    #  ####
#     # #    # #        #   #      #    # # ##   # #    #
######  #    #  ####    #   #####  #    # # # #  # #
#   #   #    #      #   #   #      #####  # #  # # #  ###
#    #  #    # #    #   #   #      #   #  # #   ## #    #
#     #  ####   ####    #   ###### #    # # #    #  ####

-->
<div id="dashboard-container" style="max-width:1200px; margin:0 auto;">
<h2 style="text-align:right; color:#777777;">Rostering</h2>
    <button onclick="window.open('https://certification.imsglobal.org/certification/or12cts/launch.html', '_blank')"
            style="margin-bottom: 50px;">
        Initiate a OneRoster Rostering Certification Session
    </button>

    <div class="grid">
        @php
            $buttons = [
             'Rostering oAuth2 Token',
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
                type="button"
                class="api-btn"
                onclick="handleAction('{{ $button }}', this)"
            >
                {{ $button }}
                <span class="status-icon">✔</span>
            </button>
        @endforeach
    </div>

    <div id="terminal"
         style="
            margin-top:20px;
            background:#0b0f14;
            color:#22c55e;
            border:1px solid #1f2937;
            border-radius:10px;
            padding:14px;
            height:420px;
            overflow:auto;

            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
            font-size:17px;
            line-height:1.45;
            letter-spacing:0.01em;

            white-space:pre-wrap;
            word-break:break-word;
            tab-size:2;

            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
         "
    >

    </div>
</div>
<hr style="border:0; border-top:1px solid #aaaaaa; margin:24px 0; margin-top:50px">
<!--
  #####
 #     # #####    ##   #####  ###### #####   ####   ####  #    #
 #       #    #  #  #  #    # #      #    # #    # #    # #   #
 #  #### #    # #    # #    # #####  #####  #    # #    # ####
 #     # #####  ###### #    # #      #    # #    # #    # #  #
 #     # #   #  #    # #    # #      #    # #    # #    # #   #
  #####  #    # #    # #####  ###### #####   ####   ####  #    #



-->
<div id="dashboard-container-gradebook" style="max-width:1200px; margin:0 auto; margin-top:50px;">
    <h2 style="text-align:right; color:#777777;">Gradebook</h2>
    <button onclick="window.open('https://certification.imsglobal.org/certification/or12cts/launch.html', '_blank')"
            style="margin-bottom: 50px;">
        Initiate a OneRoster Gradebook Certification Session
    </button>

    <div class="grid">
        <button onclick="handleAction('gbOauthToken', this)">
            Gradebook oAuth2 Token
        </button>
        @php
            $gbButtons = [
            'getAllCategories',
             'getAllLineItems',
             'getAllResults',
             'getAllScoreScales',
         ];
        @endphp

        @foreach ($gbButtons as $gbButton)
            <button
                type="button"
                class="api-btn"
                onclick="handleAction('{{ $gbButton }}', this)"
            >
                {{ $gbButton }}
                <span class="status-icon">✔</span>
            </button>
        @endforeach
    </div>

    <div id="gbTerminal"
         style="
            margin-top:20px;
            background:#0b0f14;
            color:#22c55e;
            border:1px solid #1f2937;
            border-radius:10px;
            padding:14px;
            height:420px;
            overflow:auto;

            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
            font-size:17px;
            line-height:1.45;
            letter-spacing:0.01em;

            white-space:pre-wrap;
            word-break:break-word;
            tab-size:2;

            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
         "
    >

    </div>
</div>
<hr style="border:0; border-top:1px solid #aaaaaa; margin:24px 0; margin-top:50px">

<!--
 ######
 #     # ######  ####   ####  #    # #####   ####  ######  ####
 #     # #      #      #    # #    # #    # #    # #      #
 ######  #####   ####  #    # #    # #    # #      #####   ####
 #   #   #           # #    # #    # #####  #      #           #
 #    #  #      #    # #    # #    # #   #  #    # #      #    #
 #     # ######  ####   ####   ####  #    #  ####  ######  ####


-->
<div id="dashboard-container-resources" style="max-width:1200px; margin:0 auto; margin-top:50px;">
    <h3 style="text-align:right; color:#777777;">Resources</h3>
    <button onclick="window.open('https://certification.imsglobal.org/certification/or12cts/launch.html', '_blank')"
            style="margin-bottom: 50px;">
        Initiate a OneRoster Resources Certification Session
    </button>

    <div class="grid">
        <button onclick="handleAction('reOauthToken', this)">
            Resources oAuth2 Token
        </button>
        @php
            $buttons = [

             'getAllResources',
             'getResource',


         ];
        @endphp

        @foreach ($buttons as $button)
            <button
                type="button"
                class="api-btn"
                onclick="handleAction('{{ $button }}', this)"
            >
                {{ $button }}
                <span class="status-icon">✔</span>
            </button>
        @endforeach
    </div>

    <div id="reTerminal"
         style="
            margin-top:20px;
            background:#0b0f14;
            color:#22c55e;
            border:1px solid #1f2937;
            border-radius:10px;
            padding:14px;
            height:420px;
            overflow:auto;

            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
            font-size:17px;
            line-height:1.45;
            letter-spacing:0.01em;

            white-space:pre-wrap;
            word-break:break-word;
            tab-size:2;

            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
         "
    >

    </div>
</div>
    <script>
        // ---------- Status helpers ----------


        function setButtonSuccess(btn) {
            if (!btn) return;
            const icon = btn.querySelector('.status-icon');
            if (!icon) return;

            icon.className = 'status-icon status-success';
            icon.textContent = '✔';
            icon.style.display = 'block';
        }

        function setButtonFail(btn) {
            if (!btn) return;
            const icon = btn.querySelector('.status-icon');
            if (!icon) return;

            icon.className = 'status-icon status-fail';
            icon.textContent = '!';
            icon.style.display = 'block';
        }




        // ---------- Spinner helpers ----------
        function setButtonLoading(btn) {
        if (!btn) return;
        const icon = btn.querySelector('.status-icon');
        if (!icon) return;

        icon.textContent = '';
        icon.style.removeProperty('width');
        icon.style.removeProperty('height');
        icon.style.removeProperty('border');
        icon.style.removeProperty('border-top-color');
        icon.style.removeProperty('border-radius');

        icon.className = 'status-icon spinner';
        icon.style.display = 'block';
        }

        function clearButtonStatus(btn) {
            if (!btn) return;
            const icon = btn.querySelector('.status-icon');
            if (!icon) return;

            icon.style.display = 'none';
            icon.className = 'status-icon';
            icon.textContent = '';
        }

        // ---------- Terminal helpers ----------
        function termEl() { return document.getElementById('terminal'); }
        function termClear() { termEl().textContent = ''; }

        function gbTermEl() { return document.getElementById('gbTerminal'); }
        function gbTermClear() { gbTermEl().textContent = ''; }

        function reTermEl() { return document.getElementById('reTerminal'); }
        function reTermClear() { reTermEl().textContent = ''; }

        function termWrite(line, color = '#22c55e') {
            const t = termEl();
            const span = document.createElement('span');
            span.style.color = color;
            span.textContent = line + "\n";
            t.appendChild(span);
            t.scrollTop = t.scrollHeight;
        }

        function termWriteItalic(text) {
            const t = termEl();
            const em = document.createElement('em');
            em.textContent = text + "\n";
            t.appendChild(em);
            t.scrollTop = t.scrollHeight;
        }

        function termWriteJson(obj) {
            termWrite(JSON.stringify(obj, null, 2));
        }
        //Gradebook

        function gbTermWrite(line, color = '#22c55e') {
            const t = gbTermEl();
            const span = document.createElement('span');
            span.style.color = color;
            span.textContent = line + "\n";
            t.appendChild(span);
            t.scrollTop = t.scrollHeight;
        }

        function gbTermWriteItalic(text) {
            const t = gbTermEl();
            const em = document.createElement('em');
            em.textContent = text + "\n";
            t.appendChild(em);
            t.scrollTop = t.scrollHeight;
        }

        function gbTermWriteJson(obj) {
            gbTermWrite(JSON.stringify(obj, null, 2));
        }
        // Resources

        function reTermWrite(line, color = '#22c55e') {
            const t = reTermEl();
            const span = document.createElement('span');
            span.style.color = color;
            span.textContent = line + "\n";
            t.appendChild(span);
            t.scrollTop = t.scrollHeight;
        }

        function reTermWriteItalic(text) {
            const t = reTermEl();
            const em = document.createElement('em');
            em.textContent = text + "\n";
            t.appendChild(em);
            t.scrollTop = t.scrollHeight;
        }

        function reTermWriteJson(obj) {
            reTermWrite(JSON.stringify(obj, null, 2));
        }
        // ---------- Button router ----------/
      async function handleAction(action, btn) {
            console.log('Button clicked:', action);
            termClear();
            gbTermClear();
            reTermClear();
            clearButtonStatus(btn)
            setButtonLoading(btn);

            switch (action) {

                // Rostering Buttons
                case 'Rostering oAuth2 Token':
                    await retrieveOAuth2Token(btn);
                    break;

                case 'getAllUsers':
                    await getAllUsers(btn);
                    break;

                case 'getAllAcademicSessions':
                    await getAllAcademicSessions(btn);
                    break;

                case 'getAcademicSession':
                    await getAcademicSession(btn);
                    break;


                case 'getAllOrgs':
                    await getAllOrgs(btn);
                    break;

                case 'getOrg':
                    await getOrg(btn);
                    break;

                case 'getUser':
                    await getUser(btn);
                    break;

                case 'getAllCourses':
                    await  getAllCourses(btn);
                    break;

                case 'getCourse':
                    await getCourse(btn);
                    break;

                case 'getAllClasses':
                    await getAllClasses(btn);
                    break;

                case 'getClass':
                    await getClass(btn);
                    break;

                case 'getAllEnrollments':
                    await getAllEnrollments(btn);
                    break;

                case 'getEnrollment':
                    await getEnrollment(btn);
                    break;

                case 'getAllGradingPeriods':
                    await getAllGradingPeriods(btn);
                    break;

                case 'getGradingPeriod':
                    await getGradingPeriod(btn);
                    break;

                case 'getAllTerms':
                    await getAllTerms(btn);
                    break;

                case 'getTerm':
                    await getTerm(btn);
                    break;

                case 'getAllSchools':
                    await getAllSchools(btn);
                    break;

                case 'getSchool':
                    await getSchool(btn);
                    break;

                case 'getAllTeachers':
                    await getAllTeachers(btn);
                    break;

                case 'getTeacher':
                    await getTeacher(btn);
                    break;

                case 'getAllStudents':
                    await getAllStudents(btn);
                    break;

                case 'getStudent':
                    await getStudent(btn);
                    break;

                case 'getAllDemographics':
                    await  getAllDemographics(btn);
                    break;

                case 'getDemographics':
                    await getDemographics(btn);
                    break;

                // Gradebook Buttons


                case 'getAllCategories':
                    await getAllCategories(btn);
                    break;

                case 'getAllLineItems':
                    await getAllLineItems(btn);
                    break;

                case 'getAllResults':
                    await  getAllResults(btn);
                    break;

                case 'getAllScoreScales':
                    await getAllScoreScales(btn);
                    break;
                // Resource Buttons


                case 'getAllResources':
                    await getAllResources(btn);
                    break;

                case 'getResource':
                    await getResource(btn);
                    break;

///general handler
                case 'gbOauthToken':
                    gbRetrieveOAuth2Token(btn);
                    break;

                case 'reOauthToken':
                    reRetrieveOAuth2Token(btn);
                    break;

                default:
                    alert('No handler defined for ' + action);
            }
        }

        // ---------- API functions for Rostering ----------
        async function retrieveOAuth2Token(btn) {
            termWrite('Requesting oAuth2 token via Laravel proxy...');

            try {
                const res = await fetch('/proxy/oauth-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({})
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (err) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (err?.message || err));
            }
        }


        async function getAllUsers(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllUsers');
            termWriteItalic('This API typically takes <20 seconds...');

            try {
                const res = await fetch('/proxy/oneRosterGetAllUsers', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({})
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }
        async function getAllAcademicSessions(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllAcademicSessions');

          //  termWriteItalic('This API typically takes <20 seconds...');

            try {
                const res = await fetch('/proxy/oneRosterGetAllAcademicSessions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({})
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }




        async function getAcademicSession(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAcademicSession');
            //  termWriteItalic('This API typically takes <20 seconds...');
            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAcademicSession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async  function getAllOrgs(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllOrgs');
            // termWriteItalic('This API typically takes <20 seconds...');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllOrgs', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getOrg(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetOrg');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetOrg', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }

        }

        async function getUser(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetUser');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetUser', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getAllCourses(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllCourses');
            //  termWriteItalic('This API typically takes <20 seconds...');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllCourses', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getCourse(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetCourse');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetCourse', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getAllClasses(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllClasses');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllClasses', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getClass(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetClass');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetClass', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getAllEnrollments(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllEnrollments');
            termWriteItalic('This API typically takes <8 seconds...');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllEnrollments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getEnrollment(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetEnrollment');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetEnrollment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getAllGradingPeriods(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllGradingPeriods');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllGradingPeriods', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getGradingPeriod(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetGradingPeriod');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetGradingPeriod', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getAllTerms(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllTerms');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllTerms', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async  function getTerm(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetTerm');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetTerm', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getAllSchools(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllSchools');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllSchools', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getSchool(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetSchool');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetSchool', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getAllTeachers(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllTeachers');
            termWriteItalic('This API typically takes <15 seconds...');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllTeachers', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getTeacher(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetTeacher');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetTeacher', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getAllStudents(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllStudents');
            termWriteItalic('This API typically takes <20 seconds...');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllStudents', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async function getStudent(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetStudent');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetStudent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async  function getAllDemographics(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllDemographics');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllDemographics', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }
        }

        async  function getDemographics(btn) {
            termWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetDemographics');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetDemographics', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                termWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    termWriteJson(JSON.parse(raw));
                } catch {
                    termWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                termWrite('Request failed: ' + (e?.message || e));
            }

        }

        // ---------- API functions for Gradebook ----------

        async function gbRetrieveOAuth2Token(btn) {
            gbTermWrite('Requesting token via Laravel proxy...');

            try {
                const res = await fetch('/proxy/oauth-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({})
                });

                const raw = await res.text();
                gbTermWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    gbTermWriteJson(JSON.parse(raw));
                } catch {
                    gbTermWrite(raw);
                }

            } catch (err) {
                setButtonFail(btn);
                gbTermWrite('Request failed: ' + (err?.message || err));
            }
        }


        async  function getAllCategories(btn) {
            gbTermWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllCategories');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllCategories', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                gbTermWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    gbTermWriteJson(JSON.parse(raw));
                } catch {
                    gbTermWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                gbTermWrite('Request failed: ' + (e?.message || e));
            }

        }
        async  function getAllLineItems(btn) {
            gbTermWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllLineItems');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllLineItems', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                gbTermWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    gbTermWriteJson(JSON.parse(raw));
                } catch {
                    gbTermWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                gbTermWrite('Request failed: ' + (e?.message || e));
            }

        }

        async  function getAllResults(btn) {
            gbTermWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllResults');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllResults', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                gbTermWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    gbTermWriteJson(JSON.parse(raw));
                } catch {
                    gbTermWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                gbTermWrite('Request failed: ' + (e?.message || e));
            }

        }

        async  function getAllScoreScales(btn) {
            gbTermWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllScoreScales');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllScoreScales', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                gbTermWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    gbTermWriteJson(JSON.parse(raw));
                } catch {
                    gbTermWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                gbTermWrite('Request failed: ' + (e?.message || e));
            }

        }

        // ---------- API functions for Resources ----------

        async function reRetrieveOAuth2Token(btn) {
            reTermWrite('Requesting token via Laravel proxy...');

            try {
                const res = await fetch('/proxy/oauth-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({})
                });

                const raw = await res.text();
                reTermWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    reTermWriteJson(JSON.parse(raw));
                } catch {
                    reTermWrite(raw);
                }

            } catch (err) {
                setButtonFail(btn);
                reTermWrite('Request failed: ' + (err?.message || err));
            }
        }


        async  function getAllResources(btn) {
            reTermWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetAllResources');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetAllResources', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                reTermWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    reTermWriteJson(JSON.parse(raw));
                } catch {
                    reTermWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                reTermWrite('Request failed: ' + (e?.message || e));
            }

        }

        async  function getResource(btn) {
            reTermWrite('Calling https://oneroster.myscuta.com/api/oneRosterGetResource');

            setButtonLoading(btn);

            try {
                const res = await fetch('/proxy/oneRosterGetResource', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        sourcedId: 'x63765d9-7955-496c-aeeb-3e8b7cb4f5a3'
                    })
                });

                const raw = await res.text();
                reTermWrite(`HTTP ${res.status}`);

                res.ok ? setButtonSuccess(btn) : setButtonFail(btn);

                try {
                    reTermWriteJson(JSON.parse(raw));
                } catch {
                    reTermWrite(raw);
                }

            } catch (e) {
                setButtonFail(btn);
                reTermWrite('Request failed: ' + (e?.message || e));
            }

        }
    </script>


</body>
</html>
