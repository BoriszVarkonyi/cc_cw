var bookmarkCookies = cookieFinder("bookmarks", "", false, 365)
//Makes the saved bookmarks bookmarked when the page is loaded
var bookmarkButtons = document.querySelectorAll(".bookmark_button");
var cookieInArray = bookmarkCookies.split(",");
for (i = 0; i < bookmarkButtons.length; i++) {
    for (k = 0; k < cookieInArray.length; k++) {
        if (bookmarkButtons[i].value == cookieInArray[k]) {
            bookmarkButtons[i].querySelector("img").src = "../assets/icons/bookmark_black.svg"
        }
    }
}

function favButton(x) {
    //Bookmark image
    var favImage = x.querySelector("img")
    //Cuts down the html path
    var source = favImage.src.replace(favImage.src.substring(0, favImage.src.lastIndexOf("/")) + "/", "");
    var buttonValue = x.value;
    if (source == "bookmark_border_black.svg") {
        //Bookmarked
        favImage.src = "../assets/icons/bookmark_black.svg"
        //Makes the cookie value
        if (cookieFinder("bookmarks", "", false) == "") {
            document.cookie = "bookmarks = " + buttonValue + ";" + setExpireDay(365);
        }
        else {
            document.cookie = "bookmarks = " + cookieFinder("bookmarks", "", false) + "," + buttonValue + ";" + setExpireDay(365);
        }
    }
    else {
        //Not bookmarked
        favImage.src = "../assets/icons/bookmark_border_black.svg"
        var cookieInArray = cookieFinder("bookmarks", "", false).split(",");
        var cookieNewValue = "";
        //Deletes the bookmark
        for (i = 0; i < cookieInArray.length; i++) {
            if (cookieInArray[i] != buttonValue) {
                if (cookieNewValue == "") {
                    cookieNewValue = cookieInArray[i]
                }
                else {
                    cookieNewValue += "," + cookieInArray[i]
                }
            }
        }
        //Sets the new value
        document.cookie = "bookmarks = " + cookieNewValue + ";" + setExpireDay(365);;
    }
}