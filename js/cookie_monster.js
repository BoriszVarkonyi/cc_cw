//gets the cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function cookieFinder(cookieName, defaultValue, isNumber) {
    String(cookieName)
    //If found da cookie
    if (document.cookie.split(';').some((item) => item.trim().startsWith(cookieName + '='))) {
        if (isNumber) {
            return parseInt(getCookie(cookieName))
        }
        else{
            return getCookie(cookieName)
        }
    }
    //If not found da cookie
    else {
        document.cookie = (cookieName + "=") + defaultValue
        return defaultValue;
    }

}

