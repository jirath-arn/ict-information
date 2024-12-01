@php
    use App\Helpers\Auth;
    use App\Helpers\Date;
@endphp

<table class="table table_borderless w-full">
    <tbody>
        <tr>
            <td class="w-1/4 text-right font-bold">
                <label for="education">ระดับการศึกษาเดิม</label>
            </td>
            <td class="w-3/4 text-left">
                <div class="custom-select">
                    <select id="education" name="education" class="form-control @error('education') is-invalid @enderror" required autofocus>
                        @foreach ($education as $key)
                            <option value="{{ $key }}" @if (isset($info->education) && $key == $info->education) selected @endif>{{ Auth::convertEducationFromENToTH($key) }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('education')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="name_school">สถานที่ศึกษาเดิม</label>
            </td>
            <td class="text-left">
                <input id="name_school" name="name_school" type="text" class="form-control @error('name_school') is-invalid @enderror" value="{{ old('name_school', $info->name_school ?? '') }}" required />
                @error('name_school')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="qualification">วุฒิการศึกษาเดิม</label>
            </td>
            <td class="text-left">
                <input id="qualification" name="qualification" type="text" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification', $info->qualification ?? '') }}" required />
                @error('qualification')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="graduate_year">สำเร็จการศึกษาเมื่อปี พ.ศ.</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="graduate_year" name="graduate_year" class="form-control @error('graduate_year') is-invalid @enderror" required>
                        @for ($year = $currentYear; $year > $currentYear - 10; $year--)
                            <option value="{{ $year }}" @if (isset($info->graduate_year) && $year == $info->graduate_year) selected @endif>{{ Date::convertFromADToBE($year) }}</option>
                        @endfor
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('graduate_year')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="gpa">เกรดเฉลี่ยที่สำเร็จการศึกษา</label>
            </td>
            <td class="text-left">
                <input id="gpa" name="gpa" type="number" class="form-control @error('gpa') is-invalid @enderror" min="0" max="4" step="0.01" value="{{ old('gpa', $info->gpa ?? 0) }}" required />
                @error('gpa')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
    </tbody>
</table>
