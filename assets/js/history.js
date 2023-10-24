//Show Button

const buttonShow = document.querySelectorAll('.button-show');

buttonShow.forEach(btnShow => {
    btnShow.addEventListener('click', function handleClick(event) {
        let td_number = btnShow.getAttribute('data-td');
        let button_state = btnShow.getAttribute('data-state');
        if(button_state == 'close') {
            document.querySelector('#tr-two-'+td_number).classList.remove("d-none");
            btnShow.setAttribute('data-state', 'open');
        } else if (button_state == 'open') {
            document.querySelector('#tr-two-'+td_number).classList.add("d-none");
            btnShow.setAttribute('data-state', 'close');
        }
    });
});
