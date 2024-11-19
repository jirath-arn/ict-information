<table class="table table_borderless w-full">
    <tbody>
        <tr>
            <td class="w-1/4 text-right font-bold">
                รหัสนักศึกษา
            </td>
            <td class="w-3/4 text-left">
                {{ $studentId ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ชื่อ - นามสกุล
            </td>
            <td class="text-left">
                {{ $fullNameWithPrefixTh ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                Full Name
            </td>
            <td class="text-left">
                {{ $fullNameWithPrefixEn ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                อีเมล Rmutto
            </td>
            <td class="text-left">
                {{ $rmuttoEmail ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                สถานะนักศึกษา
            </td>
            <td class="text-left">
                {{ $studentStatus ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ชั้นปีที่
            </td>
            <td class="text-left">
                {{ $level ?? '-' }} / {{ $year ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                อาจารย์ที่ปรึกษา
            </td>
            <td class="text-left">
                {{ $advisorFullNameWithPrefixTh ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                เบอร์โทรศัพท์ติดต่อ
            </td>
            <td class="text-left">
                {{ $advisorTel ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                อีเมล Rmutto
            </td>
            <td class="text-left">
                {{ $advisorRmuttoEmail ?? '-' }}
            </td>
        </tr>
    </tbody>
</table>
