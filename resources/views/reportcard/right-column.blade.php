@php $isReadonly = isset($readonly) && $readonly; @endphp

<style>
    @media print {
        select {
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
            background: transparent !important;
            background-image: none !important;
            padding-right: 0 !important;
        }

        select::-ms-expand {
            display: none !important;
        }
    }
</style>

<div class="col-md-6 border-box">
    <div class="text-left mb-2">SF9-SHS</div>
    <div class="text-right mb-2">
        LRN:
        <input type="text" name="lrn" maxlength="12" class="form-control d-inline"
            value="{{ old('lrn', $lrn ?? $user['usrLRN'] ?? '') }}"
            style="width: 25%" {{ $isReadonly ? 'readonly' : '' }}>
    </div>

    <div class="text-center">
        <strong>Republic of the Philippines<br>
            DEPARTMENT OF EDUCATION</strong><br>

        <p>
            Region:
            <select name="region" {{ $isReadonly ? 'disabled' : '' }}
                class="d-inline-block text-center text-bold"
                style="width: 80px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;">
                <option value="" disabled {{ empty(old('region', $region ?? '')) ? 'selected' : '' }}>Select</option>
                @foreach(['I','II','III','IV-A','IV-B','V','VI','VII','VIII','IX','X','XI','XII','XIII','NCR','CAR','BARMM'] as $r)
                    <option value="{{ $r }}" {{ old('region', $region ?? '') == $r ? 'selected' : '' }}>{{ $r }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <strong>DIVISION OF</strong>
            <select name="division" {{ $isReadonly ? 'disabled' : '' }}
                class="d-inline-block text-bold text-center"
                style="width: 150px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;">
                <option value="" disabled {{ empty(old('division', $division ?? '')) ? 'selected' : '' }}>Select Division</option>
                @foreach(['Manila','Quezon City','Cebu City','Davao City','Baguio City','Iloilo City','Zamboanga City','Taguig City','Pasig City','Makati City'] as $div)
                    <option value="{{ $div }}" {{ old('division', $division ?? '') == $div ? 'selected' : '' }}>{{ $div }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <span class="fw-bold"><u>{{ $schoolName ?? '' }}</u></span>
        </p>
    </div>

    <p class="mt-2 mb-2">
        Name:
        <input type="text" value="{{ $user['usrLastName'] ?? '' }}"
            class="d-inline-block fw-bold"
            style="width: 25%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            readonly>

        <input type="text" value="{{ $user['usrFirstName'] ?? '' }}"
            class="d-inline-block fw-bold"
            style="width: 25%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            readonly>

        <input type="text" value="{{ $user['usrMiddleName'] ?? '' }}"
            class="d-inline-block fw-bold"
            style="width: 25%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            readonly>
    </p>

    <p class="mt-2 mb-2">
        Age:
        <input type="text" name="age" class="d-inline-block text-center fw-bold"
            value="{{ old('age', $age ?? '') }}"
            style="width: 80px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            {{ $isReadonly ? 'readonly' : '' }}>
        &nbsp;&nbsp; Sex:
        <input type="text" name="sex" class="d-inline-block text-center fw-bold"
            value="{{ old('sex', $sex ?? '') }}"
            style="width: 100px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            {{ $isReadonly ? 'readonly' : '' }}>
    </p>

    <p>
        Grade:
        <input type="text" name="grade" value="{{ old('grade', $grade ?? '') }}"
            class="d-inline-block text-bold"
            style="width: 80px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            {{ $isReadonly ? 'readonly' : '' }}>
        &nbsp;&nbsp; Section:
        <input type="text" name="section" value="{{ old('section', $section ?? '') }}"
            class="d-inline-block text-bold"
            style="width: 120px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;" 
            {{ $isReadonly ? 'readonly' : '' }}>
    </p>

    <p>
        Curriculum:
        <input type="text" name="curriculum" value="{{ old('curriculum', $curriculum ?? '') }}"
            class="d-inline-block text-bold"
            style="width: 80%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            {{ $isReadonly ? 'readonly' : '' }}>
    </p>

    <p>
        School Year:
        <input type="text" name="school_year" value="{{ old('school_year', $school_year ?? '') }}"
            class="d-inline-block text-bold"
            style="width: 200px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            {{ $isReadonly ? 'readonly' : '' }}>
    </p>

    <p>
        Track/Strand:
        <input type="text" name="track_strand" value="{{ old('track_strand', $track_strand ?? '') }}"
            class="d-inline-block text-bold"
            style="width: 80%; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
            {{ $isReadonly ? 'readonly' : '' }}>
    </p>

    <br>
    <p><em>Dear Parent/Guardian,</em></p>
    <p><em>
        This report card shows the ability and progress your child has made in the different
        learning areas as well as his/her core values.
        <br><br>
        The school welcomes you should you desire to know more about your child's progress.
    </em></p>

    <br><br><br><br>

    <div class="row font-italic">
        <div class="col text-center">
            <br><br><br>
            <input type="text" name="principal" value="{{ old('principal') }}"
                class="d-inline-block text-center font-weight-bold"
                style="width: 200px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
            <br>Principal IV
        </div>

        <div class="col text-center">
            <input type="text" name="approved_adviser" value="{{ old('approved_adviser') }}"
                class="d-inline-block text-center font-weight-bold"
                style="width: 200px; border: none; border-bottom: 1px solid black; outline: none; background: transparent;"
                {{ $isReadonly ? 'readonly' : '' }}>
            <br>Adviser
        </div>
    </div>
</div>
