function toggleModal(modalIdNumber) {
    // Adds stylesheet for modals beacuse perfomance good
    document.querySelector("head").insertAdjacentHTML("beforeend", "<link rel=\"stylesheet\" href=\"../css/modal_style.min.css\"/>");

    if (Number.isInteger(modalIdNumber)) {
        var currentModal = document.getElementById("modal_" + modalIdNumber);
        currentModal.classList.toggle("hidden");
    } else if (modalIdNumber == "EULA") {
        var eulaContent = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sit amet massa tristique felis pulvinar aliquam. Nullam fermentum tortor vel nunc accumsan pharetra. Nulla dignissim lacus eget nulla tempus laoreet. Integer non iaculis enim. Nam ultrices mollis venenatis. Integer et ultricies elit, vel semper risus. Integer nisl sapien, imperdiet vitae ante eu, ultrices sagittis mauris.";
        var eulaModal = "<div class='modal_wrapper' id='modal_eula'><div class='modal'><div class='modal_header blue'><p class='modal_title'>End User License Agreement</p><p class='modal_subtitle'>Please read the following information before continuning</p></div><div class='modal_main'><p class='modal_main_title margin_bottom'>You must accept the agreement before using the program.</p><p class='modal_paragraph'>" + eulaContent + "</p></div><div class='modal_footer'><p class='modal_footer_text'>Not accepting this agreement will log you out.</p><div class='modal_footer_content'><a href='index.php' class='modal_decline_button'>Decline</a><button class='modal_confirmation_button'>Accept</button></div></div></div></div>";
        document.querySelector("body").insertAdjacentHTML("beforeend", eulaModal);
    } else if (modalIdNumber == "cookies") {
        var cookiesContent = ["Navigation Bar pinning", "Color modes and Contrast color modes", "Set and load selected language", "Table: Save position of users view", "Table: Save users match density preference"];
        var cookiesModal = "<div class='modal_wrapper' id='modal_cookies'><div class='modal'><div class='modal_header blue'><p class='modal_title'>Your privacy</p><p class='modal_subtitle'>Please read the follwoing information before continuning</p></div><div class='modal_main'><p class='modal_main_title big'>We use cookies on all CC sites for personalised content and enhancing user experience.</p><p class='modal_paragraph margin_top margin_bottom primary title'>If you do not enable cookies then following features will not work:</p>" + cookiesContent + "</div><div class='modal_footer'><p class='modal_footer_text'>Not accepting this agreement will result this panel to appear after every login.</p><div class='modal_footer_content'><button class='modal_decline_button' onclick=''>Decline</button><button class='modal_confirmation_button'>Accept</button></div></div></div></div>";
        document.querySelector("body").insertAdjacentHTML("beforeend", cookiesModal);
    } else if (modalIdNumber == "bug") {
        var bugReportContent = "";
        var bugReportModal = "<div class='modal_wrapper' id='modal_bug'><div class='modal'><div class='modal_header blue'><p class='modal_title'>Report bug or issue relating to the program</p><p class='modal_subtitle'>We are thankful for any support!</p></div><div class='modal_main'><p class='modal_main_title big'>Browser you are using:</p><p class='modal_paragraph'>" + "</p></div><div class='modal_footer'><div class='modal_footer_content'><button class='modal_decline_button' onclick=''>Cancel</button><button class='modal_confirmation_button'>Send</button></div></div></div></div>"
        document.querySelector("body").insertAdjacentHTML("beforeend", bugReportModal);
    } else {
        console.log("Incorrect Modal parameter");
    }
}