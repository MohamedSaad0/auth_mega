<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Auth|Register</title>
</head>
<body>
    <form class= "container mt-5" method="POST" action="/register">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
            <span class="text-danger">@error('name') {{$message}} @enderror</span>
          </div>
        <div class="mb-3">
          <label  class="form-label">Email address</label>
          <input type="email" class="form-control" name="email">
          <span class="text-danger">@error('email') {{$message}} @enderror </span>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password">
          <span class="text-danger">@error('password') {{$message}} @enderror</span>
        </div>
        <div class="mb-3">
            <label class="form-label">Password Confirmation</label>
            <input type="password" class="form-control" name="password_confirmation">
            <span class="text-danger">@error('password') {{$message}} @enderror</span>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</body>
</html>
