<div class="row_fluid" style="margin-top: 80px; display: flex; background: whitesmoke; padding-top: 80px; padding-bottom: 60px;">
  <div class="container" style="margin: auto;">
    <p style="text-align: center; margin: 0;">Dražen Biljak</p>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
  $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
      $(".form_submit").submit();
    }
  });
});
$('#search').keyup(function() {
  var search_input = this.value; // A random variable for this example
  $.ajax({
    method: 'POST', // Type of response and matches what we said in the route
    url: '{{ Config('constants.api_domain') }}api/search-contacts', // This is the url we gave in the route
    data: {'filter' : search_input}, // a JSON object to send back
    success: function(response){ // What to do if we succeed
      $("#contacts_display").html(response.html);
    },
    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
      console.log(jqXHR);
    }
  });
});
</script>
