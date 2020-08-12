<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Form</title>
</head>
<body>

<div class="container">
    <div id="form" class="mt-5">
        <h1 class="h5">Проверка принадлежности введённого ИНН плательщику налога на профессиональный доход (самозанятый фрилансер).</h1>

        @if (isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p class="my-2">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {!! Form::open(['route' => 'checkInn', 'autocomplete' => 'off']) !!}
            <div class="form-group">
                {!! Form::label('inn', 'Введите ИНН физического лица') !!}
                {!! Form::text('inn', null, ['class' => 'form-control', 'placeholder' => 'ИНН физического лица', 'required']) !!}
            </div>

            {!! Form::submit('Отправить', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}

        @if (session()->has('message'))
            <div class="mt-5 {{ session('success') ? 'text-success' : 'text-danger' }}">
                {!! session('message') !!}
            </div>
            @if (session('error_code'))
                <div class="text-danger">
                    {!! session('error_code') !!}
                </div>
            @endif
        @endif
    </div>
</div>

</body>
</html>
