
// http://localhost/corso_php_mysql_2223/form_in_php/rest_api/users.php

//Credo la base dell'url che andrò a modificare in tutte le chiamate su Thunder, così da dover
//modificare solo l'ultima parte dell'URL
const base_url = "http://localhost/corso_php_mysql_2223/form_in_php/rest_api"

//export permette di rendere visibile la funzione a tutto il progetto, userò import nel main
//per poterla usare
export function getUser(){

    //Usiamo Fetch per fare la chiamata HTPP, è il client di HTPP di ECMA6
    //Promise(promessa) è un oggetto che ancora non contiene le informazioni, ma prima o poi arriveranno
    return fetch(base_url+"/users.php").then(response => response.json())
    //Then prende una callback, la funzione verrà eseguita quanto la promise verrà soddisfatta
        //.json trasforma la risposta in json

}