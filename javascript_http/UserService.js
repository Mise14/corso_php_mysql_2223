
// /users.php
// const base_url = "mariorossi.000Webhosapp.it/rest_api/";
const base_url = "http://localhost/corso_php_mysql_2223/form_in_php/rest_api"

// export const ciccio = "aaa"; 

export async function getUser() {
    const response = await fetch(base_url + "/users.php")
    const json = await response.json();
    return json.data;
}