# mycalendar_ui
A web-based calendar assist tool.
gitpage of the ui available here: https://lijitin.github.io/mycalendar_ui/
(probably won't work properly anymore cuz it needs to connect to a database now LOL)

database setup:

## database name: mycalendar
## table 1 name: logininfo
- number of columns 2
- col1: username varchar(40)
- col2: pw  varchar(40)
## table 2 name: events
- number of columns 6
- col1: event_id int(11)
- col2: day int(11)
- col3: startTime int(11)
- col4: endTime int(11)
- col5: sender_username varchar(40)
- col6: reciever_username varchar(40)
