@extends('layouts.app')

@section('title', 'แก้ไขประวัติครอบครัว')

@section('styles')
@php
    use App\Helpers\Auth;
@endphp
@endsection

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>แก้ไขประวัติครอบครัว</h1>
        <ul>
            <li>แก้ไขประวัติครอบครัว</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a id="updateButton" href="#" class="btn btn_success uppercase">
            <span class="la la-download text-xl leading-none mr-2"></span>
            บันทึก
        </a>

        <a href="{{ route('family_information.index') }}" class="btn btn_danger uppercase">
            <span class="la la-times text-xl leading-none mr-2"></span>
            ยกเลิก
        </a>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <form id="updateForm" action="{{ route('family_information.update') }}" method="POST">
            @csrf

            <table class="table table_borderless w-full">
                <tbody>
                    <tr>
                        <td class="w-1/4 text-right font-bold">
                            <label for="family_status_id">สถานะครอบครัว</label>
                        </td>
                        <td class="w-3/4 text-left">
                            <div class="custom-select">
                                <select id="family_status_id" name="family_status_id" class="form-control @error('family_status_id') is-invalid @enderror" required autofocus>
                                    @foreach ($family_status as $e)
                                        <option value="{{ $e->id }}" @if ($e->id == $info->family_status->id) selected @endif>{{ $e->title }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('family_status_id')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="father_first_name_th">ชื่อ บิดา</label>
                        </td>
                        <td class="text-left">
                            <input id="father_first_name_th" name="father_first_name_th" type="text" class="form-control @error('father_first_name_th') is-invalid @enderror" value="{{ old('father_first_name_th', isset($info) ? $info->father_first_name_th : '') }}" maxlength="50" required />
                            @error('father_first_name_th')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="father_last_name_th">นามสกุล บิดา</label>
                        </td>
                        <td class="text-left">
                            <input id="father_last_name_th" name="father_last_name_th" type="text" class="form-control @error('father_last_name_th') is-invalid @enderror" value="{{ old('father_last_name_th', isset($info) ? $info->father_last_name_th : '') }}" maxlength="50" required />
                            @error('father_last_name_th')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="father_first_name_en">First Name</label>
                        </td>
                        <td class="text-left">
                            <input id="father_first_name_en" name="father_first_name_en" type="text" class="form-control @error('father_first_name_en') is-invalid @enderror" value="{{ old('father_first_name_en', isset($info) ? $info->father_first_name_en : '') }}" maxlength="50" required />
                            @error('father_first_name_en')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="father_last_name_en">Last Name</label>
                        </td>
                        <td class="text-left">
                            <input id="father_last_name_en" name="father_last_name_en" type="text" class="form-control @error('father_last_name_en') is-invalid @enderror" value="{{ old('father_last_name_en', isset($info) ? $info->father_last_name_en : '') }}" maxlength="50" required />
                            @error('father_last_name_en')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="father_life">สถานะ บิดา</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="father_life" name="father_life" class="form-control @error('father_life') is-invalid @enderror" required>
                                    @foreach ($life as $key)
                                        <option value="{{ $key }}" @if ($key == $info->father_life) selected @endif>{{ Auth::convertLifeFromENToTH($key) }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('father_life')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="father_income">รายได้ บิดา</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="father_income" name="father_income" class="form-control @error('father_income') is-invalid @enderror" required>
                                    @foreach ($income as $key)
                                        <option value="{{ $key }}" @if ($key == $info->father_income) selected @endif>{{ Auth::convertIncomeFromENToTH($key) }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('father_income')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="father_career_id">อาชีพ บิดา</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="father_career_id" name="father_career_id" class="form-control @error('father_career_id') is-invalid @enderror" required>
                                    @foreach ($careers as $e)
                                        <option value="{{ $e->id }}" @if ($e->id == $info->father_career->id) selected @endif>{{ $e->title }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('father_career_id')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="mother_first_name_th">ชื่อ มารดา</label>
                        </td>
                        <td class="text-left">
                            <input id="mother_first_name_th" name="mother_first_name_th" type="text" class="form-control @error('mother_first_name_th') is-invalid @enderror" value="{{ old('mother_first_name_th', isset($info) ? $info->mother_first_name_th : '') }}" maxlength="50" required />
                            @error('mother_first_name_th')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="mother_last_name_th">นามสกุล มารดา</label>
                        </td>
                        <td class="text-left">
                            <input id="mother_last_name_th" name="mother_last_name_th" type="text" class="form-control @error('mother_last_name_th') is-invalid @enderror" value="{{ old('mother_last_name_th', isset($info) ? $info->mother_last_name_th : '') }}" maxlength="50" required />
                            @error('mother_last_name_th')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="mother_first_name_en">First Name</label>
                        </td>
                        <td class="text-left">
                            <input id="mother_first_name_en" name="mother_first_name_en" type="text" class="form-control @error('mother_first_name_en') is-invalid @enderror" value="{{ old('mother_first_name_en', isset($info) ? $info->mother_first_name_en : '') }}" maxlength="50" required />
                            @error('mother_first_name_en')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="mother_last_name_en">Last Name</label>
                        </td>
                        <td class="text-left">
                            <input id="mother_last_name_en" name="mother_last_name_en" type="text" class="form-control @error('mother_last_name_en') is-invalid @enderror" value="{{ old('mother_last_name_en', isset($info) ? $info->mother_last_name_en : '') }}" maxlength="50" required />
                            @error('mother_last_name_en')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="mother_life">สถานะ มารดา</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="mother_life" name="mother_life" class="form-control @error('mother_life') is-invalid @enderror" required>
                                    @foreach ($life as $key)
                                        <option value="{{ $key }}" @if ($key == $info->mother_life) selected @endif>{{ Auth::convertLifeFromENToTH($key) }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('mother_life')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="mother_income">รายได้ มารดา</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="mother_income" name="mother_income" class="form-control @error('mother_income') is-invalid @enderror" required>
                                    @foreach ($income as $key)
                                        <option value="{{ $key }}" @if ($key == $info->mother_income) selected @endif>{{ Auth::convertIncomeFromENToTH($key) }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('mother_income')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="mother_career_id">อาชีพ มารดา</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="mother_career_id" name="mother_career_id" class="form-control @error('mother_career_id') is-invalid @enderror" required>
                                    @foreach ($careers as $e)
                                        <option value="{{ $e->id }}" @if ($e->id == $info->mother_career->id) selected @endif>{{ $e->title }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('mother_career_id')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="relative_first_name_th">ชื่อ ผู้ปกครอง</label>
                        </td>
                        <td class="text-left">
                            <input id="relative_first_name_th" name="relative_first_name_th" type="text" class="form-control @error('relative_first_name_th') is-invalid @enderror" value="{{ old('relative_first_name_th', isset($info) ? $info->relative_first_name_th : '') }}" maxlength="50" required />
                            @error('relative_first_name_th')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="relative_last_name_th">นามสกุล ผู้ปกครอง</label>
                        </td>
                        <td class="text-left">
                            <input id="relative_last_name_th" name="relative_last_name_th" type="text" class="form-control @error('relative_last_name_th') is-invalid @enderror" value="{{ old('relative_last_name_th', isset($info) ? $info->relative_last_name_th : '') }}" maxlength="50" required />
                            @error('relative_last_name_th')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="relative_first_name_en">First Name</label>
                        </td>
                        <td class="text-left">
                            <input id="relative_first_name_en" name="relative_first_name_en" type="text" class="form-control @error('relative_first_name_en') is-invalid @enderror" value="{{ old('relative_first_name_en', isset($info) ? $info->relative_first_name_en : '') }}" maxlength="50" required />
                            @error('relative_first_name_en')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="relative_last_name_en">Last Name</label>
                        </td>
                        <td class="text-left">
                            <input id="relative_last_name_en" name="relative_last_name_en" type="text" class="form-control @error('relative_last_name_en') is-invalid @enderror" value="{{ old('relative_last_name_en', isset($info) ? $info->relative_last_name_en : '') }}" maxlength="50" required />
                            @error('relative_last_name_en')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="relationship_id">ความสัมพันธ์</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="relationship_id" name="relationship_id" class="form-control @error('relationship_id') is-invalid @enderror" required>
                                    @foreach ($relationship as $e)
                                        <option value="{{ $e->id }}" @if ($e->id == $info->relationship->id) selected @endif>{{ $e->title }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('relationship_id')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="relative_life">สถานะ ผู้ปกครอง</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="relative_life" name="relative_life" class="form-control @error('relative_life') is-invalid @enderror" required>
                                    @foreach ($life as $key)
                                        <option value="{{ $key }}" @if ($key == $info->relative_life) selected @endif>{{ Auth::convertLifeFromENToTH($key) }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('relative_life')
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
                    <tr>
                        <td class="text-right font-bold">
                            <label for="relative_income">รายได้ ผู้ปกครอง</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="relative_income" name="relative_income" class="form-control @error('relative_income') is-invalid @enderror" required>
                                    @foreach ($income as $key)
                                        <option value="{{ $key }}" @if ($key == $info->relative_income) selected @endif>{{ Auth::convertIncomeFromENToTH($key) }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('relative_income')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="relative_career_id">อาชีพ ผู้ปกครอง</label>
                        </td>
                        <td class="text-left">
                            <div class="custom-select">
                                <select id="relative_career_id" name="relative_career_id" class="form-control @error('relative_career_id') is-invalid @enderror" required>
                                    @foreach ($careers as $e)
                                        <option value="{{ $e->id }}" @if ($e->id == $info->relative_career->id) selected @endif>{{ $e->title }}</option>
                                    @endforeach
                                </select>
                                <div class="custom-select-icon la la-caret-down"></div>
                            </div>

                            @error('relative_career_id')
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
    });
</script>
@endsection
