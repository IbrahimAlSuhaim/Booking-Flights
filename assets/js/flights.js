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
          if (next === 'f_return') {
            document.location.href = './returnFlights?departure_id='+flightId+'#return';
          }
          else if (next === 'd_passenger') {
            document.location.href = './passenger?departure_id='+flightId;
          }
          else if (next === 'r_passenger') {
            document.location.href = './passenger?return_id='+flightId;
          }

        }
      },
      cancel: function () {
      }
    }
  });
};

$(document).ready(function() {



// if we r in passengers page do this code
  if ($('#passengersNum').length){
    //passenger page
    var passengersNum = parseInt($('#passengersNum').html());

    var month= ["January","February","March","April","May","June","July",
    "August","September","October","November","December"];
    var listYears = '';
    var listMonths = '';
    var listDays = '';
    var listNationalities = '';
    var listCodes = '';
    for (var i = 1; i <= 31; i++) { //append to day dropdown the list of days from 1 to 31
      listDays+='<option value="'+i+'">'+i+'</option>'
    }

    for (var i = 0; i < month.length; i++) { //append to month dropdown the list of month
      listMonths+= '<option value="'+(i+1)+'">'+month[i]+'</option>'
    }

    for (var i = 1900; i <= 2019; i++) { //append to year dropdown the list of years from 1900 to 2019
      listYears+='<option value="'+i+'">'+i+'</option>'
    }

    //append to Dropdowns
    for (var i = 1; i <= passengersNum; i++) {
      $('#birth_day_'+i).append(listDays);
      $('#birth_month_'+i).append(listMonths);
      $('#birth_year_'+i).append(listYears);
    }

    fetch("./assets/json/countries.json")
      .then(response => response.json())
      .then(countries => {
        for (country of countries) {
          listNationalities+='<option value="'+country["nationality"]+'">'+country["nationality"]+'</option>'
        }
        for (var i = 1; i <= passengersNum; i++) {
          $('#nationality_'+i).append(listNationalities);
         }

         // add change event listener to all nationality select
        var i, j;
        $('.nationality').change(function(){
          console.log("nationality changed");
            i = this.id.slice(12);
            console.log(i);
            j = this.value;
            console.log(j);
            if( j === 'Saudi'){
              $("#national_id_"+i).show();
            }
            else {
              $("#national_id_"+i).hide()
            }
        });
      })

    fetch("./assets/json/CountryCodes.json")
      .then(response => response.json())
      .then(codes => {
        for (code of codes) {
          listCodes+='<option value="'+code["dial_code"]+'">'+code["name"]+' ('+code["dial_code"]+')'+'</option>'
        }
        for (var i = 1; i <= passengersNum; i++) {
          $('#country_code_'+i).append(listCodes);
        }
      })

  }
});
