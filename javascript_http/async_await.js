
/** una funzione asyncrona restituira sempreuna Promessa */
async function getUser() {
    // const base_url = "mariorossi.000Webhosapp.it/rest_api/";
    const base_url = "http://localhost/corso_php_mysql_2223/form_in_php/rest_api";

    const response = await fetch(base_url + "/users.php")
    console.log(response)


    const json = await response.json();

    return json;
    // console.log(json);
}


// const users =  await getUser();
// console.log(users)