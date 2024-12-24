@php
    use App\Helpers\Auth;

    $paths = explode('/', request()->path());
    $path = end($paths);
@endphp

<table class="table table_borderless w-full">
    <tbody>
        @if($path != 'create')
            <tr>
                <td class="w-1/4 text-right font-bold">
                    รหัสอาจารย์
                </td>
                <td class="w-3/4 text-left">
                    {{ $info->employee_id ?? '-' }}
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
                        <option>ตัวเลือก...</option>

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
                <label for="tel">เบอร์โทรศัพท์มือถือ</label>
                <p class="text-xs font-light mt-0.5">(ไม่จำเป็น)</p>
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
    </tbody>
</table>
