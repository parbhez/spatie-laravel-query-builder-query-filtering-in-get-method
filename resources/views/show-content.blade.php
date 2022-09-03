<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <title>Laravel Spatie Query Filter</title>

    <style>
        #name_list_show ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #name_list_show ul li {
            padding: 5px 0;
            width: 287px;
            margin-left: 10px;
        }

        #name_list_show ul li a {
            color: inherit;
            text-decoration: none;
            pointer-events: none;
        }

        #email_list_show ul li:hover {
            background: #eee;
        }

        #email_list_show ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #email_list_show ul li {
            padding: 5px 0;
            width: 287px;
            margin-left: 10px;
        }

        #email_list_show ul li a {
            color: inherit;
            text-decoration: none;
            pointer-events: none;
        }

        #email_list_show ul li:hover {
            background: #eee;
        }
    </style>
</head>

<body>


    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h2>Search</h2>
                    </div>

                    <div class="col-md-2 mt-2">
                        <a href="{{ url('/show') }}" class="btn btn-secondary btn-sm "
                            style="display: <?php if (Request::url() == url('/show')) {
                                echo 'none';
                            } else {
                                echo 'show';
                            } ?>">Back List</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                {{-- <div class="row" onchange="filter_results(this.value);"> --}}
                <div class="row" onchange="filter_results(this.value);">
                    <div class="col">
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ !empty($data['filter']['name']) ? $data['filter']['name'] : '' }}"
                            placeholder="Name" aria-label="Name" onkeyup="name_auto_suggestion();">
                        <div id="name_list_show"></div>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ !empty($data['filter']['email']) ? $data['filter']['email'] : '' }}"
                            placeholder="Email" aria-label="Email" onkeyup="email_auto_suggestion();">
                        <div id="email_list_show"></div>
                    </div>
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" id="user">
                            <option selected disabled value="">Select Any One</option>
                            @foreach ($users as $row)
                                <option value="{{ $row->id }}" <?php if (!empty($data['filter']['user_id'])) {
                                    if ($data['filter']['user_id'] == $row->id) {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    }
                                } else {
                                    echo '';
                                } ?>>{{ $row->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-info btn-sm" id="filter" onclick="filter_results(this.value);"
                            type="button">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h2>All Content</h2>
            </div>

            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>User Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($guardians) && !empty($guardians))
                                @foreach ($guardians as $key => $row)
                                    <tr>
                                        <th>{{ $key + 1 }}</th>
                                        <td>{{ $row->username }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>{{ $row->present_address }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>Data Not found</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script>
        //http://127.0.0.1:8000/search?filter[name]=fatema


        function name_auto_suggestion() {
            var name = document.getElementById('name').value;

            $.ajax({
                url: "{{ route('name-auto-suggestion') }}",
                type: "GET",
                dataType: "html",
                data: {
                    'name': name,
                },
                success: function(data) {
                   // console.log(data);
                    $('#name_list_show').fadeIn();
                    $("#name_list_show").html(data);
                },
                error: function() {
                    return false;
                }
            });
        }

        $(document).on('click', '#li_name', function() {
            var name = $(this).text();
            //console.log(name);
            $('#name').val($(this).text());
            $('#name_list_show').fadeOut();

            let url = 'filter-data?';

            if (name.length) {
                url += 'filter[name]=' + name;
            }

            document.location.href = url;

        });


        function email_auto_suggestion() {
            var email = document.getElementById('email').value;

            $.ajax({
                url: "{{ route('email-auto-suggestion') }}",
                type: "GET",
                dataType: "html",
                data: {
                    'email': email,
                },
                success: function(data) {
                    //console.log(data);
                    $('#email_list_show').fadeIn();
                    $("#email_list_show").html(data);
                },
                error: function() {
                    return false;
                }
            });
        }

        $(document).on('click', '#li_email', function() {
            var email = $(this).text();
            $('#email').val($(this).text());
            $('#email_list_show').fadeOut();

            let url = 'filter-data?';

            if (email.length) {
                url += 'filter[email]=' + email;
            }

            document.location.href = url;

        });

        function filter_results(el) {
            let url = 'filter-data?';
            var name = document.getElementById('name').value;

            if (name.length) {
                url += 'filter[name]=' + name;
            }

            var email = document.getElementById('email').value;

            if (email.length) {
                url += '&filter[email]=' + email;
            }

            var user = document.getElementById('user').value;

            if (user.length) {
                url += '&filter[user_id]=' + user;
            }

            //console.log(location.href); //get value = http://127.0.0.1:8000/show
            //var url = href;
            //console.log(document.location);

            document.location.href = url;

        }

        // document.getElementById('filter').addEventListener("click",filter_results);


    </script>

</body>

</html>
