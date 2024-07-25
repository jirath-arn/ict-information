@extends('layouts.app')

@section('title', 'Student Information')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>Student Information</h1>
        <ul>
            <li>Student Information</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <button class="btn btn_primary uppercase">
            <span class="la la-edit text-xl leading-none mr-2"></span>
            Edit
        </button>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <table class="table table_borderless w-full">
            <tbody>
                <tr>
                    <td class="w-1/4 text-right">
                        <strong>Student ID</strong>
                    </td>
                    <td class="w-3/4 text-left">
                        20000000000-0
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 text-right">
                        <strong>Fullname</strong>
                    </td>
                    <td class="w-3/4 text-left">
                        Mr.Fdssdf Gfdfvdf
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 text-right">
                        <strong>ID Card</strong>
                    </td>
                    <td class="w-3/4 text-left">
                        1200938293049
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 text-right">
                        <strong>Rmutto Email</strong>
                    </td>
                    <td class="w-3/4 text-left">
                        fvrf@rmutto.ac.th
                    </td>
                </tr>
                <tr>
                    <td class="w-1/4 text-right">
                        <strong>ชื่อ - นามสกุล</strong>
                    </td>
                    <td class="w-3/4 text-left">
                        fvrf@rmutto.ac.th
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
