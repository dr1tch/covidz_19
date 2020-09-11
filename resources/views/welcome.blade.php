<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>COVIDZ-19</title>

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <script>
            (function () {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
            })();
        </script>
    </head>
    <body>
        <div id="app" class="container-fluid" style="height: 100%">
            {{-- <form action="/upload" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <label class="block mb-2 uppercase font-bold "
          for="avatar">avatar</label>
          <div class="flex">
            <input class="border border-gray-400 text-md p-3 w-full rounded-lg bg-transparent font-medium"
              type="file"
              name="avatar"
              id="avatar"
              >
              <button
              class="bg-green-500 shadow text-white rounded py-2 px-4"
            type="submit">Submit</button>
            </form> --}}
            <admin-dash></admin-dash>
        </div>


        
    <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
