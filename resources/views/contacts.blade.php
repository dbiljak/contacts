<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('partials._head')

<body>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Contacts list</h1>
      <p class="lead">Contact list page.</p>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <a class="btn btn-primary" href="/contacts/create">Create new contact</a>
      </div>
      <form style="margin: 10px auto 40px" class="col-md-4">
        <div class="form-group">
          <input type="text" class="form-control" id="search" placeholder="Search...">
        </div>
      </form>
    </div>
  </div>


  <div class="container">
    <div class="row" id="contacts_display">
      @include('components.contact_tables', array('all' => $all))
    </div>
  </div>
</body>

@include('partials._footer')
</html>
