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

            </ol>
            <div><button class="btn bg-primary "><a class="text-light" href="{{ route('exams.index') }}"> Show All
                        Exams</a></button></div>

        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="card mt-2 ">
        <div class="card-body ">
        <h5 style="border-bottom: 1px solid black;" class="pb-2">Questions</h5>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>

                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Question</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($exam->questions as $question)
                                        <tr>
                                            <td class="text-center mx-0">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $question->question }}

                                                <div>
                                                    <ol  type="A">
                                                        @foreach (range('a', 'f') as $char)
                                                            <li class="{{ $question->correct_option === $char ? 'text-success fw-bold' : 'text-secondary' }}">
                                                                {{ $question['option_' . $char] ?? 'Not Added' }}
                                                            </li>
                                                        @endforeach
                                                         <form id="deletequestion" method="POST" class="d-inline"
                                                            {{-- action="{{ route('questions.destroy', $question->id) }}" --}}
                                                            onsubmit="return confirmDelete(event)">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm "
                                                                onclick="return confirmDelete(this)">Delete</button>
                                                            </form>
                                 {{--   <a href="javascript:void(0)" class="btn btn-secondary btn-sm" onclick="editQuestion({{ $question->id }})">EDIT</a> --}}
                                                        </ol>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">no question added!!</td>

                                        </tr>
                                        @endforelse

                </tbody>
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
            path = "{{ route('questions.store') }}";
            addFormData(formIdentity, path);
        </script>

<script>
    function confirmDelete(button) {
        if (confirm("This exam will be removed  are you sure ?")) {
            return true;
        }
        return false;
    }
</script>
    </x-slot>
</x-base-layout>




{{-- table columns

question
option_a
option_b
option_c
option_d
option_e
option_f
correct_option
code_snippet
Answer_Explanation
image_file
video_file

    --}}
