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
        <link rel="stylesheet" href="{{ asset('style.css') }}">
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
            <h5 style="border-bottom: 1px solid black;" class="pb-2">Add Question</h5>


            <form id="storeQuestion" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="exam_id" value="{{ $exam->id }}">


                <div class="mb-3">
                    <label for="question" class="form-label needed">Question</label>
                    <textarea name="question" id="question" class="form-control form-control-sm " rows="3"></textarea>

                </div>
                <div class="alert border-0 text-center bold" role="alert">

                    ! ! ! All the options should be unique ! ! !
                </div>

                <div class="row">
                    @foreach (range('a', 'd') as $char)
                        <div class="mb-3 col-md-4">
                            <label for="option_{{ $char }}" class="form-label needed">Option
                                {{ Strtoupper($char) }}</label>


                            <input type="text" name="option_{{ $char }}" id="option_{{ $char }}"
                                placeholder="Write Option For {!! ucfirst($char) !!}"
                                class="form-control form-control-sm " value="{{ old('option_' . $char) }}">
                        </div>
                    @endforeach
                    <div class="moreoptionbtn col-md-4  border border-gray-200 ">
                        <a   href="javascript:void(0)" id="toggleOptionsButton" onclick="toggleNullableOptions()">More
                            Options</a>
                    </div>


                    <div id="nullableOptions" class="fade-in" style="display: none;">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="option_e" class="form-label">Option E</label>
                                <input type="text" name="option_e" id="option_e" placeholder="Write Option For E"
                                    class="form-control form-control-sm" value="{{ old('option_e') }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="option_f" class="form-label">Option F</label>
                                <input type="text" name="option_f" id="option_f" placeholder="Write Option For F"
                                    class="form-control form-control-sm" value="{{ old('option_f') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="correct_option" class="form-label needed">Correct Option</label>
                    <select id="correct_option" class="form-control" name="correct_option">
                        @foreach (range('a', 'f') as $char)
                            <option value="{{ $char }}">Option {{ strtoupper($char) }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="d-flex justify-content-around">
                    <div class="mb-3 col-4">
                        <label for="code_snippet" class="form-label">Code Snippet</label>
                        <textarea name="code_snippet" id="code_snippet" class="form-control form-control-sm " rows="3"></textarea>
                    </div>

                    <div class="ml-1 col-4">
                        <label for="Answer_Explanation" class="form-label">Answer Explanation</label>
                        <textarea name="Answer_Explanation" id="Answer_Explanation" class="form-control form-control-sm " rows="3"></textarea>
                    </div>

                </div>
                <h5 style="border-bottom: 1px solid rgba(0, 0, 0, 0.482);" class="pb-2">Supporting Media</h5>

                <div class="d-flex justify-content-around">
                    <div class="mb-3 col-3">
                        <label class="form-label"style="border-bottom: 1px solid rgba(0, 0, 0, 0.482);">Select Media
                            Type:</label>
                        <div>
                            <input type="radio" id="media_type_image" name="media_type" value="image" checked>
                            <label for="media_type_image">Image/Figure</label>
                        </div>
                        <div>
                            <input type="radio" id="media_type_video" name="media_type" value="video">
                            <label for="media_type_video">Video</label>
                        </div>
                    </div>
                    <div class="mb-3 col-3" id="imageFileContainer">
                        <div class="d-flex">
                            <div>
                                <label for="image_file" class="form-label">Image/Figure</label>
                                <input type="file" name="image_file" id="image_file" class="form-control"
                                    accept="image/*">
                            </div>
                            <div>
                                <button type="button" style="margin-left:25px; margin-top:35px;"
                                    class="btn btn-outline-danger"onclick="clearImageFile()">Clear</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-3" id="videoFileContainer" style="display: none;">
                        <label for="video_file" class="form-label">Video</label>
                        <input type="url" name="video_file" id="video_file" class="form-control"
                            placeholder="@video url">
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </div>


            </form>


        </div>

    </div>



    <div class="card mt-2 ">
        <div class="card-body ">
            <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.429);"
                class="d-flex justify-content-between align-items-center  mb-3">
                <div class="ml-0 float-start">
                    <h5>Questions</h5>
                </div>
                <div class="float-end">
                    <h5 class="btn btn-outline-primary">Total Question : {{ $totalQuestions }}</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>

                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Question</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($questions as $question)
                            <tr>
                                <td class="text-center">
                                    {{ ($questions->currentPage() - 1) * $questions->perPage() + $loop->index + 1 }}
                                </td>
                                <td>
                                    {{ $question->question }}

                                    <div>
                                        <ol type="A">

                                            @foreach (range('a', 'f') as $char)
                                                <li
                                                    class="{{ $question->correct_option === $char ? 'text-success fw-bold' : 'text-secondary' }} ">
                                                    {{ $question['option_' . $char] ?? 'Not Added' }}
                                                </li>
                                            @endforeach
                                        </ol>

                                        <form id="deletequestion" method="POST" class="d-inline"
                                            action="{{ route('questions.destroy', $question->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="mt-2 ml-0">
                                                <button type="submit" class="btn btn-danger btn-sm "
                                                    onclick="return confirmDelete(this)">Delete</button>
                                        </form>
                                        <a href="{{ route('questions.edit', $question->id) }}"
                                            class="btn btn-primary btn-sm">EDIT</a>
                                    </div>
            </div>
            </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">no question added!!</td>

            </tr>
            @endforelse
            <div class="pagination-container">
                {{ $questions->links() }}
            </div>
            </table>
        </div>
    </div>
    </div>


    <x-slot:footerFiles>

        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        @vite(['resources/assets/js/components/notification/custom-snackbar.js'])
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('plugins/validation/ajax-validation.js') }}"></script>


        <script>
            formIdentity = '#storeQuestion';
            path = "{{ route('questions.store', $exam->id) }}";
            addFormData(formIdentity, path);
        </script>

        <script>
            document.querySelectorAll('input[name="media_type"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (this.value === 'image') {
                        document.getElementById('imageFileContainer').style.display = 'block';
                        document.getElementById('videoFileContainer').style.display = 'none';
                    } else {
                        document.getElementById('imageFileContainer').style.display = 'none';
                        document.getElementById('videoFileContainer').style.display = 'block';
                    }
                });
            });
        </script>

       <script>
            function clearImageFile() {
                document.getElementById('image_file').value = '';

            }
        </script>


        <script>
            function confirmDelete(button) {
                if (confirm("This exam will be removed  are you sure ?")) {
                    return true;
                }
                return false;
            }
        </script>

        <script>
            function toggleNullableOptions() {
                var nullableOptions = document.getElementById('nullableOptions');
                var toggleButton = document.getElementById('toggleOptionsButton');

                if (nullableOptions.style.display === 'none') {
                    nullableOptions.style.display = 'block';
                    nullableOptions.classList.add('fade-in');
                    toggleButton.textContent = 'Less Options';
                } else {
                    nullableOptions.style.display = 'none';
                    toggleButton.textContent = 'More Options';
                }
            }
        </script>
    </x-slot>
</x-base-layout>
