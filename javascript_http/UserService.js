
// http://localhost/corso_php_mysql_2223/form_in_php/rest_api/users.php

//Credo la base dell'url che andrò a modificare in tutte le chiamate su Thunder, così da dover
//modificare solo l'ultima parte dell'URL
const base_url = "http://localhost/corso_php_mysql_2223/form_in_php/rest_api"

//export permette di rendere visibile la funzione a tutto il progetto, userò import nel main
//per poterla usare
export function getUser(){

    //Utilizzando Fetch unisco l'ultima parte dell'url per fare la chiamata HTPP, è il client di HTPP di ECMA6
    //Promise(promessa) è un oggetto che ancora non contiene le informazioni, ma prima o poi arriveranno
    const promise = fetch(base_url+"/users.php")
    console.log("1 promessa di fetch",promise)
    //Then prende una callback, la funzione verrà eseguita quanto la promise verrà soddisfatta
    promise.then((response) => {
        //.json trasforma la risposta in json
        return response.json()
    })
    .then((json) => {
        //visualizzo i dati disponibili sulla console
        console.log(json)
        //li stampo nell'index
        const lista = document.getElementById("lista_utenti")
        //per ottenere l'elenco prendo il json -> entro dentro data -> li mappo (trasformo in qualcos altro)
        const elenco = json.map((user)=>{
            console.log("sono un utente",user)
            return "<li>"+user.first_name+"</li>"
            //prendo gli elementi dell'array e li unisco con una stringa usando .join
        }).join("")

        lista.innerHTML = elenco
    })

}