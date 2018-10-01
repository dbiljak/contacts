<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('partials._head')

<body>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">{{ $contact->name }} {{ $contact->surname }}</h1>
      <p class="lead">{{ $contact->email }}</p>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-md-center">
      <div class="card col-md-6" style="text-align: center; border: none; margin-bottom: 25px;">
        <div style="padding: 10px; background: whitesmoke; height: 100%;">
          <img class="card-img-top" src="{{ asset('images/' . $contact->image) }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title" style="margin-bottom: 0; line-height: 1.5em;">{{ $contact->name }} {{ $contact->surname }}</h5>
            <h6 style="margin: 0 0 20px 0; color: tomato;"><small>{{ $contact->email }}</small></h6>
            <p style="margin: auto; min-height: 120px;">
              @forelse ($contact->phones as $phone)
                <small><span style="text-transform: lowercase; color: #999;">{{ $phone->label->name }}:</span> {{ $phone->phone_number }}</small><br />
              @empty
                No telephone!
              @endforelse
            </p>
            <a style="width: 120px; max-width: 100%; margin-top: 20px;" href="/contacts/" class="btn btn-primary">Go back</a>
            <a style="width: 120px; max-width: 100%; margin-top: 20px;" href="/contacts/{{ $contact->id }}/edit" class="btn btn-warning">Edit</a>
            <form class="container form_submit" method="POST" action="{{ Config('constants.api_domain') }}api/delete-contact/{{ $contact->id }}">
              {{method_field('DELETE')}}
              <button data-toggle="confirmation" class="btn btn-danger" style="width: 120px; max-width: 100%; margin-top: 10px;" type="submit" name="button">
                Delete
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

@include('partials._footer')
</html>
