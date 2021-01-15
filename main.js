var date = new Date(phpDate);
document.getElementById("lastUpdate").innerHTML = "Last Update: " + date.toLocaleString('en-US', { month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true });

function toggleNav() {
    if(document.getElementById("sidebar").style.width == "250px")
    {
        document.getElementById("sidebar").style.width = "0px";
    }
    else{
        document.getElementById("sidebar").style.width = "250px";
    }
}