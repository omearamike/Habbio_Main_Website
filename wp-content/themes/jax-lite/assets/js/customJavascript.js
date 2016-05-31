// Custom Javascript File
function habitContent(section) {

    if (section == "showMorning") {
    document.getElementById("morningContent").style.visibility="show";
    document.getElementById("eveningContent").style.visibility="hidden";
    document.getElementById("afternoonContent").style.visibility="hidden";
    console.log("Morning Show");
  }
  else if (section == "showEvening") {
    document.getElementById("eveningContent").style.visibility="show";
    document.getElementById("morningContent").style.visibility="hidden";
    document.getElementById("afternoonContent").style.visibility="hidden";

    console.log("Evening Show");
  }
  else if (section = "showAfternoon") {
    document.getElementById("afternoonContent").style.visibility="show";
    document.getElementById("eveningContent").style.visibility="hidden";
    document.getElementById("morningContent").style.visibility="hidden";
    console.log("Afternoon");

  }
}
