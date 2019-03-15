// JavaScript Document

const $btn = document.getElementById('btn-menu');
const $navList = document.getElementById('nav-list');

$btn.addEventListener('click', () => $navList.classList.toggle('open'));