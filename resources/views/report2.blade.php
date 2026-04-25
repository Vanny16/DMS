@extends('templates.backend.layouts.main')

@section('title', "Learner's Report Card")

@section('content')

<style>
    @page {
        size: A4 landscape;
        margin: 0in 0in 0in 0.1in;
    }

    body, html {
        font-family: Arial, sans-serif;
        font-size: 11px;
        background: white;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }

    .container-report {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 6px;
        width: 100%;
    }

    .column {
        flex: 1 1 100%;
    }

    @media (min-width: 768px) {
        .column {
            flex: 0 0 49%;
        }
    }

    h4 {
        text-align: center;
        margin: 4px 0;
        font-size: 13px;
    }

    .section-title {
        font-weight: bold;
        padding: 4px;
        margin-top: 5px;
        font-size: 11px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1px;
        font-size: 10.5px;
        table-layout: fixed;
        word-wrap: break-word;
    }

    th, td {
        border: 1px solid #000;
        padding: 1px;
        vertical-align: top;
        text-align: left;
    }

    th {
        background-color: #d9d9d9;
    }

    .text-center {
        text-align: center;
    }

    .align-middle {
        vertical-align: middle;
    }

    input[type="text"],
    select {
        width: 100%;
        border: none;
        outline: none;
        padding: 1px 2px;
        font-size: 10px;
        text-align: center;
        height: 18px;
        background-color: transparent;
    }

    .row-applied,
    .row-core {
        background-color: #d9d9d9;
    }

    .table-observed th,
    .table-observed td,
    .table-observed-right th,
    .table-observed-right td {
        border: px solid #000;
    }

    .print-wrapper {
        animation: fadeInUp 0.6s ease-out;
        padding: 0;
        margin: 0;
        background-color: white;
    }

    @media print {
        html, body {
            width: 297mm;
            height: 210mm;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
        }
        
            .table-observed th,
            .table-observed td,
            .table-observed-right th,
            .table-observed-right td {
                border: 2px solid #000;
            }

        .container-report {
            width: 100%;
            height: 100%;
            margin: 0 !important;
            padding: 0 !important;
        }

        .column {
            width: 49%;
        }

        .btn, .d-print-none, .text-center.mt-3 {
            display: none !important;
        }

        input[type="text"],
        select {
            border: none !important;
            background: none !important;
            color: black !important;
        }

        select {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
        }

        .card,
        form,
        .container-report {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .row-applied,
        .row-core,
        th {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
            background-color: #d9d9d9 !important;
        }

        .print-wrapper {
            animation: none !important;
            padding: 0 !important;
            margin: 0 !important;
            margin-left: 0.1in !important;
            margin-right: 0 !important;
        }
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>



@php
    $readOnly = session('usrType') == 4;
@endphp

<form action="{{ route('report.store') }}" method="POST">
    @csrf

    <div class="print-wrapper">
        <div class="container-report">
            {{-- LEFT COLUMN (Grades) --}}
            <div class="column">
                <h4><strong>LEARNER'S PROGRESS REPORT CARD</strong></h4>

                {{-- First Semester --}}
                <div class="section-title">First Semester</div>
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">Subjects</th>
                            <th colspan="2" class="text-center">Quarter</th>
                            <th rowspan="2" class="text-center align-middle">Semester Final Grade</th>
                        </tr>
                        <tr>
                            <th class="text-center">1</th>
                            <th class="text-center">2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-core">
                            <td colspan="4"><strong>Core Subjects</strong></td>
                        </tr>
                        @foreach([
                            'Oral communication',
                            'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino',
                            'Introduction to the Philosophy of the Human Person Pambungad sa Pilosopiya ng Tao',
                            'Physical Education and Health 1',
                            'General Mathematics',
                            'Earth Science'
                        ] as $sub)
                            @php $key = str_replace(' ', '_', strtolower($sub)); @endphp
                            <tr>
                                <td>{{ $sub }}</td>
                                <td><input name="{{ $key }}_q1" type="text" value="{{ old($key.'_q1',  $data[$key.'_q1'] ?? '') }}" /></td>
                                <td><input name="{{ $key }}_q2" type="text" value="{{ old($key.'_q2',  $data[$key.'_q2'] ?? '') }}" /></td>
                                <td><input name="{{ $key }}_final" type="text" value="{{ old($key.'_final',  $data[$key.'_final'] ?? '') }}" /></td>
                            </tr>
                        @endforeach

                        <tr class="row-applied">
                            <td colspan="4"><strong>Applied and Specialized</strong></td>
                        </tr>
                        @foreach(['Empowerment Technology', 'Pre-Calculus', 'General Chemistry 1'] as $sub)
                            @php $key = str_replace(' ', '_', strtolower($sub)); @endphp
                            <tr>
                                <td>{{ $sub }}</td>
                                <td><input name="{{ $key }}_q1" type="text" value="{{ old($key.'_q1',  $data[$key.'_q1'] ?? '') }}" /></td>
                                <td><input name="{{ $key }}_q2" type="text" value="{{ old($key.'_q2',  $data[$key.'_q2'] ?? '') }}" /></td>
                                <td><input name="{{ $key }}_final" type="text" value="{{ old($key.'_final',  $data[$key.'_final'] ?? '') }}" /></td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="text-right" colspan="3"><strong>General Average for the Semester</strong></td>
                            <td><input name="gen_average_1" type="text" value="{{ old('gen_average_1', $data['gen_average_1'] ?? '') }}" /></td>
                        </tr>
                    </tbody>
                </table>

                {{-- Second Semester --}}
                <div class="section-title">Second Semester</div>
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle">Subjects</th>
                            <th colspan="2" class="text-center">Quarter</th>
                            <th rowspan="2" class="text-center align-middle">Semester Final Grade</th>
                        </tr>
                        <tr>
                            <th class="text-center">3</th>
                            <th class="text-center">4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-core">
                            <td colspan="4"><strong>Core Subjects</strong></td>
                        </tr>
                        @foreach([
                            'Reading and Writing',
                            'Pagbasa at Pagsusuri ng Ibat-Ibang Teksto Tungo sa Pananaliksik',
                            'Personal Development/ Pansariling Kaunlaran',
                            'Physical Education and Health 2',
                            'Statistics and Probability',
                            'Disaster Readiness and Risk Reduction'
                        ] as $sub)
                            @php $key = str_replace(' ', '_', strtolower($sub)); @endphp
                            <tr>
                                <td>{{ $sub }}</td>
                                <td><input name="{{ $key }}_q3" type="text" value="{{ old($key.'_q3', $data[$key.'_q3'] ?? '') }}" /></td>
                                <td><input name="{{ $key }}_q4" type="text" value="{{ old($key.'_q4', $data[$key.'_q4'] ?? '') }}" /></td>
                                <td><input name="{{ $key }}_final" type="text" value="{{ old($key.'_final', $data[$key.'_final'] ?? '') }}" /></td>
                            </tr>
                        @endforeach

                        <tr class="row-applied">
                            <td colspan="4"><strong>Applied and Specialized</strong></td>
                        </tr>
                        @foreach(['practical_research1', 'basic_calculus', 'General Chemistry 2'] as $sub)
                            <tr>
                                <td>{{ ucwords(str_replace('_', ' ', $sub)) }}</td>
                                <td><input name="{{ $sub }}_q3" type="text" value="{{ old($sub.'_q3', $data[$sub.'_q3'] ?? '') }}" /></td>
                                <td><input name="{{ $sub }}_q4" type="text" value="{{ old($sub.'_q4', $data[$sub.'_q4'] ?? '') }}" /></td>
                                <td><input name="{{ $sub }}_final" type="text" value="{{ old($sub.'_final', $data[$sub.'_final'] ?? '') }}" /></td>
                            </tr>
                        @endforeach

                        <tr>
                            <td class="text-right" colspan="3"><strong>General Average for the Semester</strong></td>
                            <td><input name="genF_average_sem2" type="text" value="{{ old('genF_average_sem2', $data['genF_average_sem2'] ?? '') }}" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- RIGHT COLUMN (Values) --}}
            <div class="column">
                    <h4><strong>REPORT ON LEARNER'S OBSERVED VALUES</strong></h4>
                    <table class="table-observed-right">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center" style="width: 15s%;">Core Values</th>
                                <th rowspan="2" class="text-center" style="width: 45%;">Behavior Statement</th>
                                <th colspan="4" class="text-center" style="width: 40%;">Quarter</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="background-color: transparent;">1</th>
                                <th class="text-center" style="background-color: transparent;">2</th>
                                <th class="text-center" style="background-color: transparent;">3</th>
                                <th class="text-center" style="background-color: transparent;">4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $values = [
                                    ['Maka-Diyos','Expresses one’s spiritual beliefs while respecting the spiritual beliefs of others'],
                                    ['Maka-Diyos','Shows adherence to ethical principles by upholding truth in all undertakings'],
                                    ['Makatao','Is sensitive to individual, social and cultural differences; resists stereotyping people'],
                                    ['Makatao','Demonstrates contributions toward solidarity'],
                                    ['Makakalikasan','Cares for the environment and utilizes resources wisely, judiciously and economically'],
                                    ['Makabansa','Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen'],
                                    ['Makabansa','Demonstrates appropriate behavior in carrying out activities in the school, community amd country']
                                ];
                                $rowCounts = array_count_values(array_column($values, 0));
                            @endphp

                            @foreach($values as $idx => [$core, $beh])
                            <tr>
                                @if($idx === 0 || $core !== $values[$idx - 1][0])
                                <td rowspan="{{ $rowCounts[$core] }}">{{ $core }}</td>
                                @endif
                                <td>{{ $beh }}</td>
                                                @for($q = 1; $q <= 4; $q++)
                                @php $field = "obs_{$idx}_q{$q}"; @endphp
                                <td>
                                    <select name="{{ $field }}">
                                    @foreach(['AO', 'SO', 'RO', 'NO'] as $opt)
                                <option value="{{ $opt }}" {{ (old($field, $data[$field] ?? '') == $opt) ? 'selected' : '' }}>{{ $opt }}</option>

                                    @endforeach
                                    </select>
                                </td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table class="table text-center" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-left" style="border: none; padding: 6px;"><strong>Observed Values</strong></th>
                            </tr>
                            <tr>
                                <th style="border: none; padding: 6px;">Marking</th>
                                <th style="border: none; padding: 6px;">Non-Numerical Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td style="border: none; padding: 6px;">AO</td><td style="border: none; padding: 6px;">Always Observed</td></tr>
                            <tr><td style="border: none; padding: 6px;">SO</td><td style="border: none; padding: 6px;">Sometimes Observed</td></tr>
                            <tr><td style="border: none; padding: 6px;">RO</td><td style="border: none; padding: 6px;">Rarely Observed</td></tr>
                            <tr><td style="border: none; padding: 6px;">NO</td><td style="border: none; padding: 6px;">Not Observed</td></tr>
                        </tbody>
                    </table>

                    <table class="table text-center mt-4" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-left" style="padding: 6px; border: none; text-align: justify;"><strong>Learner Progress and Achievement</strong></th>
                            </tr>
                            <tr>
                                <th style="padding: 6px; border: none; text-align: justify;">Descriptors</th>
                                <th style="padding: 6px; border: none; text-align: justify;">Grading Scale</th>
                                <th style="padding: 6px; border: none; text-align: justify;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td style="padding: 6px; border: none; text-align: justify;">Outstanding</td><td style="padding: 6px; border: none; text-align: justify;">90–100</td><td style="padding: 6px; border: none; text-align: justify;">Passed</td></tr>
                            <tr><td style="padding: 6px; border: none; text-align: justify;">Very Satisfactory</td><td style="padding: 6px; border: none; text-align: justify;">85–89</td><td style="padding: 6px; border: none; text-align: justify;">Passed</td></tr>
                            <tr><td style="padding: 6px; border: none; text-align: justify;">Satisfactory</td><td style="padding: 6px; border: none; text-align: justify;">80–84</td><td style="padding: 6px; border: none; text-align: justify;">Passed</td></tr>
                            <tr><td style="padding: 6px; border: none; text-align: justify;">Fairly Satisfactory</td><td style="padding: 6px; border: none; text-align: justify;">75–79</td><td style="padding: 6px; border: none; text-align: justify;">Passed</td></tr>
                            <tr><td style="padding: 6px; border: none; text-align: justify;">Did Not Meet Expectation</td><td style="padding: 6px; border: none; text-align: justify;">Below 75</td><td style="padding: 6px; border: none; text-align: justify;">Failed</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <p><em>Iniwasto ni:</em></p>
        </div>

        <div class="text-center mt-3 d-print-none">
    <button type="submit" class="btn btn-primary btn-lg px-5 py-3 fs-5">
        Save and Print Report
    </button>
