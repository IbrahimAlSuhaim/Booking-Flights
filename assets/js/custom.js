$(document).ready(function() {

  $('#date').hide();

  $('input:radio[name="directionality"]').change(
      function(){

      if (this.checked && this.value == 'oneWay') {
        $('#departure_return_departure').removeAttr('required');
        $('#departure_return_return').removeAttr('required');
        $('#departure_return').hide();
        $('#departure_departure').attr('name', 'departure_date')
        $('#departure_departure').attr('required');
        $('#departure').show();
        $('#date').show();
      }
      else {
        $('#departure_departure').removeAttr('name');
        $('#departure_departure').removeAttr('required');
        $('#departure').hide();
        $('#departure_return').show();
        $('#departure_return_departure').attr('required');
        $('#departure_return_return').attr('required');
        $('#date').show();
      }
    });
});
