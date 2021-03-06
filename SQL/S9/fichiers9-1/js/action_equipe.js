
window.addEventListener('load',initEquipe);

function initEquipe(){
  document.forms.form_equipe.addEventListener('submit',sendFormEquipe);
}

function sendFormEquipe(ev){ // form event listener
  ev.preventDefault();
  let url = 'services/getInfoEquipe.php?'+formDataToQueryString(new FormData(this));
  fetchFromJson(url)
  .then(processAnswer)
  .then(displayInfoEquipe, displayErrorEquipe);
  if (fetchFromJson(url).then(processAnswer) != false){
    let url = 'services/getCoureurs.php?'+formDataToQueryString(new FormData(this));
    fetchFromJson(url)
    .then(processAnswer)
    .then(displayInfoCoureurs, dispalyErrorCoureurs);
  }

}

function processAnswer(answer){
 if (answer.status == 'ok')
    return answer.result;
  else {
    throw new Error(answer.message);
  }
}

function displayInfoEquipe(equipeInfo){
 let div  = document.querySelector('section#section_equipe>div.resultat');
 div.textContent="";
 let item = document.createElement('p');
 item.textContent = "nom: "+ equipeInfo.nom
                    +  " ,couleur: "+equipeInfo.couleur
                    + " ,directeur: "+ equipeInfo.directeur;
 div.appendChild(item);
}

function displayInfoCoureurs(equipeInfo){
  let div  = document.querySelector('section#section_equipe>div.resultat');
  let table = listToTable(equipeInfo);
  div.appendChild(table);
}

function displayErrorEquipe(error){
  let p = document.createElement('p');
  p.innerHTML = error.message;
  let cible  = document.querySelector('section#section_equipe>div.resultat');
  cible.textContent=''; // effacement
  cible.appendChild(p);
}

function dispalyErrorCoureurs(error){
  let p = document.createElement('p');
  p.innerHTML = error.message;
  let cible  = document.querySelector('section#section_equipe>div.resultat');
  //cible.textContent=''; // effacement
  cible.appendChild(p);
}



// -------- utilitaire (question 2 et 3)
/*
 * list : un tableau usuel non vide, donc chaque élément est un objet simple
 * résultat : une table (objet DOM) représentant les données de la table.
 *            les en-têtes de colonnes sont les noms d'attributs des objets
 */
function listToTable(list){
  let table = document.createElement('table');
  let row = table.createTHead().insertRow();
  for (let x of Object.keys(list[0]))
    row.insertCell().textContent = x;
  let body = table.createTBody();
  for (let line of list){
    let row = body.insertRow();
    for (let x of Object.values(line))
      row.insertCell().textContent = x;
  }
  return table;
}
