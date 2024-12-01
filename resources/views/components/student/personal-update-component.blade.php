@php
    use App\Helpers\Auth;
@endphp

<table class="table table_borderless w-full">
    <tbody>
        <tr>
            <td class="w-1/4 text-right font-bold">
                <label for="birth_date">วัน เดือน ปีเกิด</label>
            </td>
            <td class="w-3/4 text-left">
                <div class="input-group">
                    <input id="birth_date" name="birth_date" type="text" class="form-control input-group-item @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $info->birth_date ?? $currentDate) }}" readonly required autofocus />
                    <div class="input-addon input-addon-append input-group-item">
                        <span class="la la-calendar text-xl"></span>
                    </div>
                </div>
                @error('birth_date')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="weight">น้ำหนัก</label>
            </td>
            <td class="text-left">
                <input id="weight" name="weight" type="number" min="20" max="200" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $info->weight ?? 50) }}" required />
                @error('weight')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="height">ส่วนสูง</label>
            </td>
            <td class="text-left">
                <input id="height" name="height" type="number" min="100" max="300" class="form-control @error('height') is-invalid @enderror" value="{{ old('height', $info->height ?? 160) }}" required />
                @error('height')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="email">อีเมล</label>
            </td>
            <td class="text-left">
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $info->email ?? '') }}" maxlength="70" />
                @error('email')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="tel">เบอร์โทรศัพท์มือถือ</label>
            </td>
            <td class="text-left">
                <input id="tel" name="tel" type="tel" pattern="[0-9]{10}" maxlength="10" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel', $info->tel ?? '') }}" />
                @error('tel')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="scholarship">การได้รับทุน</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="scholarship" name="scholarship" class="form-control @error('scholarship') is-invalid @enderror" required>
                        @foreach ($scholarship as $key)
                            <option value="{{ $key }}" @if (isset($info->scholarship) && $key == $info->scholarship) selected @endif>{{ Auth::convertScholarshipFromENToTH($key) }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('scholarship')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="disability">ความพิการ</label>
            </td>
            <td class="text-left">
                <input id="disability" name="disability" type="text" class="form-control @error('disability') is-invalid @enderror" value="{{ old('disability', $info->disability ?? '') }}" />
                @error('disability')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="blood_type">หมู่โลหิต</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="blood_type" name="blood_type" class="form-control @error('blood_type') is-invalid @enderror" required>
                        @foreach ($bloodType as $key)
                            <option value="{{ $key }}" @if (isset($info->blood_type) && $key == $info->blood_type) selected @endif>{{ $key }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('blood_type')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="nationality">สัญชาติ</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="nationality" name="nationality" class="form-control @error('nationality') is-invalid @enderror" required>
                        @foreach ($countries as $country)
                            <option value="{{ $country->code }}" @if (isset($info->nationality->code) && $country->code == $info->nationality->code) selected @endif>{{ $country->title }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('nationality')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="ethnicity">เชื้อชาติ</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="ethnicity" name="ethnicity" class="form-control @error('ethnicity') is-invalid @enderror" required>
                        @foreach ($countries as $country)
                            <option value="{{ $country->code }}" @if (isset($info->ethnicity->code) && $country->code == $info->ethnicity->code) selected @endif>{{ $country->title }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('ethnicity')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="religion">ศาสนา</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="religion" name="religion" class="form-control @error('religion') is-invalid @enderror" required>
                        @foreach ($religion as $key)
                            <option value="{{ $key }}" @if (isset($info->religion) && $key == $info->religion) selected @endif>{{ Auth::convertReligionFromENToTH($key) }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('religion')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="shirt_size">ขนาดเสื้อกิจกรรม</label>
            </td>
            <td class="text-left">
                <div class="custom-select">
                    <select id="shirt_size" name="shirt_size" class="form-control @error('shirt_size') is-invalid @enderror" required>
                        @foreach ($shirtSize as $key)
                            <option value="{{ $key }}" @if (isset($info->shirt_size) && $key == $info->shirt_size) selected @endif>{{ $key }}</option>
                        @endforeach
                    </select>
                    <div class="custom-select-icon la la-caret-down"></div>
                </div>

                @error('shirt_size')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="interest">ความถนัด ความสนใจพิเศษ</label>
            </td>
            <td class="text-left">
                <input id="interest" name="interest" type="text" class="form-control @error('interest') is-invalid @enderror" value="{{ old('interest', $info->interest ?? '') }}" />
                @error('interest')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                <label for="address">ที่อยู่</label>
            </td>
            <td class="text-left">
                <textarea id="address" name="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $info->address ?? '') }}</textarea>
                @error('address')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </td>
        </tr>
    </tbody>
</table>

<script type="module">
    $(document).ready(function() {
        $.datetimepicker.setLocale('th');

        const thaiYear = function (ct) {
            let leap = 3;
            let dayWeek = ["พฤ.", "ศ.", "ส.", "อา.", "จ.", "อ.", "พ."];
            if (ct) {
                const yearL = new Date(ct).getFullYear() - 543;
                leap = (((yearL % 4 == 0) && (yearL % 100 != 0)) || (yearL % 400 == 0)) ? 2 : 3;
                if (leap == 2) {
                    dayWeek = ["ศ.", "ส.", "อา.", "จ.", "อ.", "พ.", "พฤ."];
                }
            }
            this.setOptions({
                i18n: {
                    th: {
                        dayOfWeek: dayWeek
                    }
                },
                dayOfWeekStart: leap
            });
        }

        $('#birth_date').datetimepicker({
            timepicker: false,
            maxDate: new Date(),
            format: 'd-m-Y',
            lang: 'th',
            onChangeMonth: thaiYear,
            onShow: thaiYear,
            yearOffset: 543,
            closeOnDateSelect: true
        });
    });
</script>
