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
    @if ($auth->roles === 'master')
        <form class="m-lg-5" action="{{ route('register.admin') }}" method="POST">
            @csrf
            @method('POST')
            <h5 class="mb-3">Mendaftarkan Admin</h5>
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

            <button type="submit" class="btn btn-primary">Submit</button>
            <hr>
        </form>
    @endif

    @if ($auth->roles !== 'user')
        <form class="m-lg-5" action="{{ route('book.category.create') }}" method="POST">
            @csrf
            @method('POST')
            <h5 class="mb-3">Menambahkan Kategori</h5>
            <div class="mb-3">
                <label for="nameInput" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="nameInput">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <hr>
        </form>

        <form class="m-lg-5" action="{{ route('book.create') }}" method="POST">
            @csrf
            @method('POST')
            <h5 class="mb-3">Menambahkan Buku</h5>
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
            <button type="submit" class="btn btn-primary">Submit</button>
            <hr>
        </form>
    @endif

    @if ($auth->roles === 'user')
        <div class="m-lg-5">
            <h5 class="mb-3">Data Buku</h5>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Publication Year</th>
                        <th scope="col"></th>
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
                                @php
                                    $isLoaned = false;
                                    foreach ($loans as $loan) {
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
                                        <button type="button" class="btn btn-primary" disabled>Dipinjam</button>
                                    @else
                                        <button type="submit" class="btn btn-primary">Pinjam</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>

        <div class="m-lg-5">
            <h5 class="mb-3">Data Peminjaman Buku</h5>
            <table class="table table-hover">
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
                                    <button type="submit" class="btn btn-primary">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>
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
