var loadingBar = document.getElementById("loading_bar");
document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () { loadingBar.classList.add("load") }, 750);
    setTimeout(function () { loadingBar.classList.remove("load"); loadingBar.classList.add("loading") }, 1500);

    if (document.readyState === "complete" || document.readyState === "loaded" || document.readyState === "interactive") {
        setTimeout(function () { loadingBar.classList.remove("loading"); loadingBar.classList.add("loaded") }, 3000);
        setTimeout(function () { loadingBar.classList.remove("loaded"); loadingBar.classList.add("hidden") }, 5000);
    }
})