/*
Template Name: Tocly -  Admin & Dashboard Template
Author: Themesdesign
Version: 1.0.0
Contact: themesdesign.in@gmail.com
File: layout Js File
*/


(function () {

    'use strict';

    if (sessionStorage.getItem('is_visited') == 'dark-mode-switch') {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
    } else if (sessionStorage.getItem('is_visited') == 'light-mode-switch') {
        document.documentElement.setAttribute('data-bs-theme', 'light');
    } else if (sessionStorage.getItem('is_visited') == 'rtl-mode-switch') {
        document.documentElement.setAttribute('data-bs-theme', 'light');
    }

})();