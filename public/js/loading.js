// ?todo show loading mail
function showLoadingScreens() {
    document.getElementById("container").style.display = "none";
    document.getElementById("loading-screen").style.display = "flex";

    let delayInSeconds = 10000;

    setTimeout(function () {
        document.getElementById("loading-screen").style.display = "none";
        document.getElementById("container").style.display = "block";
    }, delayInSeconds);
}

// ?todo Show loading screen
function showLoadingScreen() {
    document.getElementById("container").style.display = "none";
    document.getElementById("loading-screen").style.display = "flex";

    // Set a fixed loading duration, e.g., 20 seconds
    let delayInSeconds = 20000;

    setTimeout(function () {
        document.getElementById("loading-screen").style.display = "none";
        document.getElementById("container").style.display = "block";
        document.getElementById("error-message").style.display = "none"; // Hide error message
        document.getElementById("upload-label-text").style.display = "block"; // Show upload label text
    }, delayInSeconds);
}
