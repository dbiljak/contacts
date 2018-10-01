<div class="col-md-6">
  <h5>All</h5>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($all->contacts as $contact)
        <tr>
          <td><a href="/contacts/{{ $contact->id }}">{{ $contact->name }} {{ $contact->surname }}</a></td>
          <td>{{ $contact->email }}</td>
          <td style="text-align: center">
            <form class="container form_submit" method="POST" action="{{ Config('constants.api_domain') }}api/delete-contact/{{ $contact->id }}">
              {{method_field('DELETE')}}
              <button data-toggle="confirmation" style="border: none; background: transparent; cursor: pointer;" type="submit" name="button">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="col-md-6">
  <h5>Favourites</h5>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($all->favourites as $contact)
        <tr>
          <td><a href="/contacts/{{ $contact->id }}">{{ $contact->name }} {{ $contact->surname }}</a></td>
          <td>{{ $contact->email }}</td>
          <td style="text-align: center">
            <form class="container form_submit" method="POST" action="{{ Config('constants.api_domain') }}api/delete-contact/{{ $contact->id }}">
              {{method_field('DELETE')}}
              <button data-toggle="confirmation" style="border: none; background: transparent; cursor: pointer;" type="submit" name="button">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
