<table class="table table_borderless w-full">
    <tbody>
        <tr>
            <td class="w-1/4 text-right font-bold">
                สถานะครอบครัว
            </td>
            <td class="w-3/4 text-left">
                {{ $familyStatus ?? '-' }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr />
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ชื่อ - นามสกุล บิดา
            </td>
            <td class="text-left">
                {{ $fatherFullNameTh ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                Full Name
            </td>
            <td class="text-left">
                {{ $fatherFullNameEn ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                สถานะ บิดา
            </td>
            <td class="text-left">
                {{ $fatherLife ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                รายได้ บิดา
            </td>
            <td class="text-left">
                {{ $fatherIncome ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                อาชีพ บิดา
            </td>
            <td class="text-left">
                {{ $fatherCareer ?? '-' }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr />
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ชื่อ - นามสกุล มารดา
            </td>
            <td class="text-left">
                {{ $motherFullNameTh ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                Full Name
            </td>
            <td class="text-left">
                {{ $motherFullNameEn ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                สถานะ มารดา
            </td>
            <td class="text-left">
                {{ $motherLife ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                รายได้ มารดา
            </td>
            <td class="text-left">
                {{ $motherIncome ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                อาชีพ มารดา
            </td>
            <td class="text-left">
                {{ $motherCareer ?? '-' }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr />
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ชื่อ - นามสกุล ผู้ปกครอง
            </td>
            <td class="text-left">
                {{ $relativeFullNameTh ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                Full Name
            </td>
            <td class="text-left">
                {{ $relativeFullNameEn ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ความสัมพันธ์
            </td>
            <td class="text-left">
                {{ $relationship ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                สถานะ ผู้ปกครอง
            </td>
            <td class="text-left">
                {{ $relativeLife ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ที่อยู่
            </td>
            <td class="text-left">
                {{ $relativeAddress ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                รายได้ ผู้ปกครอง
            </td>
            <td class="text-left">
                {{ $relativeIncome ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                อาชีพ ผู้ปกครอง
            </td>
            <td class="text-left">
                {{ $relativeCareer ?? '-' }}
            </td>
        </tr>
    </tbody>
</table>
