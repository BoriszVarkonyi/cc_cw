//Decides which js file needed to be loaded
addScript = function(number) {
    var body = document.getElementsByTagName("body")[0],
        script = document.createElement('script');

    script.src ='../js/pools_state' + number + '.js'
    body.appendChild(script);
};
var state = document.getElementsByClassName("state_2")
if(state.length == 0){
    addScript('1');
}
if(state.length == 1){
    addScript('2');
}