<div class="col-md-12">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>

            @foreach($users as $key=>$row)
          <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$row->name}}</td>
            <td>{{$row->email}}</td>
          </tr>
          @endforeach

        </tbody>
      </table>
</div>
