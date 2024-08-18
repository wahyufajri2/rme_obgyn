/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

const marqueeText = document.getElementById('marqueeText');
const marqueeText1 = document.getElementById('marqueeText1');
const marqueeText2 = document.getElementById('marqueeText2');
const marqueeContainer = document.querySelector('.marquee-container');

function startMarquee() {
    const containerWidth = marqueeContainer.offsetWidth;
    const textWidth = marqueeText.offsetWidth;

    if (textWidth > containerWidth) {
        marqueeText.style.animation = `marquee ${(textWidth / 70)}s linear infinite`;
        marqueeText1.style.animation = `marquee ${(textWidth / 70)}s linear infinite`;
        marqueeText2.style.animation = `marquee ${(textWidth / 70)}s linear infinite`;
    }
}

startMarquee();
