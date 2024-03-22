@extends('layouts.app')

@section('header')
    <header class="bg-white shadow m-2 rounded-md">
        <div class="mx-auto max-w-7xl px-2 py-2 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Dashboard</h1>
            </div>
            <div class="">
                <a href="{{ route('task.add') }}"
                    class="relative inline-flex items-center justify-center p-2 px-6 py-1 overflow-hidden font-medium text-indigo-600 transition duration-300 ease-out border-2 border-gray-800 rounded-full shadow-md group">
                    <span
                        class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-gray-800 group-hover:translate-x-0 ease">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </span>
                    <span
                        class="absolute flex items-center justify-center w-full h-full text-black transition-all duration-300 transform group-hover:translate-x-full ease">Add
                        Task</span>
                    <span class="relative invisible">Add Task</span>
                </a>

            </div>

        </div>
    </header>
@endsection

{{-- @section('exited')   

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900 italic">just funn! 🐳</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 quote">
                Footer element can be used to display a site map, followed by copyright information and social media icons.

                Additional navigation on the page includes basic support content such as links, buttons, company information, copyright and forms. The footer can be easily customized to fit your style and is responsive by default.
            </p>
        </div>
    </div>

@endsection --}}

@section('content')
    <div class="min-h-full">
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8 md:grid md:grid-cols-2 md:gap-4">
            <div class="sm:w-full md:w-1/2 bg-white shadow m-2 p-2 rounded-md" style="width:100%">
                <div class="m-1 font-bold md:grid md:grid-cols-2 flex justify-between items-baseline">
                    <div class="">
                        <h4>Posts Graph</h4>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-sm btn-danger">X</a>
                    </div>
                </div>
                <hr>
                <div>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
            <div class="sm:w-full md:w-1/2 bg-white shadow m-2 p-2 rounded-md" style="width: 100%" id="calendar"></div>
        </div>
    </div>
@endsection

@section('js-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var ctx = document.getElementById('barChart').getContext('2d');

            $.ajax({
                type: "GET",
                url: "{{ route('dashboard.chart') }}",
                success: function(response) {
                    var data = response.data ?? [];
                    if (data) {
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.labelsCreated,
                                datasets: [{
                                        label: 'Post',
                                        data: data.data,
                                        backgroundColor: 'rgba(75, 192, 192, 1)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Updated',
                                        data: data.updates,
                                        backgroundColor: 'rgba(255, 99, 132, 1)',
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "{{ route('calendar.data') }}",
                // data: "",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(res) {
                    let tasks = res.tasks;
                    let Events = [];

                    tasks.forEach(element => {
                        Events.push({
                                title: element['name'],
                                start: element['start_date'],
                                end: element['end_date'],
                                url: "http://two2.local/calendar/task/delete/" + element['id']
                            },
                        );
                    });

                    var calendarEl = document.querySelector('#calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: { center: 'dayGridMonth,timeGridWeek,timeGridDay' },
                        events: Events,
                        eventClick: function(info) {
                                info.jsEvent.preventDefault(); // don't let the browser navigate

                                if (info.event.url) {
                                    Swal.fire({
                                        title: "Are you sure?",
                                        text: "You won't be able to revert this!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "Yes, delete it!"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: "GET",
                                                url: info.event.url,
                                                success: function(response) {
                                                    let obj = $(this);
                                                    if (response.success) {
                                                        toastr.success(response.success);
                                                        setTimeout(() => {
                                                            window.location = "{{route('dashboard')}}";
                                                        }, 1000);
                                                    }
                                                    if (response.error) {
                                                        toastr.error(response.error);
                                                    }
                                                }
                                            });
                                        }
                                    });
                                }
                            },
                    });
                    calendar.render();
                }
            });
        });
    </script>
@endsection
