@php
    use App\Helpers\Auth;
    use App\Helpers\Date;

    $paths = explode('/', request()->path());
    $path = end($paths);
@endphp

<table class="table table_borderless w-full">
    <tbody>
        @if($path != 'create')
            <tr>
                <td class="w-1/4 text-right font-bold">
                    รหัสนักศึกษา
                </td>
                <td class="w-3/4 text-left">
                    {{ $info->student_id ?? '-' }}
                </td>
            </tr>
        @endif
        <tr>
            <td class="w-1/4 text-right font-bold">
                <label for="prefix">คำนำหน้า</label>
            </td>
            <td class="w-3/4 text-left">
                <div class="custom-select">
                    <select id="prefix" name="prefix" class="form-control @error('prefix') is-invalid @enderror" required autofocus>
                        @foreach ($prefix as $key)
                            <option value="{{ $key }}" @if (isset($info->prefix) && $key == $info->prefix) selected @endif>{{ Auth::convertPrefixFromENToTH($key) }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('prefix')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="first_name_th">ชื่อ</label>
            </td>
            <td class="text-left">
                <input id="first_name_th" name="first_name_th" type="text" class="form-control @error('first_name_th') is-invalid @enderror" value="{{ old('first_name_th', $info->first_name_th ?? '') }}" maxlength="50" required />
                @error('first_name_th')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="last_name_th">นามสกุล</label>
            </td>
            <td class="text-left">
                <input id="last_name_th" name="last_name_th" type="text" class="form-control @error('last_name_th') is-invalid @enderror" value="{{ old('last_name_th', $info->last_name_th ?? '') }}" maxlength="50" required />
                @error('last_name_th')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="first_name_en">First Name</label>
            </td>
            <td class="text-left">
                <input id="first_name_en" name="first_name_en" type="text" class="form-control @error('first_name_en') is-invalid @enderror" value="{{ old('first_name_en', $info->first_name_en ?? '') }}" maxlength="50" required />
                @error('first_name_en')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="last_name_en">Last Name</label>
            </td>
            <td class="text-left">
                <input id="last_name_en" name="last_name_en" type="text" class="form-control @error('last_name_en') is-invalid @enderror" value="{{ old('last_name_en', $info->last_name_en ?? '') }}" maxlength="50" required />
                @error('last_name_en')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        @if($path != 'create')
            <tr>
                <td class="text-right font-bold">
                    อีเมล Rmutto
                </td>
                <td class="text-left">
                    {{ $info->rmutto_email ?? '-' }}
                </td>
            </tr>
        @endif
        <tr>
            <td class="text-right font-bold">
                <label for="student_status_code">สถานะนักศึกษา</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="student_status_code" name="student_status_code" class="form-control @error('student_status_code') is-invalid @enderror" required>
                        @foreach ($studentStatus as $e)
                            <option value="{{ $e->code }}" @if (isset($info->student_status->code) && $e->code == $info->student_status->code) selected @endif>{{ $e->title }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('student_status_code')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="level">ชั้นปีที่</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="level" name="level" class="form-control @error('level') is-invalid @enderror" required>
                        @for ($level = 1; $level <= 8; $level++)
                            <option value="{{ $level }}" @if (isset($info->level) && $level == $info->level) selected @endif>{{ $level }}</option>
                        @endfor
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('level')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="year">ปีการศึกษา</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="year" name="year" class="form-control @error('year') is-invalid @enderror" required>
                        @if($path != 'create')
                            @for ($year = $currentYear; $year > $currentYear - 10; $year--)
                                <option value="{{ $year }}" @if (isset($info->year) && $year == $info->year) selected @endif>{{ Date::convertFromADToBE($year) }}</option>
                            @endfor
                        @else
                            <option value="{{ $currentYear }}" selected>{{ Date::convertFromADToBE($currentYear) }}</option>
                        @endif
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('year')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="transfer">รูปแบบ</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="transfer" name="transfer" class="form-control @error('transfer') is-invalid @enderror" required>
                        @foreach ($transfer as $key)
                            <option value="{{ $key }}" @if (isset($info->transfer) && $key == $info->transfer) selected @endif>{{ Auth::convertTransferFromENToTH($key) }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('transfer')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="advisor_id">อาจารย์ที่ปรึกษา</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="advisor_id" name="advisor_id" class="form-control @error('advisor_id') is-invalid @enderror" required>
                        @foreach ($advisors as $e)
                            <option value="{{ $e->id }}" @if (isset($info->advisor_id) && $e->id == $info->advisor_id) selected @endif>{{ $e->first_name_th.' '.$e->last_name_th }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('advisor_id')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
    </tbody>
</table>
