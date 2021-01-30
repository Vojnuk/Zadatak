document.addEventListener('DOMContentLoaded', ()=>{


/*SETTTINGS forma*/ 
let settingsForm = document.getElementById('settingsForm');
let tel = document.querySelector('#tel');
let email = document.getElementById('email');

settingsForm.addEventListener('submit', (e)=>{
    //e.preventDefault();
    console.log('submited');
})


tel.addEventListener('input', () => {
  tel.setCustomValidity('');
  tel.checkValidity();
});

tel.addEventListener('invalid', () => {
  tel.setCustomValidity('Molimo ispunite polje odgovarajućim formatom telefonskog broja.');
  
});

email.addEventListener('input', () => {
    email.setCustomValidity('');
    email.checkValidity();
  });
  
email.addEventListener('invalid', () => {
  email.setCustomValidity('Elektronska pošta ne odgovara standardnom formatu. Primer: nikola@gmail.com');
  
});


})