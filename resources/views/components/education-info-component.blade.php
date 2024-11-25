<table class="table table_borderless w-full">
    <tbody>
        <tr>
            <td class="w-1/4 text-right font-bold">
                ระดับการศึกษาเดิม
            </td>
            <td class="w-3/4 text-left">
                {{ $education ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                สถานที่ศึกษาเดิม
            </td>
            <td class="text-left">
                {{ $nameSchool ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                วุฒิการศึกษาเดิม
            </td>
            <td class="text-left">
                {{ $qualification ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                สำเร็จการศึกษาเมื่อปี พ.ศ.
            </td>
            <td class="text-left">
                {{ $graduateYear ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                เกรดเฉลี่ยที่สำเร็จการศึกษา
            </td>
            <td class="text-left">
                {{ $gpa ?? '-' }}
            </td>
        </tr>
    </tbody>
</table>
