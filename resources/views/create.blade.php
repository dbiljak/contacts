<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('partials._head')

<body>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Create contact</h1>
      <p class="lead">Craete single contact page.</p>
    </div>
  </div>

  <form class="container" method="POST" action="{{ Config('constants.api_domain') }}api/create-contact" enctype="multipart/form-data">
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input name="name" type="text" class="form-control" id="name" placeholder="Name">
      </div>
    </div>

    <div class="form-group row">
      <label for="surname" class="col-sm-2 col-form-label">Surname</label>
      <div class="col-sm-10">
        <input name="surname" type="text" class="form-control" id="surname" placeholder="Surname">
      </div>
    </div>

    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
      </div>
    </div>

    <div id="telephone_wrap">
      <div class="form-group row">
        <input type="text" name="labels[1]" class="col-sm-2 typeahead form-control" id="label_1" placeholder="Insert phone type">
        <div class="col-sm-10">
          <input type="text" name="telephones[1]" class="form-control" id="telephone_1" placeholder="Telephone">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-10 offset-sm-2"><small><a href="#" id="addScnt">Add Another Telephone</a></small></div>
    </div>

    <div class="form-group row">
      <div class="col-sm-2">Favourite</div>
      <div class="col-sm-10">
        <div class="custom-control custom-checkbox">
          <input name="favourite" type="checkbox" class="custom-control-input" id="favourite">
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
        <button type="submit" class="btn btn-primary">Save new contact</button>
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
  var i = $('#telephone_wrap').length + 1;

  $('#addScnt').on('click', function() {
    $(scntDiv).append('<div class="form-group row" id="row_' + i + '"><input type="text" name="labels[' + i + ']" class="col-sm-2 typeahead2 form-control" id="label_' + i + '" placeholder="Insert phone type"><div class="col-sm-9"><input type="text" name="telephones[' + i + ']" class="form-control" id="telephone_' + i + '" placeholder="Telephone"></div><a class="col-sm-1" style="line-height: 40px; color: #999; text-align: right;" href="#" id="remScnt_' + i + '">remove</a></div>')
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
