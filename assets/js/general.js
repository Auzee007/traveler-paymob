document.addEventListener("DOMContentLoaded", function() {
    setInterval(() => {
        document.querySelector(".toplevel_page_traveler-paymob img").classList.remove("hoverZoomLink");
    }, 500);
    const observer = new MutationObserver(() => {
        const secretKeyInput = document.querySelector("#paymob_secret_key input");
        if (secretKeyInput) {
            if (!document.querySelector("#toggleSecretKey")) {
                const toggleBtn = document.createElement("span");
                toggleBtn.id = "toggleSecretKey";
                toggleBtn.type = "button";
                toggleBtn.textContent = "Show";
                toggleBtn.style.marginLeft = "10px";
                secretKeyInput.setAttribute("type", "password");
                // secretKeyInput.parentNode.insertBefore(toggleBtn, secretKeyInput.nextSibling);
                document.querySelector("#paymob_secret_key").appendChild(toggleBtn);
                toggleBtn.addEventListener("click", () => {
                    if (secretKeyInput.type === "password") {
                        secretKeyInput.setAttribute("type", "text");
                        toggleBtn.textContent = "Hide";
                    } else {
                        secretKeyInput.setAttribute("type", "password");
                        toggleBtn.textContent = "Show";
                    }
                });
            }
        }
    });
    observer.observe(document.body, { childList: true, subtree: true });
});