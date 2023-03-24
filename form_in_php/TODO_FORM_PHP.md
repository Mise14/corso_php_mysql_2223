
- [ ] Permettere validazione multipla sullo stesso campo **username** (required|email)
         'first_name' => [new ValidateRequired('','Il Nome è obblicatorio')],
         'username'  => [new ValidateRequired('','Username è obbligaztorio'),new ValidateMail('','')]
<!-- - ottenere elenco delle regioni 
    - nome regione
    - id regione    -->

<!-- - ottenere elenco delle province 
    - nome provicia
    - id / cod provincia    -->


- [ ] Validazione su citta regione provincia lato server (aggiungere come required)

- T[x] quando i dati sono corretti devo inviarli e salvarli
     T[x] un modo per controllare tutti i campi contemporaneamente


- [ ] seleziono regione, vedo solo le province corrispondenti
    - [ ] select2
    - [ ] select delle regioni 
        onchange (evento)


- [x] aggiornato tutta applicazione con i namespace