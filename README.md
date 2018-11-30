# mycalendar_ui
A web-based calendar assist tool.
gitpage of the ui available here: https://lijitin.github.io/mycalendar_ui/
(probably won't work properly anymore cuz it'll need a database now LOL)

database setup:

## database name: mycalendar
## table 1 name: logininfo
- number of columns: 2
- col1: username VARCHAR(40)
- col2: pw VARCHAR(40)
## table 2 name: events
- number of columns: 6
- col1: event_id INT
- col2: day INT
- col3: startTime INT
- col4: endTime INT
- col5: sender_username VARCHAR(40)
- col6: reciever_username VARCHAR(40)
## table 3 name: dept_events
-number of columns: 1
-col1: event_details VARCHAR(100)
