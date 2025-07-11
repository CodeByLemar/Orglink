
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            
            views: {
                timeGridFourDay: {
                    type: 'timeGrid',
                    dayCount: 4
                }
            } ,
            events:[{ 
                "title": "Client 1 - Operation 1", // Required
                "start": "2024-06-21", // Required  
                "end": "2024-06-21", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 3 - Operation 3", // Required
                "start": "2024-06-17", // Required  
                "end": "2024-06-17", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 2 - Operation 2", // Required
                "start": "2024-06-23", // Required  
                "end": "2024-06-23", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 1 - Operation 2", // Required
                "start": "2024-06-23", // Required  
                "end": "2024-06-23", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 3 - Operation 2", // Required
                "start": "2024-06-23", // Required  
                "end": "2024-06-23", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "white", // Optional
                "textColor": "black" // Optional
            },{ 
                "title": "Client 1 - Operation 3", // Required
                "start": "2024-06-25", // Required  
                "end": "2024-06-25", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                // "borderColor": "red", // Optional
                // "backgroundColor": "yellow", // Optional
                // "textColor": "green" // Optional
            },{ 
                "title": "Client 3 - Operation 2", // Required
                "start": "2024-06-25", // Required  
                "end": "2024-06-25", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "white", // Optional
                "textColor": "black" // Optional
            },{ 
                "title": "Client 1 - Operation 1", // Required
                "start": "2024-06-27", // Required  
                "end": "2024-06-27", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "green", // Optional
                "textColor": "white" // Optional
            },{ 
                "title": "Client 1 - Consultation", // Required
                "start": "2024-06-29", // Required  
                "end": "2024-06-29", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "green", // Optional
                "textColor": "white" // Optional
            },{ 
                "title": "Client 2 - Consultation", // Required
                "start": "2024-06-29", // Required  
                "end": "2024-06-29", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "green", // Optional
                "textColor": "white" // Optional
            },{ 
                "title": "Client 3 - Consultation", // Required
                "start": "2024-06-29", // Required  
                "end": "2024-06-29", // Optional
                // "url": "http://google.com", // Optional, will not open because of browser-iframe security issues
                // "className": "test-class", // Optional
                // "editable": true, // Optional
                // "color": "yellow", // Optional
                "borderColor": "black", // Optional
                "backgroundColor": "green", // Optional
                "textColor": "white", // Optional,
                "tooltip": "test"
            }] 
            ,eventDidMount: function (info) {
                //month, weeek and day timeview
                var _title = info.el.querySelectorAll('.fc-event-title')[0];
                if (_title) {
                    _title.innerHTML = info.event.title;
                }
                else {
                    //listview/agenda
                    var _list_event_title = info.el.querySelectorAll('.fc-list-event-title')[0];
                    if (_list_event_title) {
                        var _a = $('a', _list_event_title)[0];
                        if(_a) {
                        _a.innerHTML = info.event.title;
                        }
                    }
                
                }

            } 
        });
        calendar.render();
    });  
</script>