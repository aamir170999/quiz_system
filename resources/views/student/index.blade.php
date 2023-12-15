<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>student panel</title>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body style="background-color: #c9e7d1">
    <div class="container">

        <nav class=" mt-3 navbar rounded navbar-expand-lg bg-body-tertiary">

        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

</nav>


    @foreach($exams as $exam)
    <div class="card text-bg-dark mt-5 mb-3 " style="max-width: 20rem;">
        <div class="card-header border border-gray-200" >{{$exam->title}}</div>
        <div class="card-body">

          <p class="card-text  text-bold text"><strong>{{$exam->description}}</strong></p>

          <div class="row mt-2">
            <div class="col">Per Question Mark =</div>
            <div class="col">{{$exam->marks_per_question}}</div>
          </div>

          <div class="row mt-2">
            <div class="col">Total Marks =</div>

            <div class="col">{{$exam->total_marks}}</div>
          </div>
          <div class="row mt-2">
            <div class="col">Total Question =</div>

            <div class="col">{{ $exam->questions->count() }}</div>
          </div>

          <div class="row mt-2">
            <div class="col">Total Time (min's) =</div>

            <div class="col">{{$exam->time}}</div>
          </div>
          <div class="row mt-2">
            <div class="col">Quiz Price =</div>

            <div class="col">{{$exam->exam_fees}}</div>
          </div>
          <div class="row mt-2 mb-0"><button class="btn text-light btn-outline-dark border  border-gray-200">start quiz</button></div>
        </div>
      </div>
      @endforeach




</div>









      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
