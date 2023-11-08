<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        Exams
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}">
        @vite(['resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss'])
        <!--  END CUSTOM STYLE FILE  -->

    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="page-meta">
        <nav class="breadcrumb-style-one d-flex justify-content-between align-content-center" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Datatables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Custom</li>
            </ol>
            <div><button class="btn bg-primary "><a class="text-light" href="{{ route('exams.index') }}"> Show All
                        Exams</a></button></div>

        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="background--custom mt-3">
        <div class="card ">
            <div class="card-body">
                <h5 style="border-bottom: 1px solid black;" class="pb-2">Add New Exam</h5>

                <form id="storeExam" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label needed">Exam Title </label>
                        <input type="text" class="form-control form-control-sm" name="title" id="title"
                            placeholder="Mid Exams 2023-24" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label" id="title">Description</label>
                        <textarea class="form-control form-control-sm " name="description" id="description" placeholder="exam description"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="total_marks" class="form-label needed">Total marks</label>
                            <input type="number" class="form-control form-control-sm" name="total_marks"
                                id="total_marks" placeholder=" eg:100">
                        </div>
                        <div class="col-md-4 mb-4 ">
                            <label for="time" class="form-label needed">Time (in minutes)</label>
                            <input type="number" name="time" class="form-control form-control-sm" id="time">
                        </div>
                        <div class="col-md-4 mb-4 ">
                            <label for="marks_per_question" class="form-label needed">Marks Per Question</label>
                            <input type="number" name="marks_per_question" class="form-control form-control-sm"
                                id="marks_per_question">
                        </div>
                        <div class="col-md-4 mb-4 ">
                            <label for="time" class="form-label ">Difficulty</label>
                            <select name="difficulty" id="colorDropdown" class="form-control form-control-sm">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" name="is_paid" value="yes">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Paid Quiz?</label>
                            </div>
                            <div class="col-md-4 mb-4 " style="display: none;" id="exam_fees">
                                <label for="exam_fees" class="form-label needed">Exam Fees</label>
                                <input type="number" name="exam_fees" class="form-control form-control-sm"
                                    placeholder="Enter Exam Fees" />
                            </div>
                        </div>
                        <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitch"
                                name="show_answer" value="yes" />
                            <label class="form-check-label" for="flexSwitch">Show Answer</label>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Exam</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- footer javaScript --}}
    <x-slot:footerFiles>
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        @vite(['resources/assets/js/components/notification/custom-snackbar.js'])
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('plugins/validation/ajax-validation.js') }}"></script>


        <script>
            formIdentity = '#storeExam';
            path = "{{ route('exams.store') }}";
            addFormData(formIdentity, path);

            const checkbox = document.getElementById("flexSwitchCheckChecked");
            const inputField = document.getElementById("exam_fees");

            checkbox.addEventListener("change", function() {
                inputField.style.display = this.checked ? "block" : "none";
            });
        </script>

    </x-slot>

</x-base-layout>
