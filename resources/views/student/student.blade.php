<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <title> Student List  </title>
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
        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="pull-right col-md-4 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                            <a href="javascript:void(0)" class="btn btn-social width-150 mb-1 mr-1 btn-primary" id="addBtn">
                                <span class="ft-plus-circle font-medium-5"></span><b> Add New </b></a>
                    </div>

                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown" style="display: none" id="listBtn">
                        <a href="javascript:void(0)" class="btn btn-social width-150 mb-1 mr-1 btn-primary">
                            <span class="ft-list font-medium-5"></span><b>View List</b></a>
                    </div>
                </div>

                <div id="student">
                    <student-list></student-list>
                </div>

            </div>
        </div>

        <script src="{{ asset('js/student.js') }}"></script>
    </body>
</html>
