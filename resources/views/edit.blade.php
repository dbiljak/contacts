<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('partials._head')

<body>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Update contact</h1>
      <p class="lead">{{ $contact->name }} {{ $contact->surname }}</p>
    </div>
  </div>

  <form class="container" method="POST" action="{{ Config('constants.api_domain') }}api/update-contact/{{ $contact->id }}" enctype="multipart/form-data">

    {{method_field('PUT')}}
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input name="name" value="{{ $contact->name }}" type="text" class="form-control" id="name" placeholder="Name">
      </div>
    </div>

    <div class="form-group row">
      <label for="surname" class="col-sm-2 col-form-label">Surname</label>
      <div class="col-sm-10">
        <input name="surname" value="{{ $contact->surname }}" type="text" class="form-control" id="surname" placeholder="Surname">
      </div>
    </div>

    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input name="email" value="{{ $contact->email }}" type="email" class="form-control" id="email" placeholder="Email">
      </div>
    </div>

    <div id="telephone_wrap">
      @foreach ($contact->phones as $key => $value)
        <div class="form-group row" id="row_{{ $key }}">
          @foreach (json_decode($labels) as $label)
            @if ($label->id == $value->label_id)
              <input type="text" value="{{ $value->label->name }}" name="labels[{{ $key }}]" class="col-sm-2 typeahead form-control" id="label_{{ $key }}" placeholder="Insert phone type">
            @endif
          @endforeach
          <div class="col-sm-9">
            <input type="text" value="{{ $value->phone_number }}" name="telephones[{{ $key }}]" class="form-control" id="telephone_{{ $key }}" placeholder="Telephone">
          </div>
          <a class="col-sm-1 remove_active" style="line-height: 40px; color: #999; text-align: right;" href="#" id="remScnt_{{ $key }}">remove</a>
        </div>
      @endforeach
    </div>

    <div class="row">
      <div class="col-sm-10 offset-sm-2"><small><a href="#" id="addScnt">Add Another Telephone</a></small></div>
    </div>

    <div class="form-group row">
      <div class="col-sm-2">Favourite</div>
      <div class="col-sm-10">
        <div class="custom-control custom-checkbox">
          <input {{ $contact->favourite == 1 ? "checked" : "" }} name="favourite" type="checkbox" class="custom-control-input" id="favourite">
          <label class="custom-control-label" for="favourite">Yes</label>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label for="image" class="col-sm-2 col-form-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="image" class="form-control" id="image">
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Update contact</button>
        <a href="/contacts" class="btn btn-secondary">Cancel</a>
      </div>
    </div>
  </form>

</body>

@include('partials._footer')
<script type="text/javascript">
var labels = JSON.parse(<?php echo json_encode($labels) ?>);
var $input = $(".typeahead");
$(function() {
  var scntDiv = $('#telephone_wrap');
  var number_of_divs = $('#telephone_wrap').find('.row').length;
  var i = number_of_divs + 1;
  $('#addScnt').on('click', function() {
    $(scntDiv).append('<div class="form-group row" id="row_' + i + '"><input type="text" name="labels[' + i + ']" class="col-sm-2 typeahead2 form-control" id="label_' + i + '" placeholder="Insert phone type"><div class="col-sm-9"><input type="text" name="telephones[' + i + ']" class="form-control" id="telephone_' + i + '" placeholder="Telephone"></div><a class="col-sm-1 remove_old" style="line-height: 40px; color: #999; text-align: right;" href="#" id="remScnt_' + i + '">remove</a></div>')
    .find('.typeahead2')
    .typeahead({
      source: labels,
      items: 8,
      menu: '<ul class="typeahead dropdown-menu" role="listbox"></ul>',
      item: '<li><a class="dropdown-item" href="#" role="option"></a></li>',
      headerHtml: '<li class="dropdown-header"></li>',
      headerDivider: '<li class="divider" role="separator"></li>',
      itemContentSelector: 'a',
      minLength: 1,
      scrollHeight: 0,
      autoSelect: true,
      afterSelect: $.noop,
      afterEmptySelect: $.noop,
      addItem: false,
      delay: 0,
    });
    i++;
    return false;
  });

  $(scntDiv).on('click', 'a', function(e) {
    if (e.target.id != "") {
      var remove_btn_id = "#" + e.target.id;
      var row_id = "#" + $(remove_btn_id).closest('.row').attr('id');
      if( i > 2 ) {
        $(row_id).remove();
        i--;
      }
      return false;
    }
  });

  $('.remove_active').on('click', function(e) {
    var remove_btn_id = "#" + e.target.id;
    var row_id = "#" + $(remove_btn_id).closest('.row').attr('id');
    console.log();
    $(row_id).remove();
    return false;
  });

  $input.typeahead({
    source: labels,
    items: 8,
    menu: '<ul class="typeahead dropdown-menu" role="listbox"></ul>',
    item: '<li><a class="dropdown-item" href="#" role="option"></a></li>',
    headerHtml: '<li class="dropdown-header"></li>',
    headerDivider: '<li class="divider" role="separator"></li>',
    itemContentSelector: 'a',
    minLength: 1,
    scrollHeight: 0,
    autoSelect: true,
    afterSelect: $.noop,
    afterEmptySelect: $.noop,
    addItem: false,
    delay: 0,
  });
});
</script>
</html>
