window.addEventListener("load", () => {
    // nav tabs
    const tabs = document.querySelectorAll("ul.nav-tabs > li");

    for (i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", switchTab);
    }

    function switchTab(event) {
        event.preventDefault();

        // clear current active tab & pane
        document.querySelector("ul.nav-tabs > li.active").classList.remove("active");
        document.querySelector(".tab-pane.active").classList.remove("active");

        const clickedTab = event.currentTarget;
        const anchor = event.target;
        const activePaneID = anchor.getAttribute("href");

        // set clicked tab & pane as active
        clickedTab.classList.add("active");
        document.querySelector(activePaneID).classList.add("active");
    }
});