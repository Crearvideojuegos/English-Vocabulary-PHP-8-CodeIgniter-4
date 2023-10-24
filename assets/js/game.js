down_window();
function down_window()
{
    window.scrollBy(0, 200);
}

const button_error = document.querySelector('#error-button');
const button_succes = document.querySelector('#success-button');

button_error.disabled = true;
button_succes.disabled = true;

document.querySelector('#show-button').onclick = () => {

    document.querySelector('#div-response').classList.remove("blur-words-game");
    document.querySelector('#button-response').classList.remove("d-none");
    document.querySelector('#show-button').disabled = true;

    button_error.disabled = false;
    button_succes.disabled = false;
}



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
        
        ++numberVoice;
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
