/**
 * @author MD. Mehedi Hasan
 * This page is responsible to handle global alert related things.
 * */

document.querySelector('#alert-close').addEventListener('click',function (el) {
    const target = document.querySelector('#alertDiv')
    target.classList.add('hidden');
})