</div>
    </div>
</form>

@if(session('success'))
<script>
    window.addEventListener('load', function () {
        window.print();
    });
</script>
@endif

{{-- Auto-calculate JS kept unchanged --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function calculateSemesterGrades(quarterPairs, finalFieldSuffix, generalAverageField) {
            const finalGrades = [];

            quarterPairs.forEach(([q1Name, q2Name, finalName]) => {
                const q1Input = document.querySelector(`[name="${q1Name}"]`);
                const q2Input = document.querySelector(`[name="${q2Name}"]`);
                const finalField = document.querySelector(`[name="${finalName}"]`);

                const q1 = parseFloat(q1Input?.value) || 0;
                const q2 = parseFloat(q2Input?.value) || 0;
                const finalGrade = ((q1 + q2) / 2).toFixed(2);

                if (finalField) {
                    finalField.value = (q1 > 0 && q2 > 0) ? finalGrade : '';
                }

                if (q1 > 0 && q2 > 0) {
                    finalGrades.push(parseFloat(finalGrade));
                }
            });

            const generalAverageFieldEl = document.querySelector(`[name="${generalAverageField}"]`);
            if (generalAverageFieldEl && finalGrades.length > 0) {
                const total = finalGrades.reduce((a, b) => a + b, 0);
                generalAverageFieldEl.value = (total / finalGrades.length).toFixed(2);
            }
        }

        function getSubjects(prefixes, quarters) {
            return prefixes.map(prefix => {
                const key = prefix.toLowerCase().replace(/\s+/g, '_');
                return [`${key}_${quarters[0]}`, `${key}_${quarters[1]}`, `${key}_final`];
            });
        }

        function calculateAllGrades() {
            const sem1Subjects = [
                'Oral communication',
                'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino',
                'Introduction to the Philosophy of the Human Person Pambungad sa Pilosopiya ng Tao',
                'Physical Education and Health 1',
                'General Mathematics',
                'Earth Science',
                'Empowerment Technology',
                'Pre-Calculus',
                'General Chemistry 1'
            ];
            const sem1Pairs = getSubjects(sem1Subjects, ['q1', 'q2']);
            calculateSemesterGrades(sem1Pairs, '_final', 'gen_average_1');

            const sem2Subjects = [
                'Reading and Writing',
                'Pagbasa at Pagsusuri ng Ibat-Ibang Teksto Tungo sa Pananaliksik',
                'Personal Development/ Pansariling Kaunlaran',
                'Physical Education and Health 2',
                'Statistics and Probability',
                'Disaster Readiness and Risk Reduction',
                'practical_research1',
                'basic_calculus',
                'General Chemistry 2'
            ];
            const sem2Pairs = getSubjects(sem2Subjects, ['q3', 'q4']);
            calculateSemesterGrades(sem2Pairs, '_final', 'genF_average_sem2');
        }

        // Attach live update on input
        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.addEventListener('input', calculateAllGrades);
        });

        calculateAllGrades();

        // Form submission validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            let isValid = true;
            const inputs = form.querySelectorAll('input[type="text"]');

            inputs.forEach(input => {
                if (
                    input.name.match(/_q[1-4]$/) && // Only validate quarter grades
                    (input.value === '' || isNaN(parseFloat(input.value)))
                ) {
                    isValid = false;
                    input.classList.add('is-invalid'); // Bootstrap style red border
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please complete all quarterly grade fields before submitting or printing.');
            }
        });
    });
</script>
 

@endsection
