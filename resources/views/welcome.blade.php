<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name="_token" content="{{ csrf_token() }}">

        <title>Index</title>
        <link href='https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap' rel='stylesheet'>
        <link href="{{'css/app.css'}}" rel="stylesheet">

    </head>
        <body>
            <div class="loading">Loading&#8230;</div>
            <div class='container-fluid p-0'>
                <table class='table' aria-labelledby="tableLabel">
                    <thead>
                      <tr>
                        <th class="cursor-pointer table-header" data-direction="0">User Name</th>
                        <th class="cursor-pointer table-header" data-direction="0">First Name</th>
                        <th class="cursor-pointer table-header" data-direction="0">Last Name</th>
                        <th class="cursor-pointer table-header" data-direction="0">Gender</th>
                      </tr>
                    </thead>
                    <tbody id="container">
                        @include('partial/table')
                    </tbody>
                  </table>
            </div>
            <script src="{{asset('js/app.js')}}"></script>
        </body>
</html>
