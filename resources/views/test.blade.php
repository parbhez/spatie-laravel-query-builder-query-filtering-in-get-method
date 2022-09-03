<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <title>Hello, world!</title>
  </head>
  <body>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header bg-info">
                            Spatie Filtering Laravel Query Builder
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                              </div>
                              <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                              </div>
                            </div>
                            <button class="btn btn-success btn-sm" type="button" id="filter">Submit</button>
                      </div>
                </div>
            </div>

            <div class="row" id="showdata">


            </div>
        </div>


    <script>

        //http://127.0.0.1:8000/search?filter[name]=fatema

        function filter_results()
        {
            let url = 'search?';
            var name = document.getElementById('name').value;

            if(name.length){
                url +='filter[name]='+name;
            }

            var email = document.getElementById('email').value;

            if(email.length){
                url +='&filter[email]='+email;
            }

            //console.log(location.href); //get value = http://127.0.0.1:8000/user
            //var url = href;


            document.location.href = url;

        }

        document.getElementById('filter').addEventListener("click",filter_results);

         //Ajax  technique
        // function filter_results()
        // {
        //     let url = '';
        //     var name = document.getElementById('name').value;

        //     if(name.length){
        //         url +='?filter[name]='+name;
        //     }

        //     var email = document.getElementById('email').value;

        //     if(email.length){
        //         url +='&filter[email]='+email;
        //     }

        //     $.ajax({
        //         type:"GET",
        //         url: "{{url('search')}}"+url,
        //         dataType: 'html',
        //         success: function(data){
        //             //console.log(data);
        //             document.getElementById('showdata').innerHTML = data;
        //         },
        //         error: function(){
        //             alert("Data Not found");
        //         }
        //     });


        // }

        // document.getElementById('filter').addEventListener("click",filter_results);





    </script>

  </body>
</html>
