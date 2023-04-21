
// "lista_utenti"
// json  | json.data | ciccio
// UsersList(json)
// UsersList(json.data)
// UsersList(ciccio) 
function UsersList(array_users, element_selector) {

    const lista = document.getElementById(element_selector)
    const elenco = array_users.map((user) => {

        return "<li>(" + user.user_id + ")" + user.first_name + " " + user.last_name + "</li>"
    })
        .join("\n")

    lista.innerHTML = elenco

}


// UserTable() // Function expression
const UserTable = (array_users, element_selector) => {
    // Template literal   
    const tr_users = array_users.map((user) => {

                        return `<tr>
                                    <td>
                                        ${user.first_name}
                                    </td>
                                </tr>`
                    }).join("")

    console.log(tr_users);

    const html = `
            <table border="1" width="100%">
            <tr>
                <th>
                    Nome
                </th>
            </tr>
            ${tr_users}
            </table>`

    document.getElementById(element_selector).innerHTML = html

}

// 1000


export { UsersList, UserTable }