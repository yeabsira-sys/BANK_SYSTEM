const body = document.getElementsByTagName("body");
document.body.addEventListener("load", initializeClock());

function activeClock(){
  let now = new Date();
    let date = now.getDate(),
          day = now.getDay(),
          month = now.getMonth(),
          year = now.getFullYear(),
          time = now.getHours(),
          minute = now.getMinutes(),
          second = now.getSeconds();
     let  period = "Am";
          if(time > 12){
            time = time % 12;
            period = "Pm";
          }
          if(time == 0){
              time = 12;
          }
          
    const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    const days = ["sunday","monday", "tuesday", "wednsday", "thursday", "friday", "saturday"];
    const ids = ["day", "date", "month", "year", "hour", "minute","seconds", "ampm"];
    let values = [days[day], date, months[month], year, time, minute, second, period];

    for(let i = 0; i<ids.length; i++)
      document.getElementById(ids[i]).firstChild.nodeValue = values[i];
      if(document.getElementById('minute').length == 1){
        document.getElementById('minute').innerHTML = "0" + minute.toString();
      }
      if(document.getElementById('seconds').length == 1){
        document.getElementById('seconds').innerHTML = "0" + second.toString();
      }

}
function initializeClock(){
  activeClock();
  window.setInterval("activeClock()", 1);
}
