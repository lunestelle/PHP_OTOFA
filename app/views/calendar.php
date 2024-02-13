<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
      <h6 class="title-head">Schedule New Appointment</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12">
          <div class="container">
            <div id="newAppointmentForm">
              <div id="calendar" class="mt-2 mb-3"></div>

              <!-- Start popup dialog box -->
              <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel">Set Appointment</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="img-container">
                        <div class="row">
                          <div class="col-sm-6">  
                            <div class="form-group">
                              <label for="appointment_date">Appointment Date</label>
                              <input type="date" name="appointment_date" id="appointment_date" class="form-control onlydatepicker" placeholder="Appointment Date" required>
                            </div>
                          </div>
                          <div class="col-sm-6">  
                            <div class="form-group">
                              <label for="appointment_time">Appointment Time</label>
                              <input type="time" name="appointment_time" id="appointment_time" class="form-control" placeholder="Appointment Time" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary" onclick="save_event()">Save</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End popup dialog box -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function() {
    display_events();
  });

  function display_events() {
    var events = new Array();
    $.ajax({
      url: 'display_calendar',
      dataType: 'json',
      success: function(response) {
        var result = response.data;
        $.each(result, function (i, item) {
          events.push({
              title: '<span style="display: block; text-align: center; font-weight: bold; color: black; padding: 2px 5px; border-radius: 3px;">' + result[i].title + '</span>',
              start: result[i].start,
              color: result[i].color,
              allDay: true
            }); 	
        })
        var calendar = $('#calendar').fullCalendar({
          defaultView: 'month',
          timeZone: 'local',
          editable: true,
          selectable: true,
          selectHelper: true,
          select: function(start) {
            $('#appointment_date').val(moment(start).format('YYYY-MM-DD'));
            $('#event_entry_modal').modal('show');
          },
          events: events,
          eventRender: function(event, element, view) {
            element.find('.fc-title').html(event.title);
            element.bind('click', function() {

            });
          },
          header: {
            left: '',
            center: 'title',
            right: ''
          },
        });
        
      },
      error: function(xhr, status, error) {
        alert("Error: " + error);
      }
    });
  }

  function save_event() {
    var event_name = $("#event_name").val();
    var appointment_date = $("#appointment_date").val();
    var appointment_time = $("#appointment_time").val();
    if (event_name == "" || appointment_date == "" || appointment_time == "") {
      alert("Please enter all required details.");
      return false;
    }
    $.ajax({
      url: "save_event.php",
      type: "POST",
      dataType: 'json',
      data: {
        event_name: event_name,
        appointment_date: appointment_date,
        appointment_time: appointment_time
      },
      success: function(response) {
        $('#event_entry_modal').modal('hide');
        if (response.status == true) {
          alert(response.msg);
          location.reload();
        } else {
          alert(response.msg);
        }
      },
      error: function(xhr, status, error) {
        console.log('ajax error = ' + error);
        alert("Error: " + error);
      }
    });
    return false;
  }
</script>