const accordions = document.getElementsByClassName('has-submenu');
const slideoutButton = document.getElementById('admin-slideout-button');

function setSubmenuStyles(submenu, maxHeight, margins) {
    submenu.style.maxHeight = maxHeight;
    submenu.style.marginTop = margins;
    submenu.style.marginBottom = margins;
}

slideoutButton.onclick = function () {
    this.classList.toggle('is-active');
    document.getElementById('admin-side-menu').classList.toggle('is-active');
}

for (let i = 0; i < accordions.length; i++) {

    if (accordions[i].classList.contains('is-active')) {
        var submenu = accordions[i].nextElementSibling;
        submenu.style.maxHeight = submenu.scrollHeight + "px";
        submenu.style.marginTop = "0.75em";
        submenu.style.marginBottom = "0.75em";
    }

    accordions[i].onclick = function () {
        this.classList.toggle('is-active');

        const submenu = this.nextElementSibling;
        if (submenu.style.maxHeight) {
            // menu is open, we need to close it.
            submenu.style.maxHeight = null;
            submenu.style.marginTop = null;
            submenu.style.marginBottom = null;

        } else {
            // menu is closed, we need to open it.
            submenu.style.maxHeight = submenu.scrollHeight + "px";
            submenu.style.marginTop = "0.75em";
            submenu.style.marginBottom = "0.75em";
        }
    }
}