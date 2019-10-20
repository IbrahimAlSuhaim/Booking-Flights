function handleChooseFlight(next, flightId) {
  $.confirm({
    icon: 'fa fa-question-circle',
    title: 'Confirm',
    content: 'Confirm selection?',
    btnClass: 'btn-blue',
    buttons: {
      Proceed: {
        btnClass: 'btn-blue',
        action: function () {
          if (next === 'return') {
            document.location.href = './returnflights?id='+flightId+'#return';
          }
          else if (next === 'passenger') {
            document.location.href = './passenger?id='+flightId;
          }
        }
      },
      cancel: function () {
      }
    }
  });
};

$(document).ready(function() {
  var listYears = '';
  var listMonths = '';
  var listDays = '';
  var listNationalities = '';
  var listCodes = '';

  for (var i = 1; i <= 31; i++) { //append to day dropdown the list of days from 1 to 31
    listDays+='<option value="'+i+'">'+i+'</option>'
  }
  $('#birth_day').append(listDays);

  var month= ["January","February","March","April","May","June","July",
              "August","September","October","November","December"];
  for (var i = 0; i < month.length; i++) { //append to month dropdown the list of month
    listMonths+= '<option value="'+month[i]+'">'+month[i]+'</option>'
  }
  $('#birth_month').append(listMonths);

  for (var i = 1900; i <= 2019; i++) { //append to day dropdown the list of days from 1 to 31
    listYears+='<option value="'+i+'">'+i+'</option>'
  }
  $('#birth_year').append(listYears);


  fetch("./assets/json/countries.json")
    .then(response => response.json())
    .then(countries => {
      for (country of countries) {
        listNationalities+='<option value="'+country["nationality"]+'">'+country["nationality"]+'</option>'
      }
      $('#nationality').append(listNationalities);
    })
  fetch("./assets/json/CountryCodes.json")
    .then(response => response.json())
    .then(codes => {
      for (code of codes) {
        listCodes+='<option value="'+code["dial_code"]+'">'+code["name"]+' ('+code["dial_code"]+')'+'</option>'
      }
      $('#country_code').append(listCodes);
    })
});
