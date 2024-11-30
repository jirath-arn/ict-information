@extends('layouts.app')

@section('title', 'แก้ไขประวัติส่วนตัว')

@section('styles')
@php
    use App\Helpers\Auth;
@endphp
@endsection

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>แก้ไขประวัติส่วนตัว</h1>
        <ul>
            <li>แก้ไขประวัติส่วนตัว</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a id="updateButton" href="#" class="btn btn_success uppercase">
            <span class="la la-download text-xl leading-none mr-2"></span>
            บันทึก
        </a>

        <a href="{{ route('personal_information.index') }}" class="btn btn_danger uppercase">
            <span class="la la-times text-xl leading-none mr-2"></span>
            ยกเลิก
        </a>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <form id="updateForm" action="{{ route('personal_information.update') }}" method="POST">
            @csrf

            <table class="table table_borderless w-full">
                <tbody>
                    <tr>
                        <td class="w-1/4 text-right font-bold">
                            <label for="birth_date">วัน เดือน ปีเกิด</label>
                        </td>
                        <td class="w-3/4 text-left">
                            <div class="input-group">
                                <input id="birth_date" name="birth_date" type="text" class="form-control input-group-item @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', isset($info) ? $info->birth_date : '') }}" readonly required autofocus />
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
                            <input id="weight" name="weight" type="number" min="20" max="200" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', isset($info) ? $info->weight : 50) }}" required />
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
                            <input id="height" name="height" type="number" min="100" max="300" class="form-control @error('height') is-invalid @enderror" value="{{ old('height', isset($info) ? $info->height : 160) }}" required />
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
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', isset($info) ? $info->email : '') }}" maxlength="70" />
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
                            <input id="tel" name="tel" type="tel" pattern="[0-9]{10}" maxlength="10" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel', isset($info) ? $info->tel : '') }}" />
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
                                        <option value="{{ $key }}" @if ($key == $info->scholarship) selected @endif>{{ Auth::convertScholarshipFromENToTH($key) }}</option>
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
                            <input id="disability" name="disability" type="text" class="form-control @error('disability') is-invalid @enderror" value="{{ old('disability', isset($info) ? $info->disability : '') }}" />
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
                                    @foreach ($blood_type as $key)
                                        <option value="{{ $key }}" @if ($key == $info->blood_type) selected @endif>{{ $key }}</option>
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
                                        <option value="{{ $country->code }}" @if ($country->code == $info->nationality->code) selected @endif>{{ $country->title }}</option>
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
                                        <option value="{{ $country->code }}" @if ($country->code == $info->ethnicity->code) selected @endif>{{ $country->title }}</option>
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
                                        <option value="{{ $key }}" @if ($key == $info->religion) selected @endif>{{ Auth::convertReligionFromENToTH($key) }}</option>
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
                                    @foreach ($shirt_size as $key)
                                        <option value="{{ $key }}" @if ($key == $info->shirt_size) selected @endif>{{ $key }}</option>
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
                            <input id="interest" name="interest" type="text" class="form-control @error('interest') is-invalid @enderror" value="{{ old('interest', isset($info) ? $info->interest : '') }}" />
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
                            <textarea id="address" name="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', isset($info) ? $info->address : '') }}</textarea>
                            @error('address')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

@include('layouts.footer')
@endsection

@section('scripts')
<script type="module">
    $(document).ready(function() {
        $('#updateButton').click(function(e) {
            $('#updateForm').submit();
        });

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
@endsection
