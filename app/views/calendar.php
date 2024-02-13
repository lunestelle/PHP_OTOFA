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
                      <h5 class="modal-title" id="modalLabel">Add New Event</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="img-container">
                        <div class="row">
                          <div class="col-sm-12">  
                            <div class="form-group">
                              <label for="event_name">Event name</label>
                              <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter your event name">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">  
                            <div class="form-group">
                              <label for="event_start_date">Event start</label>
                              <input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Event start date">
                            </div>
                          </div>
                          <div class="col-sm-6">  
                            <div class="form-group">
                              <label for="event_end_date">Event end</label>
                              <input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
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
    
              title: result[i].title,
              start: result[i].date,
              color: result[i].color
            }); 	
        })
        var calendar = $('#calendar').fullCalendar({
          defaultView: 'month',
          timeZone: 'local',
          editable: true,
          selectable: true,
          selectHelper: true,
          select: function(start) {
            alert(start);
            $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
            $('#event_entry_modal').modal('show');
          },
          events: events,
          eventRender: function(event, element, view) {
            element.bind('click', function() {
              
            });
          }
        });
      },
      error: function(xhr, status) {
        alert(response.msg);
      }
    });
  }

  function save_event() {
    var event_name = $("#event_name").val();
    var event_start_date = $("#event_start_date").val();
    var event_end_date = $("#event_end_date").val();
    if (event_name == "" || event_start_date == "" || event_end_date == "") {
      alert("Please enter all required details.");
      return false;
    }
    $.ajax({
      url: "save_event.php",
      type: "POST",
      dataType: 'json',
      data: {
        event_name: event_name,
        event_start_date: event_start_date,
        event_end_date: event_end_date
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
      error: function(xhr, status) {
        console.log('ajax error = ' + xhr.statusText);
        alert(response.msg);
      }
    });
    return false;
  }
</script>