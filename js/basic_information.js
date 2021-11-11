var cou = document.getElementById("country_input");
var loc = document.getElementById("location_input");
var pos = document.getElementById("postal_input");
var mon = document.getElementById("money_input");

var text = document.getElementById("save_text");

if (cou.value != "") {
	text.innerHTML = "Update Information"
}

var postInput = document.getElementById("postal_input")
postInput.addEventListener("input", function () {
	if (this.value > 9999999999) {
		this.value = this.value.slice(0, -1);
	}
})