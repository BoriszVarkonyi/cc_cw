function refPisTimePanel() {
    var panel = document.getElementById("ref_pis_time_panel");
    panel.classList.toggle("hidden");
}

function poolConfigToggle(x) {
    var clickedButton = x;
    var pool = clickedButton.parentNode.parentNode;
    var configPanel = pool.lastElementChild;

    configPanel.classList.toggle("hidden")
}

function poolConfigClose(x) {
    var clickedButton = x;
    var panel = clickedButton.parentNode;

    panel.classList.toggle("hidden")
}

function disqualifyToggle() {
    var panel = document.getElementById("disqualify_panel");
    panel.classList.toggle("hidden");
}

function useAll() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.add("disabled")
}

function selectPistes() {
    var selectPistes = document.getElementById("select_pistes_panel");
    selectPistes.classList.remove("disabled")
}

function allowDrop(ev) {
    ev.preventDefault();
  }
  
  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }
  
  function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
  }