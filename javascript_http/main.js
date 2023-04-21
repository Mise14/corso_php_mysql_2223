import { UserTable, UsersList } from "./RenderView.js";
import { getUser } from "./UserService.js";


const users = await getUser()
UserTable(users,'lista_utenti_2')
UsersList(users,'lista_utenti_1')