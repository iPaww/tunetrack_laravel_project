<style>
    .text-justify {
    text-align: justify;
    }
    /* Style the radio button to add a border */
    .inp-check {
        border: 2px solid #FC6A03;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        background-color: white;
        transition: border-color 0.3s ease;
    }

    /* Add a hover effect */
    .inp-check:hover {
        border-color: #bd4f02;
    }

    /* When the radio button is checked, add a different border color */
    .inp-check:checked {
        border-color: #853700;
        background-color: #FC6A03;
        outline: none;
    }

    /* Optional: Change the border color when the input is focused */
    .inp-check:focus {
        border-color: #FC6A03;
        box-shadow: 0 0 5px rgba(255, 105, 0, 0.5);
    }

</style>
<h1 class="fs-1">{{ $course->name }}</h1>
<p class="fs-4 text-break text-justify fw-semibold">{{ $course->description }}</p>
<h3 class="fs-3">Topics</h3>
<div class="card topic-card">
    <div class="card-body row">
        <div class="col-4 border-end">
            @foreach ($topics as $rel_topic)
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/topic/{{ $rel_topic->id }}" class="text-decoration-none text-white">
                <div class="topic-list">{{ $rel_topic->title }}</div>
            </a>
            @endforeach
            <a class="text-reset text-decoration-none" data-bs-toggle="collapse"
                href="quiz" role="button" aria-expanded="false" aria-controls="quiz">
                <div class="topic-list active">Quiz</div>
            </a>
            <div class="topics-div collapse show" id="quiz">
                @foreach ( $quizes as $quiz_nav )
                    @if( request()->route('quiz_id') == $quiz_nav->id )
                        <div></div>
                        <div class="sub-topic-list active text-capitalize">Quiz #{{ $quiz_nav->question_order }}</div>
                    @else
                        <a class="text-reset text-decoration-none"
                            href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/quiz/{{ $quiz_nav->id }}"
                        >
                            <div class="sub-topic-list text-capitalize">Quiz #{{ $quiz_nav->question_order }}</div>
                        </a>
                    @endif
                @endforeach
            </div>
            <a href="/elearning/category/{{ request()->route('id') }}/course/{{ $course->id }}/overall" class="text-decoration-none text-white">
                <div class="topic-list">Overall</div>
            </a>
        </div>
        <div class="col-8">
            <h3 class="fs-3 fw-bold text-center">Question # {{ $quiz->question_order }}</h3>
            <p class="text-center mb-4 fw-semibold">{{ $quiz->question }}</p>

            <!-- Show Quiz Image if available -->
            @if ($quiz->quiz_picture)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $quiz->quiz_picture) }}" alt="Quiz Image" class="img-fluid" width="300">
                </div>

            @endif

            <!-- Show Quiz Audio if available -->
            @if ($quiz->quiz_audio)
                <div class="mb-4 text-center">
                    <audio controls>
                        <source src="{{ asset('storage/' . $quiz->quiz_audio) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            @endif

            <div class="row">
                <div class="col-12 col-md-6 mb-0 mb-md-4">
                    <div class="form-check">
                        <input class="form-check-input inp-check" type="radio" name="answer_txt" id="a_answer" value="1"
                            @checked( $previousAnswer == 1 )
                        />
                        <label class="form-check-label fw-semibold" for="a_answer">
                            A. {{ $quiz->a_answer }}
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-0 mb-md-4">
                    <div class="form-check">
                        <input class="form-check-input inp-check" type="radio" name="answer_txt" id="b_answer" value="2"
                            @checked( $previousAnswer == 2 )
                        >
                        <label class="form-check-label  fw-semibold" for="b_answer">
                            B. {{ $quiz->b_answer }}
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-0 mb-md-4">
                    <div class="form-check">
                        <input class="form-check-input inp-check" type="radio" name="answer_txt" id="c_answer" value="3"
                            @checked( $previousAnswer == 3 )
                        >
                        <label class="form-check-label  fw-semibold" for="c_answer">
                            C. {{ $quiz->c_answer }}
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-0 mb-md-4">
                    <div class="form-check">
                        <input class="form-check-input inp-check" type="radio" name="answer_txt" id="d_answer" value="4"
                            @checked( $previousAnswer == 4 )
                        >
                        <label class="form-check-label  fw-semibold" for="d_answer">
                            D. {{ $quiz->d_answer }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="" method="POST">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="answer" @if( $previousAnswer > 0 ) value={{ $previousAnswer }} @endif>
                    <div class="text-end">
                        <button style="background-color: #FC6A03" class="btn btn-lg">Submit</button>
                    </div>
                </form>
            </div>

            @if ($errors->any())
            <div class="col-12">
                <ul class="list-group my-2">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('.inp-check').click((e) => {
        const selected_color = $(e.target)
        max_quantity = selected_color.data('max')
        $('.quantity-inp').trigger('input')
        $('input[name="answer"]').val( selected_color.val() )
    })
})
</script>
