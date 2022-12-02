@extends('layout')

@section('Isal')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="todo.css">
    </head>
    <body>
    <div class="wrapper bg-white ">
        @if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
    @if (Session::get
    ('notAllowed'))
        <div class="alert alert-danger">
            {{ Session::get('notAllowed')}}
        </div>
    @endif
    @if (session('successAdd'))
        <div class="alert alert-success">
            {{ session('successAdd')}}
        </div>
    @endif

    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-warning">
        {{ Session::get('deleted')}}
    </div>
    @endif
    @if (Session::get('done'))
    <div class="alert alert-warning">
        {{ Session::get('done')}}
    </div>
    @endif
    @if (Session::get('Berhasil'))
    <div class="alert alert-warning">
        {{ Session::get('Berhasil')}}
    </div>
    @endif
    
   
    
        <div class="d-flex align-items-start justify-content-between ">
            <div class="d-flex flex-column ">
                <div class="h5">My Todo's</div>
                <p class="text-muted text-justify">
                    Here's a list of activities you have to do
                </p>
                <br>
                <span>
                    <a href="{{route('create')}}" class="text-success">Create</a>  <a href="">Complated</a>
                </span>
            </div>
            <div class="info btn ml-md-4 ml-0">
                <span class="fas fa-info" title="Info"></span>
            </div>
        </div>
        <div class="work border-bottom pt-3">
            <div class="d-flex align-items-center py-2 mt-2">
                <div>
                    <span class="text-muted fas fa-comment btn"></span>
                </div>
                <div class="text-muted">{{$todos->count()}}todos</div>
                <button class="ml-auto btn bg-white text-muted fas fa-angle-down" type="button" data-toggle="collapse"
                    data-target="#comments" aria-expanded="false" aria-controls="comments"></button>
            </div>
        </div>
        <div id="comments" class="">
            {{-- looping data -data dari compact 'todos' dapat ditampilkan per baris datanya --}}
            @foreach ($todos as $todo)
            <div class="comment d-flex align-items-start">
                <div class="mr-2">
                    @if ($todo['status'] == 1)
                    <i class="fa-solid fa-book" style="margin-right:6px;"></i>
                    @else
                   <form action="/complated/{{$todo->id}}" method="POST">
                   @csrf 
                   @method('PATCH')
                   <button type="submit" class="fas fa-circle-check text-primary btn"></button>
                   </form>
                   @endif
                </div>
                <div class="d-flex flex-column">
                    {{--menampilkan data dinamis / data yang diambil dari db pada blade harus menggunakan {{}} --}}
                    <b class="text-justify">
                        {{ $todo['title']}}
                    </b>
                    <p class="text-truncate"> {{ $todo['description'] }} </p>
                {{-- konsep ternanry : if column status baris ini isinya 1 bakal memunculkan teks 'Complated' selain dari itu akan menampilkan teks 'On-Proccess'--}}
                <p class="text-muted">{{$todo['status'] == 1 ? 'Complated' : 'On Proccess'}} 
                    {{-- Carbon itu package laravel untuk mengelola yang berhubungan dengan date. Tadinya value column date di database berbentuk format 2022-11-22 nah jadi itu diubah menjadi format 22 November 2022  --}}
                    <span class="date"> {{ $todo['status'] == 1 ? 'Selesai pada : ' . \Carbon\Carbon::parse($todo['date'])->format('j F, Y') : 'Target selesai : ' . \Carbon\Carbon::parse($todo['done_time'])->format('j F, Y') }}</span></p>
                </div>
                <div class="ml-md-4 ml-0">
                <a href="{{ route('todo.delete', $todo->id)}}"><i class="fa-solid fa-trash" style="margin-left:250px;"></i> </a>
                </div>
                <div class="ml-md-5 ml-0 mt-5">
                <a href="{{ route('edit.todo', $todo->id)}}"><i class="fa-solid fa-pen-to-square" style="margin-left:-13px;"></i> </a>
                </div>
                </div>
        
            @endforeach
            </div>
        </div>
    </div>  
    </body>
    </html>
    
@endsection