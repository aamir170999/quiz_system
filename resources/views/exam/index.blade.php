<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title = 'index' }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/custom_dt_custom.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/custom_dt_custom.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one d-flex justify-content-between align-content-center" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Exams</li>
            </ol>
            <div><button class="btn bg-primary "><a class="text-light" href="{{ route('exams.create') }}"> Create
                        Exam</a></button></div>

        </nav>
    </div>
    <!-- /BREADCRUMB -->



    <div class="row layout-spacing mt-3">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <table id="examTable" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Time(Minutes)</th>
                                <th>total_marks</th>
                                <th>marks_per_question</th>
                                <th>difficulty</th>
                                <th class="text-center">created At</th>
                                <th>Show Answer</th>
                                <th>Exam Fees</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script type="module" src="{{ asset('plugins/global/vendors.min.js') }}"></script>
        @vite(['resources/assets/js/custom.js'])
        <script type="module" src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>




        <script type="module">
            $('#examTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('exams.datatable') }}",
                },
                columns: [{
                        // used for  lead name
                        data: 'title',
                        name: 'title',
                    },
                    {
                data: 'description',
                name: 'description',
                render: function (data, type, row) {
                    if (type === 'display') {
                        return data.length > 15 ? data.substr(0,15) + '...' : data;
                    }
                    return data;
                },
            },
                    {
                        data: 'time',
                        name: 'time',
                    },
                    {
                        data: 'total_marks',
                        name: 'total_marks',
                    },
                    {
                        data: 'marks_per_question',
                        name: 'marks_per_question',
                    },
                    {
                        data: 'difficulty',
                        name: 'difficulty',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'show_answer',
                        name: 'show_answer',
                    },
                    {
                        data: 'exam_fees',
                        name: 'exam_fees',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });
        </script>
         <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
         <script src="{{ asset('assets/js/custom.js') }}"></script>

        <script>
            function handleDelete(id) {
                let deletAbleURL = "{{ route('exams.destroy', 'formId') }}";
                let url = deletAbleURL.replace('formId', id);
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url,
                        method: 'POST',
                        data: {
                            '_method': 'DELETE',
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(data) {
                            $('#examTable').DataTable().ajax.reload();
                            Snackbar.show({
                                //success
                                text: data.success,
                                pos: 'bottom-right',
                                actionTextColor: '#fff',
                                backgroundColor: '#00ab55',
                                actionText: 'X'
                            });
                        },
                        error: function(error) {
                            Snackbar.show({
                                // danger
                                text: 'Errors! Please try again.',
                                pos: 'bottom-right',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a',
                                actionText: 'X'
                            });
                        }
                    });
                }
            }
        </script>

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
