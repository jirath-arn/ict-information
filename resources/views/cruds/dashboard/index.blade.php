@extends('layouts.app')

@section('title', 'แดชบอร์ด')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>แดชบอร์ด</h1>
        <ul>
            <li>แดชบอร์ด</li>
        </ul>
    </section>
</div>

<div class="grid lg:grid-cols-2 gap-5">
    {{-- Left Side --}}
    <div class="flex flex-col gap-y-5">
        {{-- Level Year Chart --}}
        <div class="card p-5">
            <h3>ชั้นปีการศึกษา</h3>
            <div class="mt-5 flex justify-center items-center">
                <canvas id="levelYearChart"></canvas>
            </div>
        </div>

        {{-- Student Status Chart --}}
        <div class="card p-5">
            <h3>สถานะนักศึกษา</h3>
            <div class="mt-5 flex justify-center items-center">
                <canvas id="studentStatusChart" height="400"></canvas>
            </div>
        </div>
    </div>

    {{-- Right Side --}}
    <div class="flex flex-col gap-y-5">
        {{-- Students --}}
        <div class="grid sm:grid-cols-3 gap-5">
            <div class="flex flex-col gap-y-5">
                {{-- New Students --}}
                <div class="card p-5">
                    <h3>นักศึกษาใหม่</h3>
                    <h4 class="chart-value text-2xl mt-2 text-center">{{ $info->student->new }}</h4>
                </div>
            </div>

            <div class="flex flex-col gap-y-5">
                {{-- Studying --}}
                <div class="card p-5">
                    <h3>กำลังศึกษาอยู่</h3>
                    <h4 class="chart-value text-2xl mt-2 text-center">{{ $info->student->studying }}</h4>
                </div>
            </div>

            <div class="flex flex-col gap-y-5">
                {{-- Graduated --}}
                <div class="card p-5">
                    <h3>จบการศึกษา</h3>
                    <h4 class="chart-value text-2xl mt-2 text-center">{{ $info->student->graduated }}</h4>
                </div>
            </div>
        </div>

        {{-- Scholarship --}}
        <div class="grid sm:grid-cols-2 gap-5">
            <div class="flex flex-col gap-y-5">
                {{-- Received Scholarship --}}
                <div class="card p-5">
                    <h3>ได้รับทุน</h3>
                    <h4 class="chart-value text-2xl mt-2 text-center">{{ $info->scholarship->received }}</h4>
                </div>
            </div>

            <div class="flex flex-col gap-y-5">
                {{-- Not Funded --}}
                <div class="card p-5">
                    <h3>ไม่ได้รับทุน</h3>
                    <h4 class="chart-value text-2xl mt-2 text-center">{{ $info->scholarship->not_funded }}</h4>
                </div>
            </div>
        </div>

        {{-- Student Type --}}
        <div class="grid sm:grid-cols-2 gap-5">
            <div class="flex flex-col gap-y-5">
                {{-- Normal --}}
                <div class="card p-5">
                    <h3>นักศึกษาปกติ</h3>
                    <h4 class="chart-value text-2xl mt-2 text-center">{{ $info->student_type->normal }}</h4>
                </div>
            </div>

            <div class="flex flex-col gap-y-5">
                {{-- Transfer --}}
                <div class="card p-5">
                    <h3>นักศึกษาเทียบโอน</h3>
                    <h4 class="chart-value text-2xl mt-2 text-center">{{ $info->student_type->transfer }}</h4>
                </div>
            </div>
        </div>

        {{-- Education Chart --}}
        <div class="card p-5">
            <h3>ระดับการศึกษาเดิม</h3>
            <div class="mt-5 flex justify-center items-center">
                <canvas id="educationChart"></canvas>
            </div>
        </div>

        {{-- Religion & Shirt Size --}}
        <div class="grid lg:grid-cols-2 gap-5">
            <div class="flex flex-col gap-y-5">
                {{-- Religion Chart --}}
                <div class="card p-5">
                    <h3>ศาสนา</h3>
                    <div class="mt-5 flex justify-center items-center">
                        <canvas id="religionChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-5">
                {{-- Shirt Size Chart --}}
                <div class="card p-5">
                    <h3>ขนาดเสื้อ</h3>
                    <div class="mt-5 flex justify-center items-center">
                        <canvas id="shirtSizeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection

