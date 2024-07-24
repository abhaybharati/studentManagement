<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
   $(function () {

// geting the base url 
var baseUrl = window.location.origin;

// getting the CSRF token for the headers

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/* Load Data if student data found*/
function loadData() {
    $.ajax({
        type: "GET",
        url: "{{ route('home') }}",
        success: function (response) {
            $('tbody').html('');
            $.each(response.students, function (key, item) {
                $('tbody').append('<tr>\
                    <td>' + (key+1) + '</td>\
                    <td>' + item.name + '</td>\
                    <td>' + item.subject + '</td>\
                    <td>' + item.marks + '</td>\
                    <td>\
                        <i role="button" class="fa fa-pencil editStudent text-success mr-2 cursor-pointer" data-id="' + item.id + '"></i>\
                        <i role="button" class="fa fa-trash deleteStudent text-danger" data-id="' + item.id + '"></i>\
                    </td>\
                </tr>');
            });
        }
    });
}

loadData();

// Create New Student Data.

$('#createNewStudent').click(function () {
    $('#saveBtn').val("create-student");
    $('#student_id').val('');
    $('#studentForm').trigger("reset");
    $('#modelHeading').html("Create New Student");
    $('#ajaxModal').modal('show');
    $("#saveBtn").html('Add Student');
});
$('.close').click(function () {
    $('#ajaxModal').modal('hide');
});

// Edit Student Data.

$('body').on('click', '.editStudent', function () {
    var student_id = $(this).data('id');
    $.get(baseUrl + '/student/' + student_id+"/edit", function (data) {
        $('#modelHeading').html("Edit Student");
        $('#saveBtn').val("edit-student");
        $('#saveBtn').html("Update Student");
        $('#ajaxModal').modal('show');
        $('#student_id').val(data.id);
        $('#name').val(data.name);
        $('#subject').val(data.subject);
        $('#marks').val(data.marks);
    })
});

// Saving Student Data.

$('#saveBtn').click(function (e) {
    e.preventDefault();
    $(this).html('Sending..');

    $.ajax({
        data: $('#studentForm').serialize(),
        url: baseUrl+"/student",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            $('#studentForm').trigger("reset");
            $('#ajaxModal').modal('hide');
            loadData();
        },
        error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
        }
    });
});

// Delete Student dat by using ID.

$('body').on('click', '.deleteStudent', function () {

    var student_id = $(this).data('id');

    // confirm before delete student data

    var confirmation = confirm("Are you sure you want to remove this student from the list?");
    if(confirmation){

        $.ajax({
            type: "DELETE",
            url: baseUrl + '/student/' + student_id,
            success: function (data) {
                loadData();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});
});
</script>

