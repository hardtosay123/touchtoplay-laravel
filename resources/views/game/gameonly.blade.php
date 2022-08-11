@if ($game->status === 1)
{!! $game->script !!}
@else
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $game->title }} - Maintenance</title>
        <style>
            * {
                font-family: Arial, Helvetica, sans-serif;
            }
            body {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="d-flex w-100 min-vh-100 justify-content-center align-items-center" style="min-height: 100vh;width:100%;display:flex;justify-content:center; align-items:center;background-color:rgba(247,250,252);">
            <h1>In Maintenance...</h1>
        </div>
    </body>
    </html>
@endif