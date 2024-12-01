<table class="table table_borderless w-full">
    <tbody>
        <tr>
            <td class="w-1/4 text-right font-bold">
                วัน เดือน ปีเกิด
            </td>
            <td class="w-3/4 text-left">
                {{ $birthDate ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                น้ำหนัก / ส่วนสูง
            </td>
            <td class="text-left">
                {{ $weight ?? '-' }} / {{ $height ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                อีเมล
            </td>
            <td class="text-left">
                {{ $email ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                เบอร์โทรศัพท์มือถือ
            </td>
            <td class="text-left">
                {{ $tel ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                การได้รับทุน
            </td>
            <td class="text-left">
                {{ $scholarship ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ความพิการ
            </td>
            <td class="text-left">
                {{ $disability ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                หมู่โลหิต
            </td>
            <td class="text-left">
                {{ $bloodType ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                สัญชาติ
            </td>
            <td class="text-left">
                {{ $nationality ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                เชื้อชาติ
            </td>
            <td class="text-left">
                {{ $ethnicity ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ศาสนา
            </td>
            <td class="text-left">
                {{ $religion ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ขนาดเสื้อกิจกรรม
            </td>
            <td class="text-left">
                {{ $shirtSize ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ความถนัด ความสนใจพิเศษ
            </td>
            <td class="text-left">
                {{ $interest ?? '-' }}
            </td>
        </tr>
        <tr>
            <td class="text-right font-bold">
                ที่อยู่
            </td>
            <td class="text-left">
                {{ $address ?? '-' }}
            </td>
        </tr>
    </tbody>
</table>
