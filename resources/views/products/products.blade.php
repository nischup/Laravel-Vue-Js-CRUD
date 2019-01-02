<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <title> Product List  </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <script> var base_url = "{{ url('/').'/' }}"; </script>
        <script src="https://unpkg.com/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.min.css">
    </head>
    <body>
        <div id="productApp">
                <add-product></add-product>
                <products></products>
        </div>
        <script src="{{ asset('js/product.js') }}"></script>
    </body>
</html>
