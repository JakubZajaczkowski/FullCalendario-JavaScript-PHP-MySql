<!DOCTYPE html>
<html lang="en">
<head>
<center>
  <title>MagCalenadr</title>
  <link rel="shortcut icon" href="ikona.ico" type="image/x-icon" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/org/bootstrap.css">
  <link href='css/fullcalendar.css' rel='stylesheet' />
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/moment.min.js'>    </script>
<script src='js/jquery.min.js'>    </script>
<script src='js/fullcalendar.min.js'>    </script>
<script src='js/lang-all.js'>    </script>
  <script src="css/org/bootstrap.min.js">    </script>
  <link href="css/fullcalendar.css" rel='stylesheet' />

<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/fullcalendar.min.js'>    </script>
<script src='js/lang-all.js'>    </script>
  <link href='css/login.css' rel='stylesheet' />
</center>
</head>
<script>

var Przedmioty = { "Matematyka" : "#1bbc9b", "Polski" : '#F8CB00', "Fizyka" : '#68003C',  "Angielski" : '#668cff', "Niemiecki" : '#ff3f00', "WF" : '#ffa366', "Geografia" : '#ffc61a', "Chemia" : '#80bfff', "Geografia" : '#AA57BB', "Religia" : '#AA58BB', "Historia" : '#b38600', "Informatyka" : '#009900', "Wolne" : '#E7505A', "Biologia" : '#668529'};

var Kolory = { "Pierwszy" : "#003344" };

var p;
var a;
var b;
for (  p in Przedmioty ){
   a = p;
   b = Przedmioty[p];
   //Kolory.push(b,a);
   Kolory[b] =  a; 
}

$(document).ready(function() {

  $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});


$.each(Przedmioty, function(key, value) {
    $('#sel1').append($("<option/>", {
        text: key
    }));
});

  var calendar = $('#calendar').fullCalendar({
    events : "events.php" ,
  lang:'pl', 
   editable: true,
   header: {
    left: 'prev,next',
    center: 'title',
    right: 'today'
   },
   defaultView: 'month',
       slotDuration: '00:20:00',
       minTime: '01:00:00',
       maxTime: '10:00:00',
      weekends: false,
   
eventRender: function(event, element, view)
{ 
  element.find('.fc-title').before( '<u>' + Kolory[event.backgroundColor] + '</u><br/>');
  //element.find('.fc-title').append("<br/>" + event.title); 
  
},
   selectable: true,
   selectHelper: true,
   displayEventTime : false, 
   
   
         select: function(start, end, allDay) {
          endtime = end.format('HH:mm');
          starttime = start.format('YYYY/MM/DD HH:mm');
          var mywhen = starttime + ' - ' + endtime;
          $('#createEventModal #apptStartTime').val(start);
          $('#createEventModal #apptEndTime').val(end);
          $('#createEventModal #apptAllDay').val(allDay);
          $('#createEventModal #when').text(mywhen);
          $('#createEventModal').modal('show');
       }, 
   
  
   editable: true,
   
   
    eventDrop: function(event, delta) {
     var s = event.start.toJSON();
     if (event.end === null)
       var e = event.start.toJSON();
     else
       var e = event.end.toJSON();
   $.ajax({
   url: 'update_events.php',
   data: 'title='+ event.title+'&start='+ s +'&end='+ e +'&id='+ event.id ,
   type: "POST",
   success: function(json) {
        //alert('eventDrop success');
   }
   });
   },
   
   eventResize: function(event) {
   
     var s = event.start.toJSON();
     var e = event.end.toJSON();
     var dat = 'title='+ event.title+'&start='+ s +'&end='+ e+'&id='+ event.id
   $.ajax({
    url: 'update_events.php',
   data: 'title='+ event.title+'&start='+ s +'&end='+ e+'&id='+ event.id ,
    type: "POST",
    success: function(json) {
      //alert('eventResize success');
    }
   });
   
   }
		});
	console.log(calendar);	
	
	
  $('#submitButton').on('click', function(e){
   
    e.preventDefault();

    doSubmit();
  });

  function doSubmit(){
    $("#createEventModal").modal('hide');
    console.log($('#apptStartTime').val());
    console.log($('#apptEndTime').val());
    console.log($('#apptAllDay').val());
    console.log($('#sel1').val());
    ///alert("form submitted");
    
    var s = new Date($('#apptStartTime').val()).toJSON();
     var e = new Date($('#apptEndTime').val()).toJSON();
     var c = Przedmioty[$('#sel1').val()];
     $.ajax({
         url: 'add_events.php',
         data: 'title='+ $('#patientName').val() +'&start='+ s +'&end='+ e +'&url=' +  '&backgroundColor=' + c,
         type: "POST",
         success: function(json) {
            //alert('add success');
         }
     }); 
        
    $("#calendar").fullCalendar('renderEvent',
        {
            title: $('#patientName').val(),
            start: new Date($('#apptStartTime').val()).toJSON(),
            end: new Date($('#apptEndTime').val()).toJSON(),
            backgroundColor : c, 
            allDay: ($('#apptAllDay').val() == "true"),
        },
        true);
   }
   
	});

    </script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
<body>

<div class="container">
	<div id='calendar'></div>
</div>
	
<div class="modal fade" id="createEventModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Utwórz zdarzenie</h4>
        </div>
        <div class="modal-body">

       <div class="form-group">
         <div class="control-group">
              <label class="control-label" for="inputPatient">Opis zdarzenia</label>
              <div class="controls">
                  <input class="form-control" type="text" name="patientName" id="patientName" />
                    <input type="hidden" id="apptStartTime"/>
                    <input type="hidden" id="apptEndTime"/>
                    <input type="hidden" id="apptAllDay" />
              </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="when">Kiedy</label>
            <div class="controls controls-row" id="when" style="margin-top:7px;">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="sel1">Przedmiot :</label>
            <select class="form-control" id="sel1"  >
            </select>
          </div>
        </div> 
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Anuluj</a>
          <a href="#" class="btn btn-primary" id="submitButton" >Zapisz</a>
        </div>
      </div>
    </div>
</div>
</div>
<div class ="modal fade" id = "Login" >
    <div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Logowanie</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Rejestracja</a>
							</div>
						</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
