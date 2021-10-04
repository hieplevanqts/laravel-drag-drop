<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
    <title>Laravel</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="dd" data-url="{{ route('category.updateTree') }}">
                        <ol class="dd-list">
                            @foreach ($list as $item)
                                @include('item', ['item'=>$item])
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script>

            let dd = $('.dd')
            let base = $('#base').val()

            dd.nestable({  }).on('change', function(){
                let dataOutput = dd.nestable('serialize')
                try {
                    $.ajax({
                    type: "post",
                    url: dd.data('url'),
                    data: {
                        data: dataOutput,
                        _token : $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
                } catch (error) {
                    console.log(error);
                }

            })
    </script>
</body>
</html>
