$(document).ready(function() {
  $('input:radio[name="directionality"]').change(
      function(){
      if (this.checked && this.value == 'oneWay') {
        $('#return_picker').attr('hidden', "true");
        $('#return_picker').attr('required', "false");
        $('#datepicker_label').html('Departure');
        $('#return_picker').val('');
        $('#departure_date').val('');
      }
      else {
        $('#return_picker').removeAttr('hidden');
        $('#return_picker').attr('required', "true");
        $('#datepicker_label').html('Departure - Return');
      }
    });
});
