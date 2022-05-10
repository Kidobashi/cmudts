<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div style="width: 900px;" class="container max-w-full max-auto pt-4">
        <form method="POST" action="/posts/{{$post->id}}">
            @method('PUT')
            @csrf
            
            <div class="mb-4">
                <label class="font-bold text-gray-800" for="title">Title:</label>
                <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full
                text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="title"
                name="title" value ="{{$post->title}}">
            </div>

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="content">Content:</label>
                <textarea class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full
                text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="content"
                name="content">{{$post->content}}</textarea>
            </div>
            
            <select id = "offices" name="offices" class="block mt-1 w-full">
                <option value="old(offices)" selected disabled>Select Office
                    @foreach ($offices as $row)
                    <option value="{{ $row->id }}">{{ $row->officeName }}</option>
                </option>
                @endforeach
            </select>

            <button>Update</button>
            <button><a href="/posts">Cancel</a></button>
            <form action="/posts/{{$post->id}}">
                @csrf
                @method('DELETE')
                <button>">DELETE</a></button>
            </form>
            

            
        </form>
    </div>
</body>
</html>