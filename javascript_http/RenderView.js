
//--------------------Funzione 1-------------------
function UsersList(array_users, element_selector) {
    //indico che la lista la voglio nell'index.html nell'id che indico quando richiamo la funzione
    const lista = document.getElementById(element_selector)
    //per ottenere l'elenco prendo il json -> entro dentro data -> li mappo (trasformo in qualcos altro)
    const elenco = array_users.data.map((user) => {
        //console.log("sono un utente",user)
        return "<li>" + user.first_name + " " + user.last_name + "</li>"
        //prendo gli elementi dell'array e li unisco con una stringa usando .join
    }).join("")

    lista.innerHTML = elenco
}

//--------------------Funzione 2-------------------
//Chiamo una variabile a cui associo una funzione -> function expression
const UserTable = (array_users, element_selector) => {

    const html = `<table border="1" width="100%">
        <tr>
            <th>
                Nome
            </th>
        </tr>
`
        +

        //Prendo tutto l'array utenti -> con map ne prendo uno solo
        array_users.map((user) => {
            return `<tr>
                <td> 
                     ${user.first_name}
                </td>
            </tr>`
        }).join("")
        +
        `</table>`
    
        document.getElementById(element_selector).innerHTML = html

}

export { UsersList, UserTable }