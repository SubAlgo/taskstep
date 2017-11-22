
function create_ical(vDate, vTime, vTaskid){
    /*Check Value
        -----------*/
    if (vDate == '') {
        alert("Date is null")
        return
    }

    if (vTime == '') {
        alert("Time is null")
        return
    }

    if (vTaskid == '') {
        alert("Task is null")
        return
    }

    /* Set format Date
    ----------------*/
    var mystr = vDate.split('/')
    var d, m, y;
    var myTime;
    var myDate;
    
    d = mystr[0]
    m = mystr[1]
    y = mystr[2] - 543

    /*Set format Date
    
    if (mystr[0] < 10) {
        d = "0" + mystr[0]
    } else {
        d = mystr[0]
    }
    ----------------*/

    /*Set format Month
    
    if (mystr[1] < 10) {
        m = "0" + mystr[1]
    } else {
        m = mystr[1]
    }
    ----------------*/

    /*Set format Year
    
    y = mystr[2] - 543
    ---------------*/

    /*Set to YYYY-MM-DD
    ------------------*/
    vDate = m + "/" + d + "/" + y
    

    /*Set to 00:00:00
    
    myTime = vTime + ":" + "00"
    ------------------*/

    /*Set to YYYY-MM-DD 00:00:00
    
    var returnData = myDate + " " + myTime
    ------------------*/

    /*Set Json Data
    -------------*/
    var returnData = vDate + ' ' + vTime
    
    var appointData = { "DateTime": returnData, "taskId": vTaskid }

    return JSON.stringify(appointData)
}