@section('scripts')
<script type="module">
    $(document).ready(function() {
        const info = @json($info);

        // Level Year Chart.
        new Chart($('#levelYearChart'), {
            type: 'line',
            data: {
                labels: [
                    'ชั้นปีที่ 1',
                    'ชั้นปีที่ 2',
                    'ชั้นปีที่ 3',
                    'ชั้นปีที่ 4',
                    'ชั้นปีที่ 5',
                    'ชั้นปีที่ 6',
                    'ชั้นปีที่ 7',
                    'ชั้นปีที่ 8'
                ],
                datasets: [
                    {
                        data: info['level_year']['data'],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }
                ]
            },
            options: {
                elements: {
                    line: {
                        borderWidth: 2
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Student Status Chart.
        new Chart($('#studentStatusChart'), {
            type: 'bar',
            data: {
                labels: info['student_status']['labels'],
                datasets: [
                    {
                        axis: 'y',
                        data: info['student_status']['data'],
                        fill: false,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)',
                            'rgba(255, 99, 71, 0.2)',
                            'rgba(106, 90, 205, 0.2)',
                            'rgba(244, 164, 66, 0.2)',
                            'rgba(0, 128, 128, 0.2)',
                            'rgba(128, 0, 128, 0.2)',
                            'rgba(32, 178, 170, 0.2)',
                            'rgba(255, 69, 0, 0.2)',
                            'rgba(0, 255, 127, 0.2)',
                            'rgba(210, 105, 30, 0.2)',
                            'rgba(0, 191, 255, 0.2)',
                            'rgba(255, 20, 147, 0.2)',
                            'rgba(135, 206, 235, 0.2)',
                            'rgba(34, 139, 34, 0.2)',
                            'rgba(255, 105, 180, 0.2)',
                            'rgba(255, 228, 181, 0.2)',
                            'rgba(128, 128, 0, 0.2)',
                            'rgba(255, 140, 0, 0.2)',
                            'rgba(173, 216, 230, 0.2)',
                            'rgba(255, 250, 205, 0.2)',
                            'rgba(255, 182, 193, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)',
                            'rgb(255, 99, 71)',
                            'rgb(106, 90, 205)',
                            'rgb(244, 164, 66)',
                            'rgb(0, 128, 128)',
                            'rgb(128, 0, 128)',
                            'rgb(32, 178, 170)',
                            'rgb(255, 69, 0)',
                            'rgb(0, 255, 127)',
                            'rgb(210, 105, 30)',
                            'rgb(0, 191, 255)',
                            'rgb(255, 20, 147)',
                            'rgb(135, 206, 235)',
                            'rgb(34, 139, 34)',
                            'rgb(255, 105, 180)',
                            'rgb(255, 228, 181)',
                            'rgb(128, 128, 0)',
                            'rgb(255, 140, 0)',
                            'rgb(173, 216, 230)',
                            'rgb(255, 250, 205)',
                            'rgb(255, 182, 193)'
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Education Chart.
        new Chart($('#educationChart'), {
            type: 'bar',
            data: {
                labels: info['education']['labels'],
                datasets: [
                    {
                        data: info['education']['data'],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)',
                            'rgba(128, 0, 128, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)',
                            'rgb(128, 0, 128)'
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Religion Chart.
        new Chart($('#religionChart'), {
            type: 'pie',
            data: {
                labels: info['religion']['labels'],
                datasets: [
                    {
                        data: info['religion']['data'],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1,
                        hoverOffset: 4
                    }
                ]
            }
        });

        // Shirt Size Chart.
        new Chart($('#shirtSizeChart'), {
            type: 'doughnut',
            data: {
                labels: info['shirt_size']['labels'],
                datasets: [
                    {
                        data: info['shirt_size']['data'],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)',
                            'rgba(128, 0, 128, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)',
                            'rgb(128, 0, 128)'
                        ],
                        borderWidth: 1,
                        hoverOffset: 4
                    }
                ]
            }
        });
    });
</script>
@endsection
