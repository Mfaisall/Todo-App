@extends('layout')

@section('Isal')
   <link rel="stylesheet" href="create.css">
<div class="container content">  
    <form id="create-form" action="{{route('update.todo', $todo->id)}}"
     method="POST">
     {{-- mengambil dan mengirim data input ke controller yang nantinya di ambil oleh Request $request --}}
        @csrf
        @method('patch')
        @if ($errors->any())
        <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
         </div>
        @endif
      <h3>Create Todo</h3>
      <div class="Padding">
      <fieldset>
          <label for="">Title</label>
          <input placeholder="title of todo" type="text" name="title" value="{{ $todo->title }}">
      </fieldset>
      <fieldset>
          <label for="">Target Date</label>
          <input placeholder="Target Date" type="date" name="date" value="{{ $todo->date }}">
      </fieldset>
      <fieldset>
          <label for="">Description</label>
          <textarea name="description"placeholder="Type your descriptions here..." tabindex="5">{{ $todo->description }}</textarea>
      </fieldset>
      <fieldset>
          <button type="submit" id="contactus-submit">Submit</button>
      </fieldset>
      <fieldset>
          <a href="/todo/" class="btn-cancel btn-lg btn">Cancel</a>
      </fieldset>
    </form>
  </div>
</div>

  @endsection
