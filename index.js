document.addEventListener('DOMContentLoaded', ()=>{


/*form selection*/ 
let formSelection = document.querySelector('.formSelection');
let login = document.querySelector('.login');
let signup = document.querySelector('.signup');


formSelection.addEventListener('click', (e)=>{
  if (e.target.textContent === 'Prijava'){
    formSelection.style.display = 'none';
    login.style.display = 'block';
  } else if (e.target.textContent === 'Registracija'){
    formSelection.style.display = 'none';
    signup.style.display = 'block';
  } else return;
})


 /*LOGIN forma*/   
 let loginForm = document.getElementById('loginForm');
 let signupForm = document.getElementById('signupForm');
 let infoMessage = document.querySelector('.infoMessage')
 
 loginForm.addEventListener('keypress',(e)=>{
   infoMessage.textContent='';
 })
 signupForm.addEventListener('keypress',()=>{
  infoMessage.textContent='';
})


function authenticate(username, password){

  let http = new XMLHttpRequest();
  let url = 'authentication.php';
  let params = `username=${username}&password=${password}`;
  http.open('POST', url, true);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  http.onreadystatechange = function() {//Call a function when the state changes.
      if(http.readyState == 4 && http.status == 200) {
        if(http.responseText === 'User selected'){

          infoMessage.innerHTML="<span style='color:green;'>Uspešno ste  se ulogovali</span>";
          setTimeout(()=>{
            location.href='settingsPage.php';
          }, 3000)
          return console.log("User found");
        } else if (http.responseText === 'User not found'){
          infoMessage.innerHTML = "<span style='color:red;'>Neuspešno logovanje. Pogrešno korisničko ime ili lozinka.</span>";
          return console.log("Not found");
        } else if(http.responseText === "Najverovatnije ti je los SQL"){
          console.log("Los SQL query.");
        } else console.log(`Doslo je do greske: ${http.responseText}`);

      }
  }
  http.send(params);
    
  /* sa fetch mora FormData da bi $_POST mogao iscitati podatke
  let url = 'authentication.php';
  let formData = new FormData();
  formData.append(`username`, username);
  formData.append(`password`, password);

  fetch(url, { method: 'POST', body: formData })
  .then(response => response.text())
  .then( body => console.log(body)) 
   */
  console.log(username, password);

}

loginForm.addEventListener('submit', (e)=>{
    e.preventDefault();
    //let username = loginForm.elements.username.value;
    let username = e.target["username"].value;
    let password = e.target["password"].value;
    authenticate(username, password);
    
})



// SIGNUP forma
let signupMessage = document.getElementById('signupMessage');
function signUp(username, password){

  let http = new XMLHttpRequest();
  let url = 'signUp.php';
  let params = `username=${username}&password=${password}`;
  http.open('POST', url, true);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  http.onreadystatechange = function() {//Call a function when the state changes.
      if(http.readyState == 4 && http.status == 200) {
        if(http.responseText === 'User added'){
          console.log(http.responseText);
          signupMessage.innerHTML="<span style='color:green;'>Uspešna registracija</span>";
          setTimeout(()=>{
            location.href='settingsPage.php';
          }, 3000)
          return console.log("Registration succeded");
        } else if (http.responseText === 'Duplicate user'){
          console.log(http.responseText);
          signupMessage.innerHTML = "<span style='color:red;'>Neuspešna registracija. Izaberite drugo korisničko ime.</span>";
          return console.log("Failed registration");
        } 

      } else return console.log(`Info: Request Status: ${http.status} Status Text: ${http.statusText}  ${http.responseText}`);
  }
  http.send(params);
  console.log(username, password);

}
signupForm.addEventListener('submit', (e)=>{
  e.preventDefault();
  //let username = loginForm.elements.username.value;
  let username = e.target["username"].value;
  let password = e.target["password"].value;
  signUp(username, password);
  
})

})