@foreach ($posts as $post)
    {{-- show post --}}
    <h1>{{ $post->title }}</h1>
    <img src="storage/{{ $post->image }}" alt="">
    <p>{{ $post->text }}</p>
    <p>{{ $post->link }}</p>
    <hr>
@endforeach