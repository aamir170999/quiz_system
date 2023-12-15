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

                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('exams.index') }}">Exams</a></li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Questions</a></li> --}}

            </ol>
            <div><button class="btn bg-primary "><a class="text-light" href="{{ route('exams.index') }}"> Show All
                        Exams</a></button></div>

        </nav>
    </div>
    <!-- /BREADCRUMB -->






    <div class="card mt-2 ">


        <div class="card-body ">
            <h5 style="border-bottom: 1px solid black;" class="pb-2">Edit Question</h5>


            <form id="updateQuestion" method="post">
                @csrf
                @method('PATCH')


                <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <textarea name="question" id="question" class="form-control form-control-sm " rows="3">{{ $question->question }}</textarea>
                </div>


                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label for="option_a" class="form-label">Option A</label>


                        <input type="text" name="option_a" id="option_a" placeholder="Write Option For a"
                            class="form-control form-control-sm" value="{{ $question->option_a }}">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="option_b" class="form-label">Option B</label>


                        <input type="text" name="option_b" id="option_b" placeholder="Write Option For b"
                            class="form-control form-control-sm" value="{{ $question->option_b }}">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="option_c" class="form-label">Option C</label>


                        <input type="text" name="option_c" id="option_c" placeholder="Write Option For c"
                            class="form-control form-control-sm" value="{{ $question->option_c }}">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="option_d" class="form-label">Option D</label>


                        <input type="text" name="option_d" id="option_d" placeholder="Write Option For d"
                            class="form-control form-control-sm" value="{{ $question->option_d }}">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="option_e" class="form-label">Option E</label>


                        <input type="text" name="option_e" id="option_e" placeholder="Write Option For e"
                            class="form-control form-control-sm" value="{{ $question->option_e }}">
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="option_f" class="form-label">Option F</label>
                        <input type="text" name="option_f" id="option_f" placeholder="Write Option For f"
                            class="form-control form-control-sm" value="{{ $question->option_f }}">
                    </div>

                </div>
                <div class="row">
                    <div class="mb-3 col-4">
                        <label for="correct_option" class="form-label">Correct Option</label>
                        <select id="correct_option" class="form-control form-control-sm" name="correct_option">
                            @foreach (range('a', 'f') as $char)
                                <option
                                    value="{{ $char }}"{{ $question->correct_option == $char ? 'selected' : '' }}>
                                    Option {{ strtoupper($char) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-4">
                        <label for="code_snippet" class="form-label">Code Snippet</label>
                        <textarea name="code_snippet" id="code_snippet" class="form-control form-control-sm " rows="3">{{ $question->code_snippet }}</textarea>
                    </div>

                    <div class="ml-1 col-4">
                        <label for="Answer_Explanation" class="form-label">Answer Explanation</label>
                        <textarea name="Answer_Explanation" id="Answer_Explanation" class="form-control form-control-sm " rows="3">{{ $question->Answer_Explanation }}</textarea>
                    </div>
                </div>

                <h5 style="border-bottom: 1px solid rgba(0, 0, 0, 0.482);" class="pb-2">Supporting Media</h5>


                <div class="row">
                    <div class="mb-3 col-3">

                        <label for="image_file" class="form-label">Image/Figure</label>
                        <input type="file" name="image_file" id="image_file" class="form-control form-control-sm"
                            rows="3" accept="image/*">


                    </div>
                    <div class="mb-3 col-3">
                        <label for="video_file" class="form-label">Video</label>
                        <input type="url" name="video_file" id="video_file"
                            class="form-control form-control-sm " placeholder="@video url" rows="3"
                            value="{{ $question->video_file }}">

                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">update Question</button>
                </div>


            </form>


        </div>

    </div>


    <x-slot:footerFiles>

        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        @vite(['resources/assets/js/components/notification/custom-snackbar.js'])
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('plugins/validation/ajax-validation.js') }}"></script>
        <script>
            formIdentity = '#updateQuestion';
            path = "{{ route('questions.update', $question->id) }}";
            addFormData(formIdentity, path, false);
        </script>

    </x-slot>
</x-base-layout>
