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

//Edit Button
const buttonEdit = document.querySelectorAll('.button-edit');

buttonEdit.forEach(btnEdit => {
    btnEdit.addEventListener('click', function handleClick(event) {

        let info = btnEdit.getAttribute('data-info');
        let sentence = btnEdit.getAttribute('data-sentence');
        let native = btnEdit.getAttribute('data-native');

        let td_number = btnEdit.getAttribute('data-td');

        document.querySelector('#english_sentence_modal').value = sentence;
        document.querySelector('#native_sentence_modal').value = native;


        document.querySelector('#btn-modal-edit').onclick = () => {

            let edit_english = document.querySelector('#english_sentence_modal').value;
            let edit_native = document.querySelector('#native_sentence_modal').value;
    
            let edit_english_error = '';
            let edit_native_error = '';

            //Validation Words
            if(edit_english.length <= 1 || edit_english.length >= 200)
            {
                edit_english_error = 'Minimun Two Characters.';
            }

            if(edit_native.length <= 1 || edit_native.length >= 200)
            {
                edit_native_error = 'Minimum Two Characters';
            }

            document.querySelector('#english_sentence_modal').classList.remove("error-input-border");
            document.querySelector('#native_sentence_modal').classList.remove("error-input-border");

            document.querySelector('#popup_english_sentence').innerHTML = '';
            document.querySelector('#popup_native_sentence').innerHTML = '';

            if(edit_english_error != '' || edit_native_error != '')
            {
                if(edit_english_error != '')
                {
                    document.querySelector('#english_sentence_modal').classList.add("error-input-border");
                    document.querySelector('#popup_english_sentence').innerHTML = edit_english_error;
                }

                if(edit_native_error != '')
                {
                    document.querySelector('#native_sentence_modal').classList.add("error-input-border");
                    document.querySelector('#popup_native_sentence').innerHTML = edit_native_error;
                }

                return;
            }


            let ajax_url = base_url() + 'sentences/ajax-edit-sentence';
            let data = "info=" + info + "&english=" + edit_english + "&native=" + edit_native;


            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", ajax_url, true); 
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(data);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    btnEdit.setAttribute('data-sentence', edit_english);
                    btnEdit.setAttribute('data-native', edit_native);

                    document.querySelector('#english-'+td_number).innerHTML = edit_english;
                    document.querySelector('#native-'+td_number).innerHTML = edit_native;
                    document.querySelector('#active-game-'+td_number).innerHTML = 'Yes';

                    
                    const myModal = bootstrap.Modal.getOrCreateInstance('#editModal');
                    
                    setTimeout(() => {
                        myModal.hide();
                    }, 300);
                }
            };
        }
    });
});


//Delete Button
const buttonDelete = document.querySelectorAll('.button-delete');

buttonDelete.forEach(btnDelete => {
    btnDelete.addEventListener('click', function handleClick(event) {

        let info = btnDelete.getAttribute('data-info');

        let td_number = btnDelete.getAttribute('data-td');

        document.querySelector('#btn-modal-delete').onclick = () => {

            let ajax_url = base_url() + 'sentences/ajax-delete-sentence';
            let data = "info=" + info;

            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", ajax_url, true); 
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(data);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let td_one = document.querySelector('#tr-one-'+td_number);
                    let td_two = document.querySelector('#tr-two-'+td_number);

                    td_one.remove();
                    td_two.remove();
                    
                    const myModal = bootstrap.Modal.getOrCreateInstance('#deleteModal');
                    
                    setTimeout(() => {
                        myModal.hide();
                    }, 300);
                }
            };
        }
    });
});

//VOICE

let voiceList = document.querySelector('#voiceList');
let voice_selected = document.querySelector('#voice_selected').value;

let synth = window.speechSynthesis;
let voices = [];

PopulateVoices();
if(speechSynthesis !== undefined){
    speechSynthesis.onvoiceschanged = PopulateVoices;
}


const readWord = document.querySelectorAll('.readword');

readWord.forEach(btnReadWord => {
    btnReadWord.addEventListener('click', function handleClick(event) {

        let synth = window.speechSynthesis;
        let wordread = btnReadWord.getAttribute('data-wordread');

        let toSpeak = new SpeechSynthesisUtterance(wordread);
        toSpeak.lang = 'en-GB';

        let selectedVoiceName = voiceList.selectedOptions[0].getAttribute('data-name');

        voices.forEach((voice)=>{
            if(voice.name === selectedVoiceName){
                toSpeak.voice = voice;
            }
        });

        synth.speak(toSpeak);

    });
});


function PopulateVoices(){
    voices = synth.getVoices();
    let selectedIndex = voiceList.selectedIndex < 0 ? 0 : voiceList.selectedIndex;
    voiceList.innerHTML = '';
    let numberVoice = 1;
    voices.forEach((voice)=>{

            let listItem = document.createElement('option');
            listItem.textContent = voice.name;
            listItem.setAttribute('data-lang', voice.lang);
            listItem.setAttribute('data-name', voice.name);
            listItem.setAttribute('value', numberVoice);
            voiceList.appendChild(listItem);
        
    });
    voiceList.selectedIndex = selectedIndex;


    let select = voiceList;
    let option;
    
    for (let i = 0; i < select.options.length; i++) {
        option = select.options[i];
        
        if (option.value == voice_selected) {
            option.selected = true;
            return;
        } 
    }
}