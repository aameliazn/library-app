<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Dashboard</title>
</head>

<body>
    <div class="m-lg-5 text-center">
        <h2>Hola {{ $auth->name }}!</h2>
        <p>{{ \Carbon\Carbon::now()->addHour(7)->isoFormat('dddd, D MMMM Y') }}</p>
    </div>
    @if ($auth->roles !== 'user')
        <div class="m-lg-5 d-flex justify-content-between gap-2">
            <div class="d-grid col-11">
                <a href="{{ route('export') }}" class="btn btn-outline-primary">Export Data Peminjaman</a>
            </div>
            <div class="d-grid col-1">
                <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
        <hr class="m-lg-5">
    @endif

    @if ($auth->roles === 'user')
        <div class="m-lg-5 d-flex">
            <div class="d-grid col-12">
                <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
        <hr class="m-lg-5">
    @endif

    @if ($auth->roles === 'master')
        <form class="m-lg-5" action="{{ route('register.admin') }}" method="POST">
            @csrf
            @method('POST')
            <h4 class="mb-3 d-flex justify-content-center">Mendaftarkan Admin</h4>
            <div class="mb-3">
                <label for="usernameInput" class="form-label">Username</label>
                <input type="text" class="form-control" id="usernameInput" name="username">
            </div>
            <div class="mb-3">
                <label for="nameInput" class="form-label">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name">
            </div>
            <div class="mb-3">
                <label for="addressInput" class="form-label">Address</label>
                <textarea class="form-control" id="addressInput" aria-describedby="addressHelp" name="address"></textarea>
                <div id="addressHelp" class="form-text">We'll never share your address with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="d-grid col-12">
                <button type="submit" class="mt-3 btn btn-outline-primary">Submit</button>
            </div>
        </form>
        <hr class="m-lg-5">
    @endif

    @if ($auth->roles !== 'user')
        <form class="m-lg-5" action="{{ route('book.category.create') }}" method="POST">
            @csrf
            @method('POST')
            <h4 class="mb-3 d-flex justify-content-center">Menambahkan Kategori</h4>
            <div class="mb-3">
                <label for="nameInput" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="nameInput">
            </div>
            <div class="d-grid col-12">
                <button type="submit" class="mt-3 btn btn-outline-primary">Submit</button>
            </div>
        </form>
        <hr class="m-lg-5">

        <form class="m-lg-5" action="{{ route('book.create') }}" method="POST">
            @csrf
            @method('POST')
            <h4 class="mb-3 d-flex justify-content-center">Menambahkan Buku</h4>
            <div class="mb-3">
                <label for="titleInput" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="titleInput">
            </div>
            <div class="mb-3">
                <label for="CategoryInput" class="form-label">Category</label>
                <select class="form-select" name="category" aria-label="Default select example">
                    <option selected disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="authorInput" class="form-label">Author</label>
                <input type="text" name="author" class="form-control" id="authorInput">
            </div>
            <div class="mb-3">
                <label for="publisherInput" class="form-label">Publisher</label>
                <input type="text" name="publisher" class="form-control" id="publisherInput">
            </div>
            <div class="mb-3">
                <label for="pubYearInput" class="form-label">Publication Year</label>
                <input type="number" name="pub_year" class="form-control" id="pubYearInput">
            </div>
            <div class="d-grid col-12">
                <button type="submit" class="btn btn-outline-primary mt-3">Submit</button>
            </div>
        </form>
        <hr class="m-lg-5">
    @endif

    @if ($auth->roles === 'user')
        <div class="mb-lg-5 me-lg-5 ms-lg-5 mt-lg-2">
            <h3 class="mb-3 d-flex justify-content-center">Data Buku</h3>
            <table class="table table-hover" style="text-align:center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width:20%">Title</th>
                        <th scope="col" style="width:20%">Author</th>
                        <th scope="col" style="width:20%">Publisher</th>
                        <th scope="col" style="width:17%">Publication Year</th>
                        <th scope="col" style="width:23%"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($books as $book)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->pub_year }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    @php
                                        $isLoaned = false;
                                        foreach ($loaned as $loan) {
                                            if ($loan->book->id === $book->id) {
                                                $isLoaned = true;
                                                break;
                                            }
                                        }
                                    @endphp
                                    
                                    <form action="{{ route('loan.create', $book->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="book" value="{{ $book->id }}">
                                        @if ($isLoaned)
                                            <button type="button" class="btn btn-outline-primary"
                                                disabled>Dipinjam</button>
                                        @else
                                            <button type="submit" class="btn btn-outline-primary">Pinjam</button>
                                        @endif
                                    </form>

                                    <form action="{{ route('book.collection.create', $book->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="book" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-outline-success">Collection</button>
                                    </form>

                                    <form action="{{ route('loan.create', $book->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="book" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-outline-dark">Review</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr class="m-lg-5">

        <div class="m-lg-5">
            <h3 class="mb-3 d-flex justify-content-center">Data Peminjaman Buku</h3>
            <table class="table table-hover" style="text-align:center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Loan Date</th>
                        <th scope="col">Due Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($loans as $loan)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $loan->book->title }}</td>
                            <td>{{ $loan->book->author }}</td>
                            <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}</td>
                            <td>
                                <form action="{{ route('loan.delete', $loan->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="loan" value="{{ $loan->id }}">
                                    <button type="submit" class="btn btn-outline-primary">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr class="m-lg-5">

        <div class="mb-lg-5 me-lg-5 ms-lg-5 mt-lg-2">
            <h3 class="mb-3 d-flex justify-content-center">Data Collection</h3>
            <table class="table table-hover" style="text-align:center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width:20%">Title</th>
                        <th scope="col" style="width:20%">Author</th>
                        <th scope="col" style="width:20%">Publisher</th>
                        <th scope="col" style="width:17%">Publication Year</th>
                        <th scope="col" style="width:23%"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($collections as $collection)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $collection->book->title }}</td>
                            <td>{{ $collection->book->author }}</td>
                            <td>{{ $collection->book->publisher }}</td>
                            <td>{{ $collection->book->pub_year }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    @php
                                        $isLoaned = false;
                                        foreach ($loaned as $loan) {
                                            if ($loan->book->id === $collection->book->id) {
                                                $isLoaned = true;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <form action="{{ route('loan.create', $collection->book->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="book" value="{{ $collection->book->id }}">
                                        @if ($isLoaned)
                                            <button type="button" class="btn btn-outline-primary"
                                                disabled>Dipinjam</button>
                                        @else
                                            <button type="submit" class="btn btn-outline-primary">Pinjam</button>
                                        @endif
                                    </form>
                                    <form action="{{ route('loan.create', $collection->book->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="book" value="{{ $collection->book->id }}">
                                        <button type="submit" class="btn btn-outline-success">Delete</button>
                                    </form>
                                    <form action="{{ route('loan.create', $collection->book->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="book" value="{{ $collection->book->id }}">
                                        <button type="submit" class="btn btn-outline-dark">Review</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr class="m-lg-5">
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

</body>

</html>
