<!DOCTYPE html>
<html>
  <head>
    <title>MyCalendar</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/index_style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
  </head>
  <body>
    <?php
      include "loadInfo.php";
    ?>
    <header>
      <div>
        <div id="logo">
          <span>MYCALENDAR</span>
          <form action="/">
            <!-- placeholder for php or js, currently uses html anchors to get back to login page. -->
            <a href="./login.html"><input id="logout" type="button" value="Logout"></a>
          </form>
      </div>
    </header>
    <div class="main-body">
      <div class="top">
        <div class="column1">
          <div class="option-box">
            <form action="/">
               <!-- these option-box buttons opens up modal forms -->
              <input id="meeting-btn" type="button" value="Arrange Meeting">
              <input id="message-btn" type="button" value="Send Messages">
            </form>
          </div>
          <div class="message-box">
            <div class="title">
              <h1>New Messages</h1>
            </div>
            <div id="message">
              <!-- Messages goes in each unsorted list -->
              <div id="message0">
                <form action="./confirmMeeting.php" method="GET">
                  <p>Meeting - {username}!</p>
                  <input type="hidden" value="foo" name="event_id">
                  <input type="submit" class="approve" id="approve-btn0" value="approve">
                  <input type="submit" class="decline" id="decline-btn0" value="decline">
                </form>
              </div>
              <div id="message1">

              </div>
              <div id="message2">

              </div>
            </div>
          </div>
        </div>
        <div class="column2">
          <div class="calendar">
            <!-- time starts from 0600 to 0000-->
            <table id="cal">
              <tr id="labelrow">
                <th></th>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
              </tr>
              <tr class="even time6">
                <td>0600</td>
                <td class="day0"></td>
                <td class="day1"></td>
                <td class="day2"></td>
                <td class="day3"></td>
                <td class="day4"></td>
                <td class="day5"></td>
                <td class="day6"></td>
              </tr>
              <tr class="odd time7">
                <td>0700</td>
                <td class="day0"></td>
                <td class="day1"></td>
                <td class="day2"></td>
                <td class="day3"></td>
                <td class="day4"></td>
                <td class="day5"></td>
                <td class="day6"></td>
              </tr>
              <tr>
                <td>0800</td>
              </tr>
              <tr>
                <td>0900</td>
              </tr>
              <tr>
                <td>1000</td>
              </tr>
              <tr>
                <td>1100</td>
              </tr>
              <tr>
                <td>1200</td>
              </tr>
              <tr>
                <td>1300</td>
              </tr>
              <tr>
                <td>1400</td>
              </tr>
              <tr>
                <td>1500</td>
              </tr>
              <tr>
                <td>1600</td>
              </tr>
              <tr>
                <td>1700</td>
              </tr>
              <tr>
                <td>1800</td>
              </tr>
              <tr>
                <td>1900</td>
              </tr>
              <tr>
                <td>2000</td>
              </tr>
              <tr>
                <td>2100</td>
              </tr>
              <tr>
                <td>2200</td>
              </tr>
              <tr>
                <td>2300</td>
              </tr>
            </table>

          </div>
        </div>
      </div>
      
      <?php	  
        
        
        // connect to the database
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "mycalendar";

        // Creating connection with database.
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // Checking the connectivity with the database.
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // query for the row with the event_id
        $query = "SELECT * FROM dept_events";
        // this should only return one row
        // extract the info
        $result = $conn->query($query);
      $events;
        

      if ($result->num_rows > 0) {
        echo "<div class='bottom'>";
        echo"<h1 text-color='blue'>Events!!</h1>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
          
          echo"<div class='announcements'>";
          echo"<div class='event1'>";
          echo"<marquee>";
          echo"<a href = '#' color='blue'>";
          echo$row['event_details'];
          echo "</a>";
          echo"</marquee>";
          echo"</div>";
          echo"</div>";
            }
        echo"</div>";
        }

      ?>

    </div>
    <div class="footer">
      <span>&copy;All rights reserved</span>
    </div>


    <!-- meeting modal form, for arranging meetings -->
    <!-- link with php or something else to connect to database (i guess) -->
    <div id="arrangeMeetingModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <form action="./arrangeMeeting.php" method="GET">
          <div class="top">
            <h1>Meeting Arrangement Form</h1>
          </div>
          <div class="mid">
            <div>
              <span>Who's invited?</span>
              <input type="text" name="invitedUser"><br>
            </div>
            <div>
              <span>Date of meeting?</span>
              <select size="7" id="selectedDay" name="day">
                <option value="0">Sunday</option>
                <option value="1">Monday</option>
                <option value="2">Tueday</option>
                <option value="3">Wednesday</option>
                <option value="4">Thursday</option>
                <option value="5">Friday</option>
                <option value="6">Saturday</option>
              </select><br>
            </div>
            <div>
              <span>Time: starts from</span>
              <select class="timeoptions" size="5" id="selectedTime1" name="startTime">
                  <option value="6">0600</option>
                  <option value="7">0700</option>
                  <option value="8">0800</option>
                  <option value="9">0900</option>
              </select>
              <span>to</span>
              <select class="timeoptions" size="5" id="selectedTime2" name="endTime">
              </select>
            </div>
          </div>
          <div class="bottom">
            <div><span id="meeting-errmsg"></span></div>
            <input type="button" class="cancel" id="meetingCancel-btn" value="cancel">
            <input type="submit" class="submit" id="meetingSubmit-btn" value="submit">
          </div>
        </form>
        

      </div>
    </div>

    <div id="sendMessageModal" class="modal">
      <div class="modal-content">
        <form>
          <div class="top">
            <h1>Message Sending Form</h1>
          </div>
          <div class="mid">
            <div>
              <span>Recipient:</span>
              <input type="text"><br>
            </div>
            <div>
              <span>Message Content:</span>
              <textarea>Testing message</textarea>
            </div>
          </div>
          <div class="bottom">
            <div><span id="message-errmsg"></span></div>
            <input type="button" class="cancel" id="messageCancel-btn" value="cancel">
            <input type="button" class="submit" id="messageSubmit-btn" value="submit">
          </div>
        </form>
        </div>
    </div>


    
    <div class="test">
      <p id="debug">default</p>
      <button type="button" onclick="cleanCalendar()">cleanCalendar</button>
      <button type="button" onclick="selectCells(3, 7, 12, 'pink')">setslot</button>
    </div>
    <script src="../js/index.js"></script>
    <script type="text/javascript">
    // a js section which updates the calendar and messagebox according to the database
      var events = <?php echo json_encode($events) ?>; // put the database info into a js object
      var color = "cyan";
      if(events !== "NULL"){
          events.forEach(function(event){ // use a forEach loop to read and set each events
          var day, startTime, endTime;
          day = parseInt(event['day']);
          startTime = parseInt(event['startTime']);
          endTime = parseInt(event['endTime']);
          selectCells(day, startTime, endTime, color);
        });
      }
      var messages = <?php echo json_encode($messages) ?>;
      if(messages !== "NULL"){
        // only display the first 3 invitations
        var i;
        for(i = 0; i<3 && messages[i]!= undefined; i++){
          var inviter = messages[i]["sender_username"];
          var event_id = messages[i]["event_id"];
          createMessage(inviter, i, event_id);
        }
      }
    </script>

  </body>
</html>
