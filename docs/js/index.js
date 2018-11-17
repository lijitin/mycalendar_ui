
cleanCalendar();
addOptions(); // adding options in the meeting modal form
// dayOfWeek, lowTime, highTime, timeSlot are all INTEGERS.
// dayOfWeek: int, range[0-6] (0 - Sunday, 1 - Monday, etc...)
// lowTime, highTime, timeSlot: int, range[6-23] (6 - the timeslot from morning 6am to 7am, 7 - 7am to 8am, 23 - 11pm-00am)

function createMessage(username, index){    
    // create a message on the message box
    // takes in a username and index
    // the approve & decline buttons have ids of "approve-btn1" & "decline-btn1" etc
    var id = "message" + index;
    var msgDiv = document.getElementById(id);
    var element = "";
    element = "<form> <p>Meeting - " + username + "!</p>";
    element = element + "<input type=\"button\" class=\"approve\" id=\"approve-btn" + index + 
    "\" value=\"approve\"></input> <input type=\"button\" class=\"decline\" id=\"decline-btn" + index + "\" value=\"decline\"></form>";
    msgDiv.innerHTML = element;
}

// message modal form button interactions
var messageModal = document.getElementById("sendMessageModal");
var messageBtn = document.getElementById("message-btn");
var messageExitBtn = document.getElementById("messageCancel-btn");
messageBtn.onclick = function(){
    messageModal.style.display = "block";
    document.getElementById("message-errmsg").style.display = "none";
}
messageExitBtn.onclick = function(){
    messageModal.style.display = "none";
}

// meeting modal form button interactions
var meetingModal = document.getElementById("arrangeMeetingModal");
var meetingBtn = document.getElementById("meeting-btn");
var meetingExitBtn = document.getElementById("meetingCancel-btn");

meetingBtn.onclick = function(){
    meetingModal.style.display = "block";
    document.getElementById("meeting-errmsg").style.display = "none";
}
meetingExitBtn.onclick = function(){
    meetingModal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == meetingModal) {
        meetingModal.style.display = "none";
    }else if(event.target == messageModal) {
        messageModal.style.display = "none";
    }
}

var meetingSubmitBtn = document.getElementById("meetingSubmit-btn");   
// display the event on the calendar
meetingSubmitBtn.onclick = function(){
    var errmsg = document.getElementById("meeting-errmsg");
    
    var day = parseInt(document.getElementById("selectedDay").value);
    var time1= parseInt(document.getElementById("selectedTime1").value);
    var time2 = parseInt(document.getElementById("selectedTime2").value);
    // console.log(day, time1, time2);
    if(isNaN(day) || isNaN(time1) || isNaN(time2)){
        // insufficient user inputs
        console.log("Insufficient user inputs");
        errmsg.innerHTML = "Please select the day, starting time, and ending time of the proposed meeting.";
        errmsg.style.display = "inline-block";
        return;
    }

    selectCells(day, time1, time2, "pink");
    
    meetingExitBtn.onclick();

}
// selecting a range of calendar cells
function selectCells(dayOfWeek, lowTime, highTime, color){
    
    var currTime = highTime;
    // keep on selecting from highTime until reaches the lowTime
    while(currTime > lowTime){
        // console.log(currTime);
        changeCell(dayOfWeek, currTime, color);
        currTime = currTime - 1;
    }
    // change the lowTime cell into a leader cell with proper hrefs.
    leaderCell(dayOfWeek, lowTime, "/", color);

}

// change the cell to include a link/ href for the selected "leader" cell
function leaderCell(dayOfWeek, timeSlot, href, color){
    changeCell(dayOfWeek, timeSlot, color);
    var element = document.getElementsByClassName("day" + dayOfWeek + " " + "time" + timeSlot);
    element[0].innerHTML = "LEADERCELL";
}
// change a single calendar slot to a different color
function changeCell(dayOfWeek, timeSlot, color){

    // don't forget to translate the ints to strings, to match the classnames.
    var element = document.getElementsByClassName("day" + dayOfWeek + " " + "time" + timeSlot);
    element[0].innerHTML= "SELECTED";
    element[0].style.backgroundColor = color;
}

// adding options for the modal form
function addOptions(){
    // sample outputs
    //     <option value="6">0600</option>
    //     <option value="7">0700</option>
    //     <option value="8">0800</option>
    //     <option value="9">0900</option>
    //          ...
    var optionEle = "";
    var time = 6;
    var timestr;

    while(time < 24){
        timestr = "";
        if(time<10){
            timestr = "0".concat(time);
        }else{
            timestr = time;
        }
        timestr = timestr + "00";
        
        optionEle = optionEle + "<option value=\"" + time + "\">" + timestr + "</option>";
        time = time + 1;
    }
    var timeoptions = document.getElementsByClassName("timeoptions");

    timeoptions[0].innerHTML = optionEle;
    timeoptions[1].innerHTML = optionEle;
}

// generate a clean calendar
function cleanCalendar(){
    // table head
    var labelRow = "<tr id=\"labelrow\"><th id=\"timecol\"></th><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>"
    
    // sample output html for each tr element
        // <tr class="even time6">
        //     <td>0600</td>
        //     <td class="day0"></td>
        //     <td class="day1"></td>
        //     <td class="day2"></td>
        //     <td class="day3"></td>
        //     <td class="day4"></td>
        //     <td class="day5"></td>
        //     <td class="day6"></td>
        // </tr>
    // add td elements for the time column
    time = 6;
    var tableEle = "";
    var time;
    var timestr;
    while(time < 24){
        timestr = "";
        if(time<10){
            timestr = "0".concat(time);
        }else{
            timestr = time;
        }
        timestr = timestr + "00";

        var tableRow = "";

        var day = 0;
        // first line
        if(time%2 === 0){
            tableRow = tableRow.concat("<tr class=\"even time", time, "\">");
        }else{
            tableRow = tableRow.concat("<tr class=\"odd time", time, "\">");
        }
        // second line
        // fill in the time column
        var tableCells = "";
        tableCells = "<td>" + timestr + "</td>";
        // the rest of the week td cells
        while(day < 7){
            tableCells = tableCells.concat("<td class=\"day", day, " time" , time, "\"></td>");
            day = day + 1;
        }
        // closing tag
        tableEle = tableEle.concat(tableRow, tableCells, "</tr>");
        time = time + 1;
    }
    document.getElementById("cal").innerHTML = labelRow + tableEle;
}