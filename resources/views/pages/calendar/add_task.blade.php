@extends('layouts.app')

@section('js-css-ss')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('header')
    <header class="bg-white shadow m-2 rounded-md">
        <div class="mx-auto max-w-7xl px-2 py-2 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Add Calendar Task</h1>
            </div>
            <div class="">
                <a href="{{ url()->previous() }}"
                    class="relative inline-flex items-center justify-center p-2 px-6 py-1 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out border-2 border-gray-800 rounded-full shadow-md group">
                    <span
                        class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-gray-800 group-hover:translate-x-0 ease">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M11.0002 4.58569L3.58594 11.9999L11.0002 19.4141L12.4144 17.9999L7.41436 12.9999H20.0002V10.9999H7.41436L12.4144 5.99991L11.0002 4.58569Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span
                        class="absolute flex items-center justify-center w-full h-full text-black transition-all duration-300 transform group-hover:translate-x-full ease">Back</span>
                    <span class="relative invisible">Back</span>
                </a>

            </div>

        </div>
    </header>
@endsection

@section('exited')
    @include('excited.qoute')
@endsection

@section('content')
    <div class="min-h-full">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 w-3/4">
            <div class="alert alert-success" role="alert" id="successMsg" style="display: none">
                Thank you for getting in touch!
            </div>
            <form id="calendarTaskForm">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                    Name
                                </label>
                                <input type="text" id="name" name="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2. dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="John" value="{{ old('name') }}" autocomplete="name">
                                <span class="mt-2 text-red-600" id="nameErrorMsg"></span>

                            </div>

                            <div class="col-span-full">

                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                                    Description
                                </label>

                                <textarea id="description" name="description" rows="3"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write your thoughts here..." value="{{ old('description') }}" autocomplete="description"></textarea>
                                <span class="mt-2 text-red-600" id="descriptionErrorMsg"></span>

                            </div>

                            <div class="col-span-full">
                                <div class="inline-block">

                                    <label class="block text-sm font-medium leading-6 text-gray-900">
                                        Start Date
                                    </label>
                                    <input type="text" id="startDate" name="startDate"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2. dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="yyyy-mm-dd" value="{{ old('startDate') }}" autocomplete="startDate">

                                    <span class="mt-2 text-red-600" id="startDateErrorMsg"></span>

                                </div>
                                <div class="inline-block">

                                    <label class="block text-sm font-medium leading-6 text-gray-900">
                                        End Date
                                    </label>
                                    <input type="text" id="endDate" name="endDate"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2. dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="yyyy-mm-dd" value="{{ old('endDate') }}" autocomplete="endDate">

                                    <span class="mt-2 text-red-600" id="endDateErrorMsg"></span>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" id="resetForm"
                        class="text-sm font-semibold leading-6 text-gray-900">Reset</button>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        id="submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $("#startDate, #endDate").datepicker({
                    autoclose: true,
                    dateFormat: "yy-mm-dd"
                });
            });

            $('#calendarTaskForm').submit(function(e) {
                e.preventDefault();

                let name = $("#name").val();
                let description = $("#description").val();
                let startDate = $("#startDate").val();
                let endDate = $("#endDate").val();
                // let form  = $('#postCreateForm')[0]
                let formdata = new FormData();
                formdata.append('name', name);
                formdata.append('description', description);
                formdata.append('start_date', startDate);
                formdata.append('end_date', endDate);

                $("#submitBtn").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "{{ route('task.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success)
                        }
                        if (response.error) {
                            toastr.error(response.error)
                        }
                        $("#name").val('');
                        $("#description").val('');
                        $("#startDate").val('');
                        $("#endDate").val('');
                        $("#submitBtn").prop("disabled", false);
                    },
                    error: function(response) {

                        var errors = response.responseJSON.errors;

                        $.map(errors, function(elementOrValue, indexOrKey) {
                            toastr.options.progressBar = true;
                            toastr.options.closeButton = true;
                            toastr.error(elementOrValue[0]);
                        });

                        $("#submitBtn").prop("disabled", false);

                    },

                });
            });

            $('#resetForm').on('click', function() {
                $("#name").val('');
                $("#description").val('');
                $("#startDate").val('');
                $("#endDate").val('');
            })
        });
    </script>
@endsection
